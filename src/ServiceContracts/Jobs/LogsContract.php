<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Jobs;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\Jobs\Logs\LogListParams\Service;
use Chunkify\Jobs\Logs\LogListResponse;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface LogsContract
{
    /**
     * @api
     *
     * @param string $jobID Job ID
     * @param Service|value-of<Service> $service Service type (transcoder or manager)
     * @param int $transcoderID Transcoder ID (required if service is transcoder)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $jobID,
        Service|string $service,
        ?int $transcoderID = null,
        RequestOptions|array|null $requestOptions = null,
    ): LogListResponse;
}
