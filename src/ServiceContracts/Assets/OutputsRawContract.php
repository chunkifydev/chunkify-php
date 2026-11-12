<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Assets;

use Chunkify\Assets\Outputs\AssetOutput\AssetCaptionOutput;
use Chunkify\Assets\Outputs\AssetOutput\AssetStaticRenditionOutput;
use Chunkify\Assets\Outputs\AssetOutput\AssetThumbnailOutput;
use Chunkify\Assets\Outputs\AssetOutput\AssetTranscriptOutput;
use Chunkify\Assets\Outputs\OutputCreateParams;
use Chunkify\Assets\Outputs\OutputDeleteParams;
use Chunkify\Assets\Outputs\OutputListParams;
use Chunkify\Assets\Outputs\OutputRetrieveParams;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface OutputsRawContract
{
    /**
     * @api
     *
     * @param string $assetID assetId identifies the Asset that owns the output within the authenticated Project
     * @param array<string,mixed>|OutputCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetCaptionOutput|AssetStaticRenditionOutput|AssetThumbnailOutput|AssetTranscriptOutput,>
     *
     * @throws APIException
     */
    public function create(
        string $assetID,
        array|OutputCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $outputID outputId identifies an output owned by this Asset
     * @param array<string,mixed>|OutputRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetCaptionOutput|AssetStaticRenditionOutput|AssetThumbnailOutput|AssetTranscriptOutput,>
     *
     * @throws APIException
     */
    public function retrieve(
        string $outputID,
        array|OutputRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $assetID ID of the Asset
     * @param array<string,mixed>|OutputListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<AssetCaptionOutput|AssetStaticRenditionOutput|AssetThumbnailOutput|AssetTranscriptOutput,>,>
     *
     * @throws APIException
     */
    public function list(
        string $assetID,
        array|OutputListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $outputID path param: OutputId identifies the output belonging to this Asset
     * @param array<string,mixed>|OutputDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $outputID,
        array|OutputDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
