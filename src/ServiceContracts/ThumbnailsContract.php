<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Thumbnails\Thumbnail;
use Chunkify\Thumbnails\ThumbnailCreateStorageParams;
use Chunkify\Thumbnails\ThumbnailFormat;
use Chunkify\Thumbnails\ThumbnailListParams\Created;
use Chunkify\Thumbnails\ThumbnailOutput;
use Chunkify\Thumbnails\ThumbnailRangeParams;
use Chunkify\Thumbnails\ThumbnailStatus;

/**
 * @phpstan-import-type ThumbnailRangeParamsShape from \Chunkify\Thumbnails\ThumbnailRangeParams
 * @phpstan-import-type ThumbnailCreateStorageParamsShape from \Chunkify\Thumbnails\ThumbnailCreateStorageParams
 * @phpstan-import-type CreatedShape from \Chunkify\Thumbnails\ThumbnailListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface ThumbnailsContract
{
    /**
     * @api
     *
     * @param string $sourceID sourceId identifies a video Source in this Project
     * @param int $count count specifies 1 to 100 thumbnails at the middle of equal sections of the selected range
     * @param ThumbnailFormat|value-of<ThumbnailFormat> $format Format selects JPEG or WebP. Defaults to JPEG.
     * @param array<string,string> $metadata Metadata attaches string values to this request. The serialized object may contain at most 2048 bytes.
     * @param ThumbnailOutput|value-of<ThumbnailOutput> $output Output selects images or sprites. Defaults to images.
     * @param ThumbnailRangeParams|ThumbnailRangeParamsShape $range Range limits sampling to part of the Source. Defaults to the whole Source duration.
     * @param int $size Size specifies the maximum image or tile edge in pixels, from 64 to 1920. Defaults to 320. Odd sizes are supported. Preserves display aspect ratio without cropping or upscaling.
     * @param ThumbnailCreateStorageParams|ThumbnailCreateStorageParamsShape $storage Storage overrides the Project output destination and names the output files. Source storage remains independent.
     * @param list<float> $timestamps Timestamps specifies 1 to 100 Source-relative target times in seconds. Every time must be within the selected range. Repeated targets produce separate outputs.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $sourceID,
        ?int $count = null,
        ThumbnailFormat|string|null $format = null,
        ?array $metadata = null,
        ThumbnailOutput|string|null $output = null,
        ThumbnailRangeParams|array|null $range = null,
        int $size = 320,
        ThumbnailCreateStorageParams|array|null $storage = null,
        ?array $timestamps = null,
        RequestOptions|array|null $requestOptions = null,
    ): Thumbnail;

    /**
     * @api
     *
     * @param string $thumbnailID thumbnailId identifies a Thumbnail in the authenticated Project
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $thumbnailID,
        RequestOptions|array|null $requestOptions = null
    ): Thumbnail;

    /**
     * @api
     *
     * @param string $id Id filters by an exact Thumbnail ID. Omit to include all matching resources.
     * @param Created|CreatedShape $created
     * @param int $limit maximum number of Thumbnails to return
     * @param int $offset number of Thumbnails to skip
     * @param string $sourceID Filter Thumbnails linked to this Source. Omit to include Thumbnails from all Sources in the Project.
     * @param ThumbnailStatus|value-of<ThumbnailStatus> $status filter by Thumbnail status
     * @param string $storageID filter by output Storage ID
     * @param RequestOpts|null $requestOptions
     *
     * @return PaginatedResults<Thumbnail>
     *
     * @throws APIException
     */
    public function list(
        ?string $id = null,
        Created|array|null $created = null,
        int $limit = 100,
        int $offset = 0,
        ?string $sourceID = null,
        ThumbnailStatus|string|null $status = null,
        ?string $storageID = null,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults;

    /**
     * @api
     *
     * @param string $thumbnailID thumbnailId identifies a Thumbnail in the authenticated Project
     * @param bool $deleteFiles DeleteFiles specifies whether to permanently delete this Thumbnail's owned images, sprite sheets, VTT and partial outputs at their saved storage prefix. Defaults to false. The Source and unrelated files are preserved. If deletion fails, records remain for retry, but some files may already be deleted. Temporary outputs still expire when this option is false.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $thumbnailID,
        bool $deleteFiles = false,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
