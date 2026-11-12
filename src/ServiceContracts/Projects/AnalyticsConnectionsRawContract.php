<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Projects;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnection;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionCreateParams;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionDeleteParams;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionListResponse;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionNewResponse;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionRetrieveParams;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionUpdateParams;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface AnalyticsConnectionsRawContract
{
    /**
     * @api
     *
     * @param string $projectID the owning Chunkify project ID
     * @param array<string,mixed>|AnalyticsConnectionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AnalyticsConnectionNewResponse>
     *
     * @throws APIException
     */
    public function create(
        string $projectID,
        array|AnalyticsConnectionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $connectionID the saved analytics connection ID
     * @param array<string,mixed>|AnalyticsConnectionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AnalyticsConnection>
     *
     * @throws APIException
     */
    public function retrieve(
        string $connectionID,
        array|AnalyticsConnectionRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $connectionID path param: The saved analytics connection ID
     * @param array<string,mixed>|AnalyticsConnectionUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AnalyticsConnection>
     *
     * @throws APIException
     */
    public function update(
        string $connectionID,
        array|AnalyticsConnectionUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $projectID the owning Chunkify project ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AnalyticsConnectionListResponse>
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
     * @param string $connectionID the saved analytics connection ID
     * @param array<string,mixed>|AnalyticsConnectionDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $connectionID,
        array|AnalyticsConnectionDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
