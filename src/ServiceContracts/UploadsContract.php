<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Uploads\Upload;
use Chunkify\Uploads\UploadListParams\Created;
use Chunkify\Uploads\UploadListParams\Status;

/**
 * @phpstan-import-type CreatedShape from \Chunkify\Uploads\UploadListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface UploadsContract
{
    /**
     * @api
     *
     * @param array<string,string> $metadata metadata allows for additional information to be attached to the upload, with a maximum size of 2048 bytes
     * @param int $validityTimeout The upload URL will be valid for the given timeout in seconds
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?array $metadata = null,
        int $validityTimeout = 3600,
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
}
