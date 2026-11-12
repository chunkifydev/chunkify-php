<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Assets\Workflow;

use Chunkify\Assets\Workflow\Actions\ActionListParams;
use Chunkify\Assets\Workflow\AssetActionRun;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface ActionsRawContract
{
    /**
     * @api
     *
     * @param string $assetID ID of the Asset
     * @param array<string,mixed>|ActionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<AssetActionRun>>
     *
     * @throws APIException
     */
    public function list(
        string $assetID,
        array|ActionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
