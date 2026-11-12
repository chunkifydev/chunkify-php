<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Thumbnails\Thumbnail;
use Chunkify\Thumbnails\ThumbnailCreateParams\Format;
use Chunkify\Thumbnails\ThumbnailCreateParams\Output;
use Chunkify\Thumbnails\ThumbnailCreateParams\Range;
use Chunkify\Thumbnails\ThumbnailCreateStorage;
use Chunkify\Thumbnails\ThumbnailListParams\Created;
use Chunkify\Thumbnails\ThumbnailListParams\Status;

/**
 * @phpstan-import-type RangeShape from \Chunkify\Thumbnails\ThumbnailCreateParams\Range
 * @phpstan-import-type ThumbnailCreateStorageShape from \Chunkify\Thumbnails\ThumbnailCreateStorage
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
     * @param Format|value-of<Format> $format Format selects JPEG or WebP. Defaults to JPEG.
     * @param array<string,string> $metadata Metadata attaches string values to this request. The serialized object may contain at most 2048 bytes.
     * @param Output|value-of<Output> $output Output selects images or sprites. Defaults to images.
     * @param Range|RangeShape $range Range limits sampling to part of the Source. Defaults to the whole Source duration.
     * @param int $size Size specifies the maximum image or tile edge in pixels, from 64 to 1920. Defaults to 320. Odd sizes are supported. Preserves display aspect ratio without cropping or upscaling.
     * @param ThumbnailCreateStorage|ThumbnailCreateStorageShape $storage Storage overrides the Project output destination and names the output files. Source storage remains independent.
     * @param list<float> $timestamps Timestamps specifies 1 to 100 Source-relative target times in seconds. Every time must be within the selected range. Repeated targets produce separate outputs.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $sourceID,
        ?int $count = null,
        Format|string $format = 'jpeg',
        ?array $metadata = null,
        Output|string $output = 'images',
        Range|array|null $range = null,
        int $size = 320,
        ThumbnailCreateStorage|array|null $storage = null,
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
     * @param Status|value-of<Status> $status filter by Thumbnail status
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
        Status|string|null $status = null,
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
