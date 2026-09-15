<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\UploadsContract;
use Chunkify\Uploads\Upload;
use Chunkify\Uploads\UploadCreateParams\Storage;
use Chunkify\Uploads\UploadListParams\Created;
use Chunkify\Uploads\UploadListParams\Status;

/**
 * @phpstan-import-type StorageShape from \Chunkify\Uploads\UploadCreateParams\Storage
 * @phpstan-import-type CreatedShape from \Chunkify\Uploads\UploadListParams\Created
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
     * Create a new upload with the specified name.
     *
     * @param array<string,string> $metadata metadata allows for additional information to be attached to the upload, with a maximum size of 2048 bytes
     * @param Storage|StorageShape $storage Optional Storage override. Omit id to use the Project default. Customer-connected Storage requires path; Chunkify Storage generates its own path.
     * @param int $validityTimeout Both the file PUT and completion POST must finish within this timeout in seconds
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?array $metadata = null,
        Storage|array|null $storage = null,
        int $validityTimeout = 7200,
        RequestOptions|array|null $requestOptions = null,
    ): Upload {
        $params = Util::removeNulls(
            [
                'metadata' => $metadata,
                'storage' => $storage,
                'validityTimeout' => $validityTimeout,
            ],
        );

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
}
