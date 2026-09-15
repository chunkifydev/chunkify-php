<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\StoragesContract;
use Chunkify\Storages\Storage\StorageAws;
use Chunkify\Storages\Storage\StorageChunkify;
use Chunkify\Storages\Storage\StorageCloudflare;
use Chunkify\Storages\Storage\StorageS3Compatible;
use Chunkify\Storages\StorageCreateParams\Storage\StorageAwsCreateParams;
use Chunkify\Storages\StorageCreateParams\Storage\StorageChunkifyCreateParams;
use Chunkify\Storages\StorageCreateParams\Storage\StorageCloudflareCreateParams;
use Chunkify\Storages\StorageCreateParams\Storage\StorageS3CompatibleCreateParams;
use Chunkify\Storages\StorageListResponse;

/**
 * @phpstan-import-type StorageShape from \Chunkify\Storages\StorageCreateParams\Storage
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class StoragesService implements StoragesContract
{
    /**
     * @api
     */
    public StoragesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new StoragesRawService($client);
    }

    /**
     * @api
     *
     * Create a new storage configuration for cloud storage providers like AWS S3, Cloudflare R2, etc. The storage credentials will be validated before saving.
     *
     * @param StorageShape $storage the parameters for creating a new storage configuration
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        StorageAwsCreateParams|array|StorageChunkifyCreateParams|StorageCloudflareCreateParams|StorageS3CompatibleCreateParams $storage,
        RequestOptions|array|null $requestOptions = null,
    ): StorageChunkify|StorageCloudflare|StorageAws|StorageS3Compatible {
        $params = Util::removeNulls(['storage' => $storage]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve details of a specific storage configuration by its id.
     *
     * @param string $storageID Storage id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $storageID,
        RequestOptions|array|null $requestOptions = null
    ): StorageChunkify|StorageCloudflare|StorageAws|StorageS3Compatible {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($storageID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update customer-owned storage settings. Prefix changes apply to final outputs that have not been uploaded yet. Existing files keep their stored object keys.
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
    ): mixed {
        $params = Util::removeNulls(
            ['basePrefix' => $basePrefix, 'cdnBaseURL' => $cdnBaseURL]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($storageID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a list of all storage configurations for the current project.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): StorageListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a storage configuration. The storage must not be currently attached to the project.
     *
     * @param string $storageID Storage id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $storageID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($storageID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
