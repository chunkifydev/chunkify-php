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
use Chunkify\Uploads\UploadCreateParams;
use Chunkify\Uploads\UploadCreateParams\Storage;
use Chunkify\Uploads\UploadListParams;
use Chunkify\Uploads\UploadListParams\Created;
use Chunkify\Uploads\UploadListParams\Status;

/**
 * @phpstan-import-type StorageShape from \Chunkify\Uploads\UploadCreateParams\Storage
 * @phpstan-import-type CreatedShape from \Chunkify\Uploads\UploadListParams\Created
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
     * Create a new upload with the specified name.
     *
     * @param array{
     *   metadata?: array<string,string>,
     *   storage?: Storage|StorageShape,
     *   validityTimeout?: int,
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
            path: 'api/uploads',
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
            path: ['api/uploads/%1$s', $uploadID],
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
            path: 'api/uploads',
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
            path: ['api/uploads/%1$s', $uploadID],
            options: $requestOptions,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }
}
