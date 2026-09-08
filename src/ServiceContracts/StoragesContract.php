<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\RequestOptions;
use Chunkify\Storages\Storage\StorageAws;
use Chunkify\Storages\Storage\StorageChunkify;
use Chunkify\Storages\Storage\StorageCloudflare;
use Chunkify\Storages\StorageCreateParams\Storage\StorageAwsCreateParams;
use Chunkify\Storages\StorageCreateParams\Storage\StorageChunkifyCreateParams;
use Chunkify\Storages\StorageCreateParams\Storage\StorageCloudflareCreateParams;
use Chunkify\Storages\StorageListResponse;

/**
 * @phpstan-import-type StorageShape from \Chunkify\Storages\StorageCreateParams\Storage
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface StoragesContract
{
    /**
     * @api
     *
     * @param StorageShape $storage the parameters for creating a new storage configuration
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        StorageAwsCreateParams|array|StorageChunkifyCreateParams|StorageCloudflareCreateParams $storage,
        RequestOptions|array|null $requestOptions = null,
    ): StorageChunkify|StorageCloudflare|StorageAws;

    /**
     * @api
     *
     * @param string $storageID Storage id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $storageID,
        RequestOptions|array|null $requestOptions = null
    ): StorageChunkify|StorageCloudflare|StorageAws;

    /**
     * @api
     *
     * @param string $storageID Storage id
     * @param string $basePrefix Object-key prefix for future final job outputs. Existing files keep their stored object keys. Send an empty string to use the bucket root.
     * @param string|null $cdnBaseURL customer-managed HTTPS delivery origin, or null to remove the current value
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $storageID,
        ?string $basePrefix = null,
        ?string $cdnBaseURL = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): StorageListResponse;

    /**
     * @api
     *
     * @param string $storageID Storage id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $storageID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
