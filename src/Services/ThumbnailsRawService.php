<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\ThumbnailsRawContract;
use Chunkify\Thumbnails\Thumbnail;
use Chunkify\Thumbnails\ThumbnailCreateParams;
use Chunkify\Thumbnails\ThumbnailCreateParams\Format;
use Chunkify\Thumbnails\ThumbnailCreateParams\Output;
use Chunkify\Thumbnails\ThumbnailCreateParams\Range;
use Chunkify\Thumbnails\ThumbnailCreateStorage;
use Chunkify\Thumbnails\ThumbnailDeleteParams;
use Chunkify\Thumbnails\ThumbnailListParams;
use Chunkify\Thumbnails\ThumbnailListParams\Created;
use Chunkify\Thumbnails\ThumbnailListParams\Status;

/**
 * @phpstan-import-type RangeShape from \Chunkify\Thumbnails\ThumbnailCreateParams\Range
 * @phpstan-import-type ThumbnailCreateStorageShape from \Chunkify\Thumbnails\ThumbnailCreateStorage
 * @phpstan-import-type CreatedShape from \Chunkify\Thumbnails\ThumbnailListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class ThumbnailsRawService implements ThumbnailsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Generate individual images or sprite sheets from a Source. Each accepted request creates a new resource. Processing continues after the response.
     *
     * @param array{
     *   sourceID: string,
     *   count?: int,
     *   format?: Format|value-of<Format>,
     *   metadata?: array<string,string>,
     *   output?: Output|value-of<Output>,
     *   range?: Range|RangeShape,
     *   size?: int,
     *   storage?: ThumbnailCreateStorage|ThumbnailCreateStorageShape,
     *   timestamps?: list<float>,
     * }|ThumbnailCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Thumbnail>
     *
     * @throws APIException
     */
    public function create(
        array|ThumbnailCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ThumbnailCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'thumbnails',
            body: (object) $parsed,
            unwrap: 'data',
            options: $options,
            convert: Thumbnail::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve the accepted settings, published files and current state of one Thumbnail.
     *
     * @param string $thumbnailID thumbnailId identifies a Thumbnail in the authenticated Project
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Thumbnail>
     *
     * @throws APIException
     */
    public function retrieve(
        string $thumbnailID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['thumbnails/%1$s', $thumbnailID],
            unwrap: 'data',
            options: $requestOptions,
            convert: Thumbnail::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * List Thumbnails in the authenticated Project, newest first by default.
     *
     * @param array{
     *   id?: string,
     *   created?: Created|CreatedShape,
     *   limit?: int,
     *   offset?: int,
     *   sourceID?: string,
     *   status?: Status|value-of<Status>,
     *   storageID?: string,
     * }|ThumbnailListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Thumbnail>>
     *
     * @throws APIException
     */
    public function list(
        array|ThumbnailListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ThumbnailListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'thumbnails',
            query: Util::array_transform_keys(
                $parsed,
                ['sourceID' => 'source_id', 'storageID' => 'storage_id']
            ),
            options: $options,
            convert: Thumbnail::class,
            page: PaginatedResults::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Delete a ready, failed or expired Thumbnail after all workers have stopped. The Source and settled usage are preserved. Files remain unless delete_files is true; temporary files retain their original 24-hour expiry. Deletion remains available for inactive teams.
     *
     * @param string $thumbnailID thumbnailId identifies a Thumbnail in the authenticated Project
     * @param array{deleteFiles?: bool}|ThumbnailDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $thumbnailID,
        array|ThumbnailDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ThumbnailDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['thumbnails/%1$s', $thumbnailID],
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
