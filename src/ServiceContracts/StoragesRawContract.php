<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\RequestOptions;
use Chunkify\Storages\Storage\StorageAws;
use Chunkify\Storages\Storage\StorageChunkify;
use Chunkify\Storages\Storage\StorageCloudflare;
use Chunkify\Storages\Storage\StorageS3Compatible;
use Chunkify\Storages\StorageCreateParams;
use Chunkify\Storages\StorageListResponse;
use Chunkify\Storages\StorageUpdateParams;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface StoragesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|StorageCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<StorageChunkify|StorageCloudflare|StorageAws|StorageS3Compatible,>
     *
     * @throws APIException
     */
    public function create(
        array|StorageCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $storageID Storage id
     * @param array<string,mixed>|StorageUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<StorageListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
