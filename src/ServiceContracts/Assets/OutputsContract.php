<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Assets;

use Chunkify\Assets\AssetCaptionOutput;
use Chunkify\Assets\AssetCaptionOutputCreateParams;
use Chunkify\Assets\AssetStaticRenditionOutput;
use Chunkify\Assets\AssetStaticRenditionOutputCreateParams;
use Chunkify\Assets\AssetThumbnailOutput;
use Chunkify\Assets\AssetThumbnailOutputCreateParams;
use Chunkify\Assets\AssetTranscriptOutput;
use Chunkify\Assets\AssetTranscriptOutputCreateParams;
use Chunkify\Assets\Outputs\OutputListParams\Status;
use Chunkify\Assets\Outputs\OutputListParams\Type;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type OutputShape from \Chunkify\Assets\Outputs\OutputCreateParams\Output
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface OutputsContract
{
    /**
     * @api
     *
     * @param string $assetID assetId identifies the Asset that owns the output within the authenticated Project
     * @param OutputShape $output Create one output for an Asset. Type selects its required, strictly validated parameters.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $assetID,
        AssetCaptionOutputCreateParams|array|AssetStaticRenditionOutputCreateParams|AssetThumbnailOutputCreateParams|AssetTranscriptOutputCreateParams $output,
        RequestOptions|array|null $requestOptions = null,
    ): AssetCaptionOutput|AssetStaticRenditionOutput|AssetThumbnailOutput|AssetTranscriptOutput;

    /**
     * @api
     *
     * @param string $outputID outputId identifies an output owned by this Asset
     * @param string $assetID ID of the Asset
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $outputID,
        string $assetID,
        RequestOptions|array|null $requestOptions = null,
    ): AssetCaptionOutput|AssetStaticRenditionOutput|AssetThumbnailOutput|AssetTranscriptOutput;

    /**
     * @api
     *
     * @param string $assetID ID of the Asset
     * @param int $limit Limit specifies the maximum number of results to return.
     * Accepts 1 to 100. Defaults to 100.
     * @param int $offset Offset specifies the number of matching results to skip.
     * Must be at least 0. Defaults to 0.
     * @param Status|value-of<Status> $status Status specifies the current output state to include. Omit it to include all states.
     * @param Type|value-of<Type> $type Type specifies the output kind to include. Omit it to include all kinds.
     * @param RequestOpts|null $requestOptions
     *
     * @return PaginatedResults<AssetCaptionOutput|AssetStaticRenditionOutput|AssetThumbnailOutput|AssetTranscriptOutput,>
     *
     * @throws APIException
     */
    public function list(
        string $assetID,
        int $limit = 100,
        int $offset = 0,
        Status|string|null $status = null,
        Type|string|null $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults;

    /**
     * @api
     *
     * @param string $outputID path param: OutputId identifies the output belonging to this Asset
     * @param string $assetID path param: AssetId identifies the Asset that owns the output within the authenticated Project
     * @param bool $deleteFiles Query param: DeleteFiles specifies whether to remove this output's published media files from Storage. Defaults to false, preserving those files. Transcript deletion always schedules removal of its private text and saved subtitle copy, regardless of this option. The Asset, Source, and other outputs are preserved. File cleanup failures retain the output record for retry; files already removed cannot be restored.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $outputID,
        string $assetID,
        bool $deleteFiles = false,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
