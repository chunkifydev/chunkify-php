<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\SourcesRawContract;
use Chunkify\Sources\Source;
use Chunkify\Sources\SourceCreateParams;
use Chunkify\Sources\SourceCreateParams\Storage;
use Chunkify\Sources\SourceListParams;
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
final class SourcesRawService implements SourcesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new source from a media URL. The source will be analyzed to extract metadata and generate a thumbnail. The source will be automatically deleted after the data retention period.
     *
     * @param array{
     *   metadata?: array<string,string>, storage?: Storage|StorageShape, url?: string
     * }|SourceCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Source>
     *
     * @throws APIException
     */
    public function create(
        array|SourceCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SourceCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/sources',
            body: (object) $parsed,
            unwrap: 'data',
            options: $options,
            convert: Source::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve details of a specific source by its ID, including metadata, media properties, and associated jobs.
     *
     * @param string $sourceID Source ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Source>
     *
     * @throws APIException
     */
    public function retrieve(
        string $sourceID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/sources/%1$s', $sourceID],
            unwrap: 'data',
            options: $requestOptions,
            convert: Source::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve a list of all sources with optional filtering and pagination. Supports filtering by various media properties like duration, dimensions, codecs, etc.
     *
     * @param array{
     *   id?: string,
     *   audioCodec?: string,
     *   created?: Created|CreatedShape,
     *   device?: Device|value-of<Device>,
     *   duration?: Duration|DurationShape,
     *   height?: Height|HeightShape,
     *   limit?: int,
     *   metadata?: list<list<string>>,
     *   offset?: int,
     *   size?: Size|SizeShape,
     *   videoCodec?: string,
     *   width?: Width|WidthShape,
     * }|SourceListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Source>>
     *
     * @throws APIException
     */
    public function list(
        array|SourceListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SourceListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/sources',
            query: Util::array_transform_keys(
                $parsed,
                ['audioCodec' => 'audio_codec', 'videoCodec' => 'video_codec']
            ),
            options: $options,
            convert: Source::class,
            page: PaginatedResults::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Delete a source. It will fail if there are processing jobs using this source.
     *
     * @param string $sourceID Source id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $sourceID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['api/sources/%1$s', $sourceID],
            options: $requestOptions,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }
}
