<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\TranscodingsRawContract;
use Chunkify\Transcodings\Transcoding;
use Chunkify\Transcodings\TranscodingCreateParams;
use Chunkify\Transcodings\TranscodingCreateStorageParams;
use Chunkify\Transcodings\TranscodingDeleteParams;
use Chunkify\Transcodings\TranscodingListParams;
use Chunkify\Transcodings\TranscodingListParams\Created;
use Chunkify\Transcodings\TranscodingStatus;

/**
 * @phpstan-import-type TranscodingCreateFormatParamsShape from \Chunkify\Transcodings\TranscodingCreateFormatParams
 * @phpstan-import-type TranscodingCreateStorageParamsShape from \Chunkify\Transcodings\TranscodingCreateStorageParams
 * @phpstan-import-type CreatedShape from \Chunkify\Transcodings\TranscodingListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class TranscodingsRawService implements TranscodingsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a standalone file export with resolved encoding settings.
     *
     * @param array{
     *   format: TranscodingCreateFormatParamsShape,
     *   sourceID: string,
     *   metadata?: array<string,string>,
     *   storage?: TranscodingCreateStorageParams|TranscodingCreateStorageParamsShape,
     * }|TranscodingCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Transcoding>
     *
     * @throws APIException
     */
    public function create(
        array|TranscodingCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TranscodingCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'transcodings',
            body: (object) $parsed,
            unwrap: 'data',
            options: $options,
            convert: Transcoding::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve the accepted settings, published files and current state of one Transcoding.
     *
     * @param string $transcodingID transcodingId identifies a Transcoding in the authenticated Project
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Transcoding>
     *
     * @throws APIException
     */
    public function retrieve(
        string $transcodingID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['transcodings/%1$s', $transcodingID],
            unwrap: 'data',
            options: $requestOptions,
            convert: Transcoding::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * List Transcodings in the authenticated Project, newest first by default.
     *
     * @param array{
     *   id?: string,
     *   created?: Created|CreatedShape,
     *   limit?: int,
     *   offset?: int,
     *   sourceID?: string,
     *   status?: TranscodingStatus|value-of<TranscodingStatus>,
     *   storageID?: string,
     * }|TranscodingListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Transcoding>>
     *
     * @throws APIException
     */
    public function list(
        array|TranscodingListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TranscodingListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'transcodings',
            query: Util::array_transform_keys(
                $parsed,
                ['sourceID' => 'source_id', 'storageID' => 'storage_id']
            ),
            options: $options,
            convert: Transcoding::class,
            page: PaginatedResults::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Delete a ready, failed, cancelled or expired Transcoding and its file records. The Source and settled usage are preserved. Customer output files remain unless delete_files is true; temporary files retain their original 24-hour expiry. Deletion remains available for inactive teams.
     *
     * @param string $transcodingID transcodingId identifies a Transcoding in the authenticated Project
     * @param array{deleteFiles?: bool}|TranscodingDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $transcodingID,
        array|TranscodingDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TranscodingDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['transcodings/%1$s', $transcodingID],
            query: Util::array_transform_keys(
                $parsed,
                ['deleteFiles' => 'delete_files']
            ),
            options: $options,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Cancel a preparing Transcoding and release its unpaid reservation. Repeating an accepted cancellation succeeds.
     *
     * @param string $transcodingID transcodingId identifies a Transcoding in the authenticated Project
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function cancel(
        string $transcodingID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['transcodings/%1$s/cancel', $transcodingID],
            options: $requestOptions,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }
}
