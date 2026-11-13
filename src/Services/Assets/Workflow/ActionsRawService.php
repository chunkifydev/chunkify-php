<?php

declare(strict_types=1);

namespace Chunkify\Services\Assets\Workflow;

use Chunkify\Assets\Workflow\Actions\ActionListParams;
use Chunkify\Assets\Workflow\Actions\ActionListParams\Created;
use Chunkify\Assets\Workflow\Actions\ActionListParams\Status;
use Chunkify\Assets\Workflow\Actions\ActionListParams\Type;
use Chunkify\Assets\Workflow\Actions\AssetActionRun;
use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Assets\Workflow\ActionsRawContract;

/**
 * Automatic video-on-demand Assets and independent H.264 MP4 static renditions.
 *
 * @phpstan-import-type CreatedShape from \Chunkify\Assets\Workflow\Actions\ActionListParams\Created
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
     * }|ActionListParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ActionListParams::parseRequest(
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
