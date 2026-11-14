<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Omit;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Uploads\Upload;
use Chunkify\Uploads\UploadCreateParams\UploadMode;
use Chunkify\Uploads\UploadCreateStorageParams;
use Chunkify\Uploads\UploadListParams\Created;
use Chunkify\Uploads\UploadListParams\Status;
use Chunkify\Uploads\UploadMultipartPartParams;

/**
 * @phpstan-import-type UploadCreateStorageParamsShape from \Chunkify\Uploads\UploadCreateStorageParams
 * @phpstan-import-type CreatedShape from \Chunkify\Uploads\UploadListParams\Created
 * @phpstan-import-type UploadMultipartPartParamsShape from \Chunkify\Uploads\UploadMultipartPartParams
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface UploadsContract
{
    /**
     * @api
     *
     * @param bool $createAsset CreateAsset specifies whether to create an Asset after Upload completion. Defaults to false.
     * Snapshots the Project output settings, including the path template. Referenced metadata must be non-empty in this request. Asset processing is billed separately.
     * @param int $fileSizeBytes FileSizeBytes specifies the exact file size in bytes. Required when UploadMode is omitted, auto, or multipart. Optional for explicit single mode. Must fit the team's Source size limit. Single PUT supports up to 5 GiB, subject to the provider's limit; multipart supports up to 5 TiB.
     * @param array<string,string> $metadata metadata allows for additional information to be attached to the upload, with a maximum size of 2048 bytes
     * @param UploadCreateStorageParams|UploadCreateStorageParamsShape $storage Optional Storage override. Omit id to use the Project default. Customer-connected Storage requires path; Chunkify Storage generates its own path.
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
        UploadCreateStorageParams|array|null $storage = null,
        UploadMode|string $uploadMode = 'auto',
        ?int $validityTimeout = null,
        string|Omit|null $workflowID = Omit::Value,
        RequestOptions|array|null $requestOptions = null,
    ): Upload;

    /**
     * @api
     *
     * @param string $uploadID Upload ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $uploadID,
        RequestOptions|array|null $requestOptions = null
    ): Upload;

    /**
     * @api
     *
     * @param string $id Filter by upload ID
     * @param Created|CreatedShape $created
     * @param int $limit Pagination limit (max 100)
     * @param list<string> $metadata Filter by metadata. Repeat key:value pairs to match all supplied metadata conditions.
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
    ): PaginatedResults;

    /**
     * @api
     *
     * @param string $uploadID Upload id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $uploadID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $token Opaque completion capability from completion_url
     * @param list<UploadMultipartPartParams|UploadMultipartPartParamsShape> $parts all uploaded parts in ascending part_number order, with the ETags returned by storage
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function complete(
        string $token,
        ?array $parts = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
