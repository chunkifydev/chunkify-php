<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Workflows\Runs;

use Chunkify\Assets\Workflow\Actions\AssetActionRun;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Workflows\Runs\Actions\ActionListParams;
use Chunkify\Workflows\Runs\Actions\ActionRetrieveParams;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface ActionsRawContract
{
    /**
     * @api
     *
     * @param string $actionRunID ID of the Asset action run
     * @param array<string,mixed>|ActionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AssetActionRun>
     *
     * @throws APIException
     */
    public function retrieve(
        string $actionRunID,
        array|ActionRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $runID path param: ID of the Workflow run
     * @param array<string,mixed>|ActionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<AssetActionRun>>
     *
     * @throws APIException
     */
    public function list(
        string $runID,
        array|ActionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
