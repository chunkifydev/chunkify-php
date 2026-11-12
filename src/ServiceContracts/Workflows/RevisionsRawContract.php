<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Workflows;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\RequestOptions;
use Chunkify\Workflows\Revisions\RevisionRetrieveParams;
use Chunkify\Workflows\Revisions\WorkflowRevision;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface RevisionsRawContract
{
    /**
     * @api
     *
     * @param int $revision revision number of the Workflow definition to retrieve
     * @param array<string,mixed>|RevisionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkflowRevision>
     *
     * @throws APIException
     */
    public function retrieve(
        int $revision,
        array|RevisionRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
