<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Jobs;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Jobs\Files\FileListResponse;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface FilesRawContract
{
    /**
     * @api
     *
     * @param string $jobID Job ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
