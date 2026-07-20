<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Jobs;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Jobs\Logs\LogListParams;
use Chunkify\Jobs\Logs\LogListResponse;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface LogsRawContract
{
    /**
     * @api
     *
     * @param string $jobID Job ID
     * @param array<string,mixed>|LogListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LogListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $jobID,
        array|LogListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
