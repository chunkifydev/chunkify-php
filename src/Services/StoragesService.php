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
use Chunkify\Storages\StorageCreateParams\Storage\StorageAwsCreateParams;
use Chunkify\Storages\StorageCreateParams\Storage\StorageChunkifyCreateParams;
use Chunkify\Storages\StorageCreateParams\Storage\StorageCloudflareCreateParams;
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
        StorageAwsCreateParams|array|StorageChunkifyCreateParams|StorageCloudflareCreateParams $storage,
        RequestOptions|array|null $requestOptions = null,
    ): StorageChunkify|StorageCloudflare|StorageAws {
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
    ): StorageChunkify|StorageCloudflare|StorageAws {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($storageID, requestOptions: $requestOptions);

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
