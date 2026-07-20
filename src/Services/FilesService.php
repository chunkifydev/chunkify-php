<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\Files\FileListParams\Created;
use Chunkify\Files\FileListParams\Duration;
use Chunkify\Files\FileListParams\Height;
use Chunkify\Files\FileListParams\Path;
use Chunkify\Files\FileListParams\Size;
use Chunkify\Files\FileListParams\Width;
use Chunkify\Files\JobFile;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\FilesContract;

/**
 * @phpstan-import-type CreatedShape from \Chunkify\Files\FileListParams\Created
 * @phpstan-import-type DurationShape from \Chunkify\Files\FileListParams\Duration
 * @phpstan-import-type HeightShape from \Chunkify\Files\FileListParams\Height
 * @phpstan-import-type PathShape from \Chunkify\Files\FileListParams\Path
 * @phpstan-import-type SizeShape from \Chunkify\Files\FileListParams\Size
 * @phpstan-import-type WidthShape from \Chunkify\Files\FileListParams\Width
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class FilesService implements FilesContract
{
    /**
     * @api
     */
    public FilesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FilesRawService($client);
    }

    /**
     * @api
     *
     * Retrieve details of a specific file by its ID, including metadata, media properties, and associated jobs.
     *
     * @param string $fileID File ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $fileID,
        RequestOptions|array|null $requestOptions = null
    ): JobFile {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($fileID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a list of files with optional filtering and pagination
     *
     * @param string $id Filter by file ID
     * @param string $audioCodec Filter by audio codec
     * @param Created|CreatedShape $created
     * @param Duration|DurationShape $duration
     * @param Height|HeightShape $height
     * @param string $jobID Filter by job ID
     * @param int $limit Pagination limit (max 100)
     * @param string $mimeType Filter by mime type
     * @param int $offset Pagination offset
     * @param Path|PathShape $path
     * @param Size|SizeShape $size
     * @param string $storageID Filter by storage ID
     * @param string $videoCodec Filter by video codec
     * @param Width|WidthShape $width
     * @param RequestOpts|null $requestOptions
     *
     * @return PaginatedResults<JobFile>
     *
     * @throws APIException
     */
    public function list(
        ?string $id = null,
        ?string $audioCodec = null,
        Created|array|null $created = null,
        Duration|array|null $duration = null,
        Height|array|null $height = null,
        ?string $jobID = null,
        int $limit = 100,
        ?string $mimeType = null,
        int $offset = 0,
        Path|array|null $path = null,
        Size|array|null $size = null,
        ?string $storageID = null,
        ?string $videoCodec = null,
        Width|array|null $width = null,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'audioCodec' => $audioCodec,
                'created' => $created,
                'duration' => $duration,
                'height' => $height,
                'jobID' => $jobID,
                'limit' => $limit,
                'mimeType' => $mimeType,
                'offset' => $offset,
                'path' => $path,
                'size' => $size,
                'storageID' => $storageID,
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
     * Delete a file. It will fail if there are processing jobs using this file.
     *
     * @param string $fileID File id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $fileID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($fileID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
