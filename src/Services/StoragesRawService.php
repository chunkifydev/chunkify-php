<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\StoragesRawContract;
use Chunkify\Storages\Storage;
use Chunkify\Storages\Storage\StorageAws;
use Chunkify\Storages\Storage\StorageChunkify;
use Chunkify\Storages\Storage\StorageCloudflare;
use Chunkify\Storages\Storage\StorageS3Compatible;
use Chunkify\Storages\StorageCreateParams;
use Chunkify\Storages\StorageListResponse;
use Chunkify\Storages\StorageUpdateParams;

/**
 * @phpstan-import-type StorageShape from \Chunkify\Storages\StorageCreateParams\Storage
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class StoragesRawService implements StoragesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new storage configuration for cloud storage providers like AWS S3, Cloudflare R2, etc. The storage credentials will be validated before saving.
     *
     * @param array{storage: StorageShape}|StorageCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<StorageChunkify|StorageCloudflare|StorageAws|StorageS3Compatible,>
     *
     * @throws APIException
     */
    public function create(
        array|StorageCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = StorageCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/storages',
            body: (object) $parsed['storage'],
            unwrap: 'data',
            options: $options,
            convert: Storage::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve details of a specific storage configuration by its id.
     *
     * @param string $storageID Storage id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<StorageChunkify|StorageCloudflare|StorageAws|StorageS3Compatible,>
     *
     * @throws APIException
     */
    public function retrieve(
        string $storageID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/storages/%1$s', $storageID],
            unwrap: 'data',
            options: $requestOptions,
            convert: Storage::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Update customer-owned storage settings. Prefix changes apply to final outputs that have not been uploaded yet. Existing files keep their stored object keys.
     *
     * @param string $storageID Storage id
     * @param array{
     *   basePrefix?: string, cdnBaseURL?: string|null
     * }|StorageUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $storageID,
        array|StorageUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = StorageUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['api/storages/%1$s', $storageID],
            body: (object) $parsed,
            options: $options,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve a list of all storage configurations for the current project.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<StorageListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/storages',
            options: $requestOptions,
            convert: StorageListResponse::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Delete a storage configuration. The storage must not be currently attached to the project.
     *
     * @param string $storageID Storage id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $storageID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['api/storages/%1$s', $storageID],
            options: $requestOptions,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }
}
