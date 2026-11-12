<?php

declare(strict_types=1);

namespace Chunkify\Services\Assets;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Assets\WorkflowRawContract;
use Chunkify\Workflows\Runs\WorkflowRun;

/**
 * Automatic video-on-demand Assets and independent H.264 MP4 static renditions.
 *
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
}
