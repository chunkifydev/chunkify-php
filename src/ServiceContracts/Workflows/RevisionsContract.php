<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Workflows;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\RequestOptions;
use Chunkify\Workflows\Revisions\WorkflowRevision;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface RevisionsContract
{
    /**
     * @api
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
    ): WorkflowRevision;
}
