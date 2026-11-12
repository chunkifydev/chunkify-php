<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Omit;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\UploadsContract;
use Chunkify\Uploads\Upload;
use Chunkify\Uploads\UploadCompleteParams\Part;
use Chunkify\Uploads\UploadCreateParams\Storage;
use Chunkify\Uploads\UploadCreateParams\UploadMode;
use Chunkify\Uploads\UploadListParams\Created;
use Chunkify\Uploads\UploadListParams\Status;

/**
 * @phpstan-import-type StorageShape from \Chunkify\Uploads\UploadCreateParams\Storage
 * @phpstan-import-type CreatedShape from \Chunkify\Uploads\UploadListParams\Created
 * @phpstan-import-type PartShape from \Chunkify\Uploads\UploadCompleteParams\Part
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class UploadsService implements UploadsContract
{
    /**
     * @api
     */
    public UploadsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new UploadsRawService($client);
    }

    /**
     * @api
     *
     * Create an Upload session for a direct transfer to storage. Multipart creation returns every signed part URL. Retry parts with their original URLs and complete before expiry. Customer storage requires long-lived credentials and an incomplete-multipart lifecycle rule. Start a new Upload after abandoning a session.
     *
     * @param bool $createAsset CreateAsset specifies whether to create an Asset after Upload completion. Defaults to false.
     * Snapshots the Project output settings, including the path template. Referenced metadata must be non-empty in this request. Asset processing is billed separately.
     * @param int $fileSizeBytes FileSizeBytes specifies the exact file size in bytes. Required when UploadMode is omitted, auto, or multipart. Optional for explicit single mode. Must fit the team's Source size limit. Single PUT supports up to 5 GiB, subject to the provider's limit; multipart supports up to 5 TiB.
     * @param array<string,string> $metadata metadata allows for additional information to be attached to the upload, with a maximum size of 2048 bytes
     * @param Storage|StorageShape $storage Optional Storage override. Omit id to use the Project default. Customer-connected Storage requires path; Chunkify Storage generates its own path.
     * @param UploadMode|value-of<UploadMode> $uploadMode UploadMode specifies the transfer method. Defaults to auto. Auto chooses multipart above 100 MiB and single PUT at or below 100 MiB for every Storage provider. Multipart requires a provider that supports the required multipart operations and signed part URLs. Provider failures return an error without falling back to single PUT.
     * @param int $validityTimeout ValidityTimeout specifies the session and signed URL lifetime in seconds. Single PUT defaults to 7200 and allows 300–36000. Multipart defaults to twice the transfer time at 5 Mbps plus 1800 seconds, bounded to 7200–172800; an explicit value allows 300–172800. Complete before expiry. Storage credentials and policies can shorten URL validity. Expired URLs cannot be refreshed.
     * @param string|Omit|null $workflowID WorkflowId specifies the Workflow to select. Omit to use the Project default. Set null to disable automatic actions. The current revision is pinned when creation is accepted.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        bool $createAsset = false,
        ?int $fileSizeBytes = null,
        ?array $metadata = null,
        Storage|array|null $storage = null,
        UploadMode|string $uploadMode = 'auto',
        ?int $validityTimeout = null,
        string|Omit|null $workflowID = Omit::Value,
        RequestOptions|array|null $requestOptions = null,
    ): Upload {
        $params = [];
        $params['createAsset'] = $createAsset;
        null !== $fileSizeBytes && $params['fileSizeBytes'] = $fileSizeBytes;
        null !== $metadata && $params['metadata'] = $metadata;
        null !== $storage && $params['storage'] = $storage;
        $params['uploadMode'] = $uploadMode;
        null !== $validityTimeout && $params['validityTimeout'] = $validityTimeout;
        Omit::Value !== $workflowID && $params['workflowID'] = $workflowID;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve details of a specific upload by its ID, including metadata, status, and associated source.
     *
     * @param string $uploadID Upload ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $uploadID,
        RequestOptions|array|null $requestOptions = null
    ): Upload {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($uploadID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a list of all uploads with optional filtering and pagination.
     *
     * @param string $id Filter by upload ID
     * @param Created|CreatedShape $created
     * @param int $limit Pagination limit (max 100)
     * @param list<list<string>> $metadata Filter by metadata
     * @param int $offset Pagination offset
     * @param string $sourceID Filter by source ID
     * @param Status|value-of<Status> $status Filter by status (pending, completed, error)
     * @param RequestOpts|null $requestOptions
     *
     * @return PaginatedResults<Upload>
     *
     * @throws APIException
     */
    public function list(
        ?string $id = null,
        Created|array|null $created = null,
        int $limit = 100,
        ?array $metadata = null,
        int $offset = 0,
        ?string $sourceID = null,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'created' => $created,
                'limit' => $limit,
                'metadata' => $metadata,
                'offset' => $offset,
                'sourceID' => $sourceID,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete an upload.
     *
     * @param string $uploadID Upload id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $uploadID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($uploadID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * POST the returned completion_url before expires_at. Single-PUT Uploads send no body; multipart Uploads send every part number and storage ETag. Chunkify verifies the assembled object and atomically creates the Source and optional Asset. An Asset destination conflict returns 409 and fails the Upload without committing Source, Asset, or usage changes. Valid retries return 204 without duplicate side effects. Retry network errors, 429, and 5xx responses with bounded backoff.
     *
     * @param string $token Opaque completion capability from completion_url
     * @param list<Part|PartShape> $parts all uploaded parts in ascending part_number order, with the ETags returned by storage
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function complete(
        string $token,
        array $parts,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = [];
        $params['parts'] = $parts;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->complete($token, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
