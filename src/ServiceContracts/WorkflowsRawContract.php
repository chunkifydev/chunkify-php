<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Workflows\Workflow;
use Chunkify\Workflows\WorkflowCreateParams;
use Chunkify\Workflows\WorkflowListParams;
use Chunkify\Workflows\WorkflowUpdateParams;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface WorkflowsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|WorkflowCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Workflow>
     *
     * @throws APIException
     */
    public function create(
        array|WorkflowCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $workflowID ID of the Workflow
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Workflow>
     *
     * @throws APIException
     */
    public function retrieve(
        string $workflowID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $workflowID ID of the Workflow
     * @param array<string,mixed>|WorkflowUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $workflowID,
        array|WorkflowUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WorkflowListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Workflow>>
     *
     * @throws APIException
     */
    public function list(
        array|WorkflowListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $workflowID ID of the Workflow
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $workflowID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
