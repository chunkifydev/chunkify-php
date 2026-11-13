<?php

declare(strict_types=1);

namespace Chunkify\Services\Workflows\Runs;

use Chunkify\Assets\Workflow\Actions\AssetActionRun;
use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Workflows\Runs\ActionsContract;
use Chunkify\Workflows\Runs\Actions\ActionListParams\Created;
use Chunkify\Workflows\Runs\Actions\ActionListParams\Status;
use Chunkify\Workflows\Runs\Actions\ActionListParams\Type;

/**
 * @phpstan-import-type CreatedShape from \Chunkify\Workflows\Runs\Actions\ActionListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class ActionsService implements ActionsContract
{
    /**
     * @api
     */
    public ActionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ActionsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve one action execution in a retained Workflow run, including its resolved inputs, status, and result.
     *
     * @param string $actionRunID ID of the Asset action run
     * @param string $workflowID ID of the Workflow
     * @param string $runID ID of the Workflow run
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $actionRunID,
        string $workflowID,
        string $runID,
        RequestOptions|array|null $requestOptions = null,
    ): AssetActionRun {
        $params = Util::removeNulls(
            ['workflowID' => $workflowID, 'runID' => $runID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($actionRunID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List actions in a retained Workflow run, newest first. Includes resolved inputs, statuses, output references, and skip or failure reasons.
     *
     * @param string $runID path param: ID of the Workflow run
     * @param string $workflowID path param: ID of the Workflow
     * @param string $assetID Query param: AssetId specifies the Asset whose results to return. Omit it to include all Assets.
     * @param Created|CreatedShape $created Query param
     * @param int $limit Query param: Limit specifies the maximum number of results to return.
     * Accepts 1 to 100. Defaults to 100.
     * @param int $offset Query param: Offset specifies the number of matching results to skip.
     * Must be at least 0. Defaults to 0.
     * @param Status|value-of<Status> $status Query param: Status specifies the action status to filter by. Omit it to include all statuses.
     * @param Type|value-of<Type> $type Query param: Type specifies the action type to filter by. Omit it to include all action types.
     * @param RequestOpts|null $requestOptions
     *
     * @return PaginatedResults<AssetActionRun>
     *
     * @throws APIException
     */
    public function list(
        string $runID,
        string $workflowID,
        ?string $assetID = null,
        Created|array|null $created = null,
        int $limit = 100,
        int $offset = 0,
        Status|string|null $status = null,
        Type|string|null $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults {
        $params = Util::removeNulls(
            [
                'workflowID' => $workflowID,
                'assetID' => $assetID,
                'created' => $created,
                'limit' => $limit,
                'offset' => $offset,
                'status' => $status,
                'type' => $type,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($runID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
