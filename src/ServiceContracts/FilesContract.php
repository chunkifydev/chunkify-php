<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\Files\FileListParams\Created;
use Chunkify\Files\FileListParams\Duration;
use Chunkify\Files\FileListParams\Height;
use Chunkify\Files\FileListParams\Path;
use Chunkify\Files\FileListParams\Size;
use Chunkify\Files\FileListParams\Width;
use Chunkify\Files\JobFile;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type CreatedShape from \Chunkify\Files\FileListParams\Created
 * @phpstan-import-type DurationShape from \Chunkify\Files\FileListParams\Duration
 * @phpstan-import-type HeightShape from \Chunkify\Files\FileListParams\Height
 * @phpstan-import-type PathShape from \Chunkify\Files\FileListParams\Path
 * @phpstan-import-type SizeShape from \Chunkify\Files\FileListParams\Size
 * @phpstan-import-type WidthShape from \Chunkify\Files\FileListParams\Width
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface FilesContract
{
    /**
     * @api
     *
     * @param string $fileID File ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $fileID,
        RequestOptions|array|null $requestOptions = null
    ): JobFile;

    /**
     * @api
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
    ): PaginatedResults;

    /**
     * @api
     *
     * @param string $fileID File id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $fileID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
