<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Assets\Asset;
use Chunkify\Assets\AssetCreateParams;
use Chunkify\Assets\AssetDeleteParams;
use Chunkify\Assets\AssetListParams;
use Chunkify\Assets\AssetUpdateParams;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface AssetsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AssetCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Asset>
     *
     * @throws APIException
     */
    public function create(
        array|AssetCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Asset>
     *
     * @throws APIException
     */
    public function retrieve(
        string $assetID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AssetUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $assetID,
        array|AssetUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AssetListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Asset>>
     *
     * @throws APIException
     */
    public function list(
        array|AssetListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AssetDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $assetID,
        array|AssetDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
