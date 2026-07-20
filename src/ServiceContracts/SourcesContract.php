<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Sources\Source;
use Chunkify\Sources\SourceListParams\Created;
use Chunkify\Sources\SourceListParams\Device;
use Chunkify\Sources\SourceListParams\Duration;
use Chunkify\Sources\SourceListParams\Height;
use Chunkify\Sources\SourceListParams\Size;
use Chunkify\Sources\SourceListParams\Width;

/**
 * @phpstan-import-type CreatedShape from \Chunkify\Sources\SourceListParams\Created
 * @phpstan-import-type DurationShape from \Chunkify\Sources\SourceListParams\Duration
 * @phpstan-import-type HeightShape from \Chunkify\Sources\SourceListParams\Height
 * @phpstan-import-type SizeShape from \Chunkify\Sources\SourceListParams\Size
 * @phpstan-import-type WidthShape from \Chunkify\Sources\SourceListParams\Width
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface SourcesContract
{
    /**
     * @api
     *
     * @param string $url url is the URL of the source, which must be a valid HTTP URL
     * @param array<string,string> $metadata metadata allows for additional information to be attached to the source, with a maximum size of 2048 bytes
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $url,
        ?array $metadata = null,
        RequestOptions|array|null $requestOptions = null,
    ): Source;

    /**
     * @api
     *
     * @param string $sourceID Source ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $sourceID,
        RequestOptions|array|null $requestOptions = null
    ): Source;

    /**
     * @api
     *
     * @param string $id Filter by source ID
     * @param string $audioCodec Filter by audio codec
     * @param Created|CreatedShape $created
     * @param Device|value-of<Device> $device Filter by device (apple/android)
     * @param Duration|DurationShape $duration
     * @param Height|HeightShape $height
     * @param int $limit Pagination limit (max 100)
     * @param list<list<string>> $metadata Filter by metadata
     * @param int $offset Pagination offset
     * @param Size|SizeShape $size
     * @param string $videoCodec Filter by video codec
     * @param Width|WidthShape $width
     * @param RequestOpts|null $requestOptions
     *
     * @return PaginatedResults<Source>
     *
     * @throws APIException
     */
    public function list(
        ?string $id = null,
        ?string $audioCodec = null,
        Created|array|null $created = null,
        Device|string|null $device = null,
        Duration|array|null $duration = null,
        Height|array|null $height = null,
        int $limit = 100,
        ?array $metadata = null,
        int $offset = 0,
        Size|array|null $size = null,
        ?string $videoCodec = null,
        Width|array|null $width = null,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults;

    /**
     * @api
     *
     * @param string $sourceID Source id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $sourceID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
