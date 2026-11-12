<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Assets;

use Chunkify\Assets\Workflow\AssetActionRun;
use Chunkify\Assets\Workflow\WorkflowListActionsParams;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Workflows\Runs\WorkflowRun;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface WorkflowRawContract
{
    /**
     * @api
     *
     * @param string $assetID ID of the Asset whose Workflow revision to update
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkflowRun>
     *
     * @throws APIException
     */
    public function update(
        string $assetID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $assetID ID of the Asset
     * @param array<string,mixed>|WorkflowListActionsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<AssetActionRun>>
     *
     * @throws APIException
     */
    public function listActions(
        string $assetID,
        array|WorkflowListActionsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
