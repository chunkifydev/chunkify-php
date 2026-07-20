<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Jobs\Job;
use Chunkify\Jobs\JobCreateParams;
use Chunkify\Jobs\JobListParams;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface JobsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|JobCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Job>
     *
     * @throws APIException
     */
    public function create(
        array|JobCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $jobID Job ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Job>
     *
     * @throws APIException
     */
    public function retrieve(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|JobListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Job>>
     *
     * @throws APIException
     */
    public function list(
        array|JobListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $jobID Job id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $jobID Job id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function cancel(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
