<?php

declare(strict_types=1);

namespace Chunkify\Services\Workflows;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Workflows\RevisionsContract;
use Chunkify\Workflows\Revisions\WorkflowRevision;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class RevisionsService implements RevisionsContract
{
    /**
     * @api
     */
    public RevisionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RevisionsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve an immutable definition revision, including revisions of archived Workflows.
     *
     * @param int $revision revision number of the Workflow definition to retrieve
     * @param string $workflowID ID of the Workflow
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        int $revision,
        string $workflowID,
        RequestOptions|array|null $requestOptions = null,
    ): WorkflowRevision {
        $params = Util::removeNulls(['workflowID' => $workflowID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($revision, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
