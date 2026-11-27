<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Assets\Asset;
use Chunkify\Assets\AssetCreateParams;
use Chunkify\Assets\AssetCreateParams\MaxResolution;
use Chunkify\Assets\AssetCreateParams\MinResolution;
use Chunkify\Assets\AssetCreateStorageParams;
use Chunkify\Assets\AssetDeleteParams;
use Chunkify\Assets\AssetListParams;
use Chunkify\Assets\AssetListParams\Created;
use Chunkify\Assets\AssetStatus;
use Chunkify\Assets\AssetUpdateParams;
use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\AssetsRawContract;

/**
 * Automatic video-on-demand Assets and independent H.264 MP4 static renditions.
 *
 * @phpstan-import-type AssetCreateStorageParamsShape from \Chunkify\Assets\AssetCreateStorageParams
 * @phpstan-import-type CreatedShape from \Chunkify\Assets\AssetListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class AssetsRawService implements AssetsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create an Asset from a video Source to prepare it for streaming. Processing starts asynchronously, and the Asset is returned while it is preparing.
     *
     * @param array{
     *   sourceID: string,
     *   maxResolution?: MaxResolution|value-of<MaxResolution>,
     *   metadata?: array<string,string>,
     *   minResolution?: MinResolution|value-of<MinResolution>,
     *   pathTemplate?: string,
     *   publicPlayback?: bool,
     *   storage?: AssetCreateStorageParams|AssetCreateStorageParamsShape,
     *   title?: string,
     *   workflowID?: string|null,
     * }|AssetCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Asset>
     *
     * @throws APIException
     */
    public function create(
        array|AssetCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AssetCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'assets',
            body: (object) $parsed,
            unwrap: 'data',
            options: $options,
            convert: Asset::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve an Asset with its status, source metadata, and its streaming, static, poster, and timeline outputs, including their delivery URLs.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['assets/%1$s', $assetID],
            unwrap: 'data',
            options: $requestOptions,
            convert: Asset::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Update an Asset's title, metadata, or whether its preview can be watched without an API token. Omitted fields remain unchanged.
     *
     * @param array{
     *   metadata?: array<string,string>, publicPlayback?: bool, title?: string
     * }|AssetUpdateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = AssetUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['assets/%1$s', $assetID],
            body: (object) $parsed,
            options: $options,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * List Assets in the Project, newest first by default. Filter by status, Source, Storage, metadata, or creation date, and search by ID or title.
     *
     * @param array{
     *   created?: Created|CreatedShape,
     *   limit?: int,
     *   metadata?: list<string>,
     *   offset?: int,
     *   search?: string,
     *   sourceID?: string,
     *   status?: AssetStatus|value-of<AssetStatus>,
     *   storageID?: string,
     * }|AssetListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Asset>>
     *
     * @throws APIException
     */
    public function list(
        array|AssetListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AssetListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'assets',
            query: Util::array_transform_keys(
                $parsed,
                ['sourceID' => 'source_id', 'storageID' => 'storage_id']
            ),
            options: $options,
            convert: Asset::class,
            page: PaginatedResults::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Delete an Asset after all processing finishes. Its streaming and static files remain in your Storage unless delete_files is true.
     *
     * @param array{deleteFiles?: bool}|AssetDeleteParams $params
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
    ): BaseResponse {
        [$parsed, $options] = AssetDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['assets/%1$s', $assetID],
            query: Util::array_transform_keys(
                $parsed,
                ['deleteFiles' => 'delete_files']
            ),
            options: $options,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }
}
