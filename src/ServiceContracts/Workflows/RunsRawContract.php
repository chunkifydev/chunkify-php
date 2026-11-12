<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Workflows;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Workflows\Runs\RunListParams;
use Chunkify\Workflows\Runs\RunRetrieveParams;
use Chunkify\Workflows\Runs\WorkflowRun;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface RunsRawContract
{
    /**
     * @api
     *
     * @param string $runID ID of the Workflow run
     * @param array<string,mixed>|RunRetrieveParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $workflowID ID of the Workflow
     * @param array<string,mixed>|RunListParams $params
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
    ): BaseResponse;
}
