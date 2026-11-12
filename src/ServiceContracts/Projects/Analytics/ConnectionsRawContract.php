<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Projects\Analytics;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Projects\Analytics\Connections\AnalyticsConnection;
use Chunkify\Projects\Analytics\Connections\ConnectionCreateParams;
use Chunkify\Projects\Analytics\Connections\ConnectionListResponse;
use Chunkify\Projects\Analytics\Connections\ConnectionNewResponse;
use Chunkify\Projects\Analytics\Connections\ConnectionUpdateParams;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface ConnectionsRawContract
{
    /**
     * @api
     *
     * @param string $projectID the owning Chunkify project ID
     * @param array<string,mixed>|ConnectionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ConnectionNewResponse>
     *
     * @throws APIException
     */
    public function create(
        string $projectID,
        array|ConnectionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $projectID the owning Chunkify project ID
     * @param string $connectionID the saved analytics connection ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AnalyticsConnection>
     *
     * @throws APIException
     */
    public function retrieve(
        string $projectID,
        string $connectionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $projectID the owning Chunkify project ID
     * @param string $connectionID the saved analytics connection ID
     * @param array<string,mixed>|ConnectionUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AnalyticsConnection>
     *
     * @throws APIException
     */
    public function update(
        string $projectID,
        string $connectionID,
        array|ConnectionUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $projectID the owning Chunkify project ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ConnectionListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $projectID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $projectID the owning Chunkify project ID
     * @param string $connectionID the saved analytics connection ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $projectID,
        string $connectionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
