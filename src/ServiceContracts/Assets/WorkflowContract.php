<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Assets;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\RequestOptions;
use Chunkify\Workflows\Runs\WorkflowRun;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface WorkflowContract
{
    /**
     * @api
     *
     * @param string $assetID ID of the Asset whose Workflow revision to update
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $assetID,
        RequestOptions|array|null $requestOptions = null
    ): WorkflowRun;
}
