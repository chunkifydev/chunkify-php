<?php

declare(strict_types=1);

namespace Chunkify\Services\Assets;

use Chunkify\Assets\Workflow\AssetActionRun;
use Chunkify\Assets\Workflow\WorkflowListActionsParams;
use Chunkify\Assets\Workflow\WorkflowListActionsParams\Created;
use Chunkify\Assets\Workflow\WorkflowListActionsParams\Status;
use Chunkify\Assets\Workflow\WorkflowListActionsParams\Type;
use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Assets\WorkflowRawContract;
use Chunkify\Workflows\Runs\WorkflowRun;

/**
 * Automatic video-on-demand Assets and independent H.264 MP4 static renditions.
 *
 * @phpstan-import-type CreatedShape from \Chunkify\Assets\Workflow\WorkflowListActionsParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class WorkflowRawService implements WorkflowRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Update a ready Asset to the latest revision of its selected Workflow. Existing outputs are preserved and missing outputs are created.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['assets/%1$s/workflow/update', $assetID],
            unwrap: 'data',
            options: $requestOptions,
            convert: WorkflowRun::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * List retained Workflow actions for an Asset, newest first. Direct output requests are excluded.
     *
     * @param string $assetID ID of the Asset
     * @param array{
     *   created?: Created|CreatedShape,
     *   latestPerAction?: bool,
     *   limit?: int,
     *   offset?: int,
     *   revision?: int,
     *   status?: Status|value-of<Status>,
     *   type?: value-of<Type>,
     * }|WorkflowListActionsParams $params
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
    ): BaseResponse {
        [$parsed, $options] = WorkflowListActionsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['assets/%1$s/workflow/actions', $assetID],
            query: Util::array_transform_keys(
                $parsed,
                ['latestPerAction' => 'latest_per_action']
            ),
            options: $options,
            convert: AssetActionRun::class,
            page: PaginatedResults::class,
            security: ['projectAccessToken' => true],
        );
    }
}
