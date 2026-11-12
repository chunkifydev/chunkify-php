<?php

declare(strict_types=1);

namespace Chunkify\Services\Assets;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Assets\WorkflowContract;
use Chunkify\Services\Assets\Workflow\ActionsService;
use Chunkify\Workflows\Runs\WorkflowRun;

/**
 * Automatic video-on-demand Assets and independent H.264 MP4 static renditions.
 *
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class WorkflowService implements WorkflowContract
{
    /**
     * @api
     */
    public WorkflowRawService $raw;

    /**
     * @api
     */
    public ActionsService $actions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WorkflowRawService($client);
        $this->actions = new ActionsService($client);
    }

    /**
     * @api
     *
     * Update a ready Asset to the latest revision of its selected Workflow. Existing outputs are preserved and missing outputs are created.
     *
     * @param string $assetID ID of the Asset whose Workflow revision to update
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $assetID,
        RequestOptions|array|null $requestOptions = null
    ): WorkflowRun {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($assetID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
