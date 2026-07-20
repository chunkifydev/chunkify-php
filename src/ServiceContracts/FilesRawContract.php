<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Files\FileListParams;
use Chunkify\Files\JobFile;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface FilesRawContract
{
    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|FileListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<JobFile>>
     *
     * @throws APIException
     */
    public function list(
        array|FileListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
