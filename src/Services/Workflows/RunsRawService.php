<?php

declare(strict_types=1);

namespace Chunkify\Services\Workflows;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Workflows\RunsRawContract;
use Chunkify\Workflows\Runs\RunListParams;
use Chunkify\Workflows\Runs\RunListParams\Created;
use Chunkify\Workflows\Runs\RunListParams\Status;
use Chunkify\Workflows\Runs\RunRetrieveParams;
use Chunkify\Workflows\Runs\WorkflowRun;

/**
 * @phpstan-import-type CreatedShape from \Chunkify\Workflows\Runs\RunListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class RunsRawService implements RunsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a retained run with its triggering event, status, and action counts.
     *
     * @param string $runID ID of the Workflow run
     * @param array{workflowID: string}|RunRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkflowRun>
     *
     * @throws APIException
     */
    public function retrieve(
        string $runID,
        array|RunRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RunRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $workflowID = $parsed['workflowID'];
        unset($parsed['workflowID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['workflows/%1$s/runs/%2$s', $workflowID, $runID],
            unwrap: 'data',
            options: $options,
            convert: WorkflowRun::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * List retained runs for this Workflow, newest first. Each run corresponds to one matching Asset event.
     *
     * @param string $workflowID ID of the Workflow
     * @param array{
     *   assetID?: string,
     *   created?: Created|CreatedShape,
     *   eventID?: string,
     *   latestPerAsset?: bool,
     *   limit?: int,
     *   offset?: int,
     *   status?: Status|value-of<Status>,
     * }|RunListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<WorkflowRun>>
     *
     * @throws APIException
     */
    public function list(
        string $workflowID,
        array|RunListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RunListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['workflows/%1$s/runs', $workflowID],
            query: Util::array_transform_keys(
                $parsed,
                [
                    'assetID' => 'asset_id',
                    'eventID' => 'event_id',
                    'latestPerAsset' => 'latest_per_asset',
                ],
            ),
            options: $options,
            convert: WorkflowRun::class,
            page: PaginatedResults::class,
            security: ['projectAccessToken' => true],
        );
    }
}
