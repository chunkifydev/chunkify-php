<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\Files\FileListParams;
use Chunkify\Files\FileListParams\Created;
use Chunkify\Files\FileListParams\Duration;
use Chunkify\Files\FileListParams\Height;
use Chunkify\Files\FileListParams\Path;
use Chunkify\Files\FileListParams\Size;
use Chunkify\Files\FileListParams\Width;
use Chunkify\Files\JobFile;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\FilesRawContract;

/**
 * @phpstan-import-type CreatedShape from \Chunkify\Files\FileListParams\Created
 * @phpstan-import-type DurationShape from \Chunkify\Files\FileListParams\Duration
 * @phpstan-import-type HeightShape from \Chunkify\Files\FileListParams\Height
 * @phpstan-import-type PathShape from \Chunkify\Files\FileListParams\Path
 * @phpstan-import-type SizeShape from \Chunkify\Files\FileListParams\Size
 * @phpstan-import-type WidthShape from \Chunkify\Files\FileListParams\Width
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class FilesRawService implements FilesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve details of a specific file by its ID, including metadata, media properties, and associated jobs.
     *
     * @param string $fileID File ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JobFile>
     *
     * @throws APIException
     */
    public function retrieve(
        string $fileID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/files/%1$s', $fileID],
            unwrap: 'data',
            options: $requestOptions,
            convert: JobFile::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve a list of files with optional filtering and pagination
     *
     * @param array{
     *   id?: string,
     *   audioCodec?: string,
     *   created?: Created|CreatedShape,
     *   duration?: Duration|DurationShape,
     *   height?: Height|HeightShape,
     *   jobID?: string,
     *   limit?: int,
     *   mimeType?: string,
     *   offset?: int,
     *   path?: Path|PathShape,
     *   size?: Size|SizeShape,
     *   storageID?: string,
     *   videoCodec?: string,
     *   width?: Width|WidthShape,
     * }|FileListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<JobFile>>
     *
     * @throws APIException
     */
    public function list(
        array|FileListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = FileListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/files',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'audioCodec' => 'audio_codec',
                    'jobID' => 'job_id',
                    'mimeType' => 'mime_type',
                    'storageID' => 'storage_id',
                    'videoCodec' => 'video_codec',
                ],
            ),
            options: $options,
            convert: JobFile::class,
            page: PaginatedResults::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Delete a file. It will fail if there are processing jobs using this file.
     *
     * @param string $fileID File id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $fileID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['api/files/%1$s', $fileID],
            options: $requestOptions,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }
}
