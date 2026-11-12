<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Assets;

use Chunkify\Assets\Workflow\AssetActionRun;
use Chunkify\Assets\Workflow\WorkflowListActionsParams\Created;
use Chunkify\Assets\Workflow\WorkflowListActionsParams\Status;
use Chunkify\Assets\Workflow\WorkflowListActionsParams\Type;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Workflows\Runs\WorkflowRun;

/**
 * @phpstan-import-type CreatedShape from \Chunkify\Assets\Workflow\WorkflowListActionsParams\Created
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

    /**
     * @api
     *
     * @param string $assetID ID of the Asset
     * @param Created|CreatedShape $created
     * @param bool $latestPerAction LatestPerAction specifies whether to return only the latest execution of each rule and action on the Asset. Defaults to false. Pagination and total count apply after this selection.
     * @param int $limit Limit specifies the maximum number of results to return.
     * Accepts 1 to 100. Defaults to 100.
     * @param int $offset Offset specifies the number of matching results to skip.
     * Must be at least 0. Defaults to 0.
     * @param int $revision Revision specifies the Workflow revision to filter by. Omit it to include all revisions.
     * @param Status|value-of<Status> $status Status specifies the action status to filter by. Omit it to include all statuses.
     * @param Type|value-of<Type> $type Type specifies the action type to filter by. Omit it to include all action types.
     * @param RequestOpts|null $requestOptions
     *
     * @return PaginatedResults<AssetActionRun>
     *
     * @throws APIException
     */
    public function listActions(
        string $assetID,
        Created|array|null $created = null,
        bool $latestPerAction = false,
        int $limit = 100,
        int $offset = 0,
        ?int $revision = null,
        Status|string|null $status = null,
        Type|string|null $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults;
}
