<?php

declare(strict_types=1);

namespace Chunkify\Services\Workflows\Runs;

use Chunkify\Assets\Workflow\AssetActionRun;
use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Workflows\Runs\ActionsRawContract;
use Chunkify\Workflows\Runs\Actions\ActionListParams;
use Chunkify\Workflows\Runs\Actions\ActionListParams\Created;
use Chunkify\Workflows\Runs\Actions\ActionListParams\Status;
use Chunkify\Workflows\Runs\Actions\ActionListParams\Type;
use Chunkify\Workflows\Runs\Actions\ActionRetrieveParams;

/**
 * @phpstan-import-type CreatedShape from \Chunkify\Workflows\Runs\Actions\ActionListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class ActionsRawService implements ActionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve one action execution in a retained Workflow run, including its resolved inputs, status, and result.
     *
     * @param string $actionRunID ID of the Asset action run
     * @param array{workflowID: string, runID: string}|ActionRetrieveParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ActionRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $workflowID = $parsed['workflowID'];
        unset($parsed['workflowID']);
        $runID = $parsed['runID'];
        unset($parsed['runID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'workflows/%1$s/runs/%2$s/actions/%3$s',
                $workflowID,
                $runID,
                $actionRunID,
            ],
            unwrap: 'data',
            options: $options,
            convert: AssetActionRun::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * List actions in a retained Workflow run, newest first. Includes resolved inputs, statuses, output references, and skip or failure reasons.
     *
     * @param string $runID path param: ID of the Workflow run
     * @param array{
     *   workflowID: string,
     *   assetID?: string,
     *   created?: Created|CreatedShape,
     *   limit?: int,
     *   offset?: int,
     *   status?: Status|value-of<Status>,
     *   type?: value-of<Type>,
     * }|ActionListParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ActionListParams::parseRequest(
            $params,
            $requestOptions,
        );
        $workflowID = $parsed['workflowID'];
        unset($parsed['workflowID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['workflows/%1$s/runs/%2$s/actions', $workflowID, $runID],
            query: Util::array_transform_keys($parsed, ['assetID' => 'asset_id']),
            options: $options,
            convert: AssetActionRun::class,
            page: PaginatedResults::class,
            security: ['projectAccessToken' => true],
        );
    }
}
