<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Projects\Project;
use Chunkify\Projects\ProjectCreateParams;
use Chunkify\Projects\ProjectListResponse;
use Chunkify\Projects\ProjectUpdateParams;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface ProjectsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ProjectCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Project>
     *
     * @throws APIException
     */
    public function create(
        array|ProjectCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $projectID Project Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Project>
     *
     * @throws APIException
     */
    public function retrieve(
        string $projectID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $projectID Project Id
     * @param array<string,mixed>|ProjectUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $projectID,
        array|ProjectUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProjectListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $projectID Project Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $projectID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
