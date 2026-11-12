<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Workflows;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Workflows\Runs\RunListParams\Created;
use Chunkify\Workflows\Runs\RunListParams\Status;
use Chunkify\Workflows\Runs\WorkflowRun;

/**
 * @phpstan-import-type CreatedShape from \Chunkify\Workflows\Runs\RunListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface RunsContract
{
    /**
     * @api
     *
     * @param string $runID ID of the Workflow run
     * @param string $workflowID ID of the Workflow
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $runID,
        string $workflowID,
        RequestOptions|array|null $requestOptions = null,
    ): WorkflowRun;

    /**
     * @api
     *
     * @param string $workflowID ID of the Workflow
     * @param string $assetID AssetId specifies the Asset whose results to return. Omit it to include all Assets.
     * @param Created|CreatedShape $created
     * @param string $eventID EventId specifies the triggering event ID to filter by. Omit it to include all events.
     * @param bool $latestPerAsset LatestPerAsset specifies whether to return only the latest matching run for each Asset. Defaults to false. Pagination and total count apply to Assets when true.
     * @param int $limit Limit specifies the maximum number of results to return.
     * Accepts 1 to 100. Defaults to 100.
     * @param int $offset Offset specifies the number of matching results to skip.
     * Must be at least 0. Defaults to 0.
     * @param Status|value-of<Status> $status Status specifies the run status to filter by. Omit it to include all statuses.
     * @param RequestOpts|null $requestOptions
     *
     * @return PaginatedResults<WorkflowRun>
     *
     * @throws APIException
     */
    public function list(
        string $workflowID,
        ?string $assetID = null,
        Created|array|null $created = null,
        ?string $eventID = null,
        bool $latestPerAsset = false,
        int $limit = 100,
        int $offset = 0,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults;
}
