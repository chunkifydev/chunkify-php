<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\UploadsRawContract;
use Chunkify\Uploads\Upload;
use Chunkify\Uploads\UploadCompleteParams;
use Chunkify\Uploads\UploadCreateParams;
use Chunkify\Uploads\UploadCreateParams\UploadMode;
use Chunkify\Uploads\UploadCreateStorageParams;
use Chunkify\Uploads\UploadListParams;
use Chunkify\Uploads\UploadListParams\Created;
use Chunkify\Uploads\UploadListParams\Status;
use Chunkify\Uploads\UploadMultipartPartParams;

/**
 * @phpstan-import-type UploadCreateStorageParamsShape from \Chunkify\Uploads\UploadCreateStorageParams
 * @phpstan-import-type CreatedShape from \Chunkify\Uploads\UploadListParams\Created
 * @phpstan-import-type UploadMultipartPartParamsShape from \Chunkify\Uploads\UploadMultipartPartParams
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class UploadsRawService implements UploadsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create an Upload session for a direct transfer to storage. Multipart creation returns every signed part URL. Retry parts with their original URLs and complete before expiry. Customer storage requires long-lived credentials and an incomplete-multipart lifecycle rule. Start a new Upload after abandoning a session.
     *
     * @param array{
     *   createAsset?: bool,
     *   fileSizeBytes?: int,
     *   metadata?: array<string,string>,
     *   storage?: UploadCreateStorageParams|UploadCreateStorageParamsShape,
     *   uploadMode?: UploadMode|value-of<UploadMode>,
     *   validityTimeout?: int,
     *   workflowID?: string|null,
     * }|UploadCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Upload>
     *
     * @throws APIException
     */
    public function create(
        array|UploadCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = UploadCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'uploads',
            body: (object) $parsed,
            unwrap: 'data',
            options: $options,
            convert: Upload::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve details of a specific upload by its ID, including metadata, status, and associated source.
     *
     * @param string $uploadID Upload ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Upload>
     *
     * @throws APIException
     */
    public function retrieve(
        string $uploadID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['uploads/%1$s', $uploadID],
            unwrap: 'data',
            options: $requestOptions,
            convert: Upload::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve a list of all uploads with optional filtering and pagination.
     *
     * @param array{
     *   id?: string,
     *   created?: Created|CreatedShape,
     *   limit?: int,
     *   metadata?: list<list<string>>,
     *   offset?: int,
     *   sourceID?: string,
     *   status?: Status|value-of<Status>,
     * }|UploadListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Upload>>
     *
     * @throws APIException
     */
    public function list(
        array|UploadListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = UploadListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'uploads',
            query: Util::array_transform_keys($parsed, ['sourceID' => 'source_id']),
            options: $options,
            convert: Upload::class,
            page: PaginatedResults::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Delete an upload.
     *
     * @param string $uploadID Upload id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $uploadID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['uploads/%1$s', $uploadID],
            options: $requestOptions,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * POST the returned completion_url before expires_at. Single-PUT Uploads send no body; multipart Uploads send every part number and storage ETag. Chunkify verifies the assembled object and atomically creates the Source and optional Asset. An Asset destination conflict returns 409 and fails the Upload without committing Source, Asset, or usage changes. Valid retries return 204 without duplicate side effects. Retry network errors, 429, and 5xx responses with bounded backoff.
     *
     * @param string $token Opaque completion capability from completion_url
     * @param array{
     *   parts?: list<UploadMultipartPartParams|UploadMultipartPartParamsShape>
     * }|UploadCompleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function complete(
        string $token,
        array|UploadCompleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = UploadCompleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['uploads/completion/%1$s', $token],
            body: (object) $parsed,
            options: $options,
            convert: null,
            security: [],
        );
    }
}
