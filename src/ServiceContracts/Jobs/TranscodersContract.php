<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Jobs;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\Jobs\Transcoders\TranscoderListResponse;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface TranscodersContract
{
    /**
     * @api
     *
     * @param string $jobID Job ID to get status for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): TranscoderListResponse;
}
