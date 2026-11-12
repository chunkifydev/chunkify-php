<?php

declare(strict_types=1);

namespace Chunkify\Services\Assets\Workflow;

use Chunkify\Assets\Workflow\Actions\ActionListParams\Created;
use Chunkify\Assets\Workflow\Actions\ActionListParams\Status;
use Chunkify\Assets\Workflow\Actions\ActionListParams\Type;
use Chunkify\Assets\Workflow\AssetActionRun;
use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Assets\Workflow\ActionsContract;

/**
 * Automatic video-on-demand Assets and independent H.264 MP4 static renditions.
 *
 * @phpstan-import-type CreatedShape from \Chunkify\Assets\Workflow\Actions\ActionListParams\Created
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
     * List retained Workflow actions for an Asset, newest first. Direct output requests are excluded.
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
    public function list(
        string $assetID,
        Created|array|null $created = null,
        bool $latestPerAction = false,
        int $limit = 100,
        int $offset = 0,
        ?int $revision = null,
        Status|string|null $status = null,
        Type|string|null $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults {
        $params = Util::removeNulls(
            [
                'created' => $created,
                'latestPerAction' => $latestPerAction,
                'limit' => $limit,
                'offset' => $offset,
                'revision' => $revision,
                'status' => $status,
                'type' => $type,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($assetID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
