<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\SourcesContract;
use Chunkify\Sources\Source;
use Chunkify\Sources\SourceCreateParams\Storage;
use Chunkify\Sources\SourceListParams\Created;
use Chunkify\Sources\SourceListParams\Device;
use Chunkify\Sources\SourceListParams\Duration;
use Chunkify\Sources\SourceListParams\Height;
use Chunkify\Sources\SourceListParams\Size;
use Chunkify\Sources\SourceListParams\Width;

/**
 * @phpstan-import-type StorageShape from \Chunkify\Sources\SourceCreateParams\Storage
 * @phpstan-import-type CreatedShape from \Chunkify\Sources\SourceListParams\Created
 * @phpstan-import-type DurationShape from \Chunkify\Sources\SourceListParams\Duration
 * @phpstan-import-type HeightShape from \Chunkify\Sources\SourceListParams\Height
 * @phpstan-import-type SizeShape from \Chunkify\Sources\SourceListParams\Size
 * @phpstan-import-type WidthShape from \Chunkify\Sources\SourceListParams\Width
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class SourcesService implements SourcesContract
{
    /**
     * @api
     */
    public SourcesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SourcesRawService($client);
    }

    /**
     * @api
     *
     * Create a new source from a media URL. The source will be analyzed to extract metadata and generate a thumbnail. The source will be automatically deleted after the data retention period.
     *
     * @param array<string,string> $metadata metadata allows for additional information to be attached to the source, with a maximum size of 2048 bytes
     * @param Storage|StorageShape $storage Storage input configuration. Provide this or url, never both.
     * @param string $url url is the URL of the source, which must be a valid HTTP URL
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?array $metadata = null,
        Storage|array|null $storage = null,
        ?string $url = null,
        RequestOptions|array|null $requestOptions = null,
    ): Source {
        $params = Util::removeNulls(
            ['metadata' => $metadata, 'storage' => $storage, 'url' => $url]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve details of a specific source by its ID, including metadata, media properties, and associated jobs.
     *
     * @param string $sourceID Source ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $sourceID,
        RequestOptions|array|null $requestOptions = null
    ): Source {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($sourceID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a list of all sources with optional filtering and pagination. Supports filtering by various media properties like duration, dimensions, codecs, etc.
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
    ): PaginatedResults {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'audioCodec' => $audioCodec,
                'created' => $created,
                'device' => $device,
                'duration' => $duration,
                'height' => $height,
                'limit' => $limit,
                'metadata' => $metadata,
                'offset' => $offset,
                'size' => $size,
                'videoCodec' => $videoCodec,
                'width' => $width,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a source. It will fail if there are processing jobs using this source.
     *
     * @param string $sourceID Source id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $sourceID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($sourceID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
