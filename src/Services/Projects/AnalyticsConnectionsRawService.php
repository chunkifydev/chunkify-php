<?php

declare(strict_types=1);

namespace Chunkify\Services\Projects;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnection;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionCreateParams;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionCreateParams\Type;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionDeleteParams;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionListResponse;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionNewResponse;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionRetrieveParams;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionUpdateParams;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Projects\AnalyticsConnectionsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class AnalyticsConnectionsRawService implements AnalyticsConnectionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Add a hosted connection or validate and save a custom server. Only team owners can create connections. Retry a known failed hosted setup with the same name to resume its saved project; an unknown creation outcome requires operator reconciliation.
     *
     * @param string $projectID the owning Chunkify project ID
     * @param array{
     *   name: string,
     *   type: Type|value-of<Type>,
     *   endpoint?: string,
     *   publicIngestKey?: string,
     *   readKey?: string,
     * }|AnalyticsConnectionCreateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = AnalyticsConnectionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['projects/%1$s/analytics/connections', $projectID],
            body: (object) $parsed,
            options: $options,
            convert: AnalyticsConnectionNewResponse::class,
            security: ['teamAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve non-secret connection metadata within its owning project.
     *
     * @param string $connectionID the saved analytics connection ID
     * @param array{projectID: string}|AnalyticsConnectionRetrieveParams $params
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
    ): BaseResponse {
        [$parsed, $options] = AnalyticsConnectionRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $projectID = $parsed['projectID'];
        unset($parsed['projectID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'projects/%1$s/analytics/connections/%2$s', $projectID, $connectionID,
            ],
            unwrap: 'data',
            options: $options,
            convert: AnalyticsConnection::class,
            security: ['teamAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Rename a connection or validate replacement custom credentials. Only team owners can update connections. Existing settings remain unchanged if validation fails.
     *
     * @param string $connectionID path param: The saved analytics connection ID
     * @param array{
     *   projectID: string,
     *   allowedOrigins?: list<string>,
     *   defaultForDashboard?: bool,
     *   endpoint?: string,
     *   name?: string,
     *   publicIngestKey?: string,
     *   readKey?: string,
     * }|AnalyticsConnectionUpdateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = AnalyticsConnectionUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $projectID = $parsed['projectID'];
        unset($parsed['projectID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: [
                'projects/%1$s/analytics/connections/%2$s', $projectID, $connectionID,
            ],
            body: (object) array_diff_key($parsed, array_flip(['projectID'])),
            unwrap: 'data',
            options: $options,
            convert: AnalyticsConnection::class,
            security: ['teamAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * List the saved connections for this project. No connection is activated by this request.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['projects/%1$s/analytics/connections', $projectID],
            options: $requestOptions,
            convert: AnalyticsConnectionListResponse::class,
            security: ['teamAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * For hosted connections, delete the linked analytics project and invalidate its keys before removing the saved connection. Stored events expire under the collector retention policy. For custom connections, remove only the saved credentials and connection; the remote server, project and data remain unchanged. Only team owners can delete connections. An uncertain remote result preserves the connection for reconciliation.
     *
     * @param string $connectionID the saved analytics connection ID
     * @param array{projectID: string}|AnalyticsConnectionDeleteParams $params
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
    ): BaseResponse {
        [$parsed, $options] = AnalyticsConnectionDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $projectID = $parsed['projectID'];
        unset($parsed['projectID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: [
                'projects/%1$s/analytics/connections/%2$s', $projectID, $connectionID,
            ],
            options: $options,
            convert: null,
            security: ['teamAccessToken' => true],
        );
    }
}
