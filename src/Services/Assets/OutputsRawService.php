<?php

declare(strict_types=1);

namespace Chunkify\Services\Assets;

use Chunkify\Assets\Outputs\AssetOutput;
use Chunkify\Assets\Outputs\AssetOutput\AssetCaptionOutput;
use Chunkify\Assets\Outputs\AssetOutput\AssetStaticRenditionOutput;
use Chunkify\Assets\Outputs\AssetOutput\AssetThumbnailOutput;
use Chunkify\Assets\Outputs\AssetOutput\AssetTranscriptOutput;
use Chunkify\Assets\Outputs\OutputCreateParams;
use Chunkify\Assets\Outputs\OutputDeleteParams;
use Chunkify\Assets\Outputs\OutputListParams;
use Chunkify\Assets\Outputs\OutputListParams\Status;
use Chunkify\Assets\Outputs\OutputListParams\Type;
use Chunkify\Assets\Outputs\OutputRetrieveParams;
use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Assets\OutputsRawContract;

/**
 * Automatic video-on-demand Assets and independent H.264 MP4 static renditions.
 *
 * @phpstan-import-type OutputShape from \Chunkify\Assets\Outputs\OutputCreateParams\Output
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class OutputsRawService implements OutputsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create one caption, static rendition or additional thumbnail output. The accepted output processes asynchronously and is returned in the same envelope as output reads.
     *
     * @param string $assetID assetId identifies the Asset that owns the output within the authenticated Project
     * @param array{output: OutputShape}|OutputCreateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = OutputCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['assets/%1$s/outputs', $assetID],
            body: (object) $parsed['output'],
            unwrap: 'data',
            options: $options,
            convert: AssetOutput::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve one output belonging to the specified Asset and authenticated Project. Delivery URLs follow the output resource retention and expiry rules.
     *
     * @param string $outputID outputId identifies an output owned by this Asset
     * @param array{assetID: string}|OutputRetrieveParams $params
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
    ): BaseResponse {
        [$parsed, $options] = OutputRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $assetID = $parsed['assetID'];
        unset($parsed['assetID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['assets/%1$s/outputs/%2$s', $assetID, $outputID],
            unwrap: 'data',
            options: $options,
            convert: AssetOutput::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * List outputs requested directly or by a Workflow. Results are ordered by creation date, newest first, with descending output ID as a tie-breaker. Pagination and total apply after type and status filters. Core playback, poster and default timeline previews remain on the Asset.
     *
     * @param string $assetID ID of the Asset
     * @param array{
     *   limit?: int,
     *   offset?: int,
     *   status?: Status|value-of<Status>,
     *   type?: Type|value-of<Type>,
     * }|OutputListParams $params
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
    ): BaseResponse {
        [$parsed, $options] = OutputListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['assets/%1$s/outputs', $assetID],
            query: $parsed,
            options: $options,
            convert: AssetOutput::class,
            page: PaginatedResults::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Delete one output belonging to this Asset and Project. Its type is resolved from the output ID. Type-specific processing and dependency restrictions still apply.
     *
     * @param string $outputID path param: OutputId identifies the output belonging to this Asset
     * @param array{assetID: string, deleteFiles?: bool}|OutputDeleteParams $params
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
    ): BaseResponse {
        [$parsed, $options] = OutputDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $assetID = $parsed['assetID'];
        unset($parsed['assetID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['assets/%1$s/outputs/%2$s', $assetID, $outputID],
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
