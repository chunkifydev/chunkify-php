<?php

declare(strict_types=1);

namespace Chunkify\Services\Projects\Analytics;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Projects\Analytics\Connections\AnalyticsConnection;
use Chunkify\Projects\Analytics\Connections\ConnectionCreateParams;
use Chunkify\Projects\Analytics\Connections\ConnectionCreateParams\Type;
use Chunkify\Projects\Analytics\Connections\ConnectionListResponse;
use Chunkify\Projects\Analytics\Connections\ConnectionNewResponse;
use Chunkify\Projects\Analytics\Connections\ConnectionUpdateParams;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Projects\Analytics\ConnectionsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class ConnectionsRawService implements ConnectionsRawContract
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
     * }|ConnectionCreateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ConnectionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['projects/%1$s/analytics/connections', $projectID],
            body: (object) $parsed,
            options: $options,
            convert: ConnectionNewResponse::class,
            security: ['teamAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve non-secret connection metadata within its owning project.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'projects/%1$s/analytics/connections/%2$s', $projectID, $connectionID,
            ],
            unwrap: 'data',
            options: $requestOptions,
            convert: AnalyticsConnection::class,
            security: ['teamAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Rename a connection or validate replacement custom credentials. Only team owners can update connections. Existing settings remain unchanged if validation fails.
     *
     * @param string $projectID the owning Chunkify project ID
     * @param string $connectionID the saved analytics connection ID
     * @param array{
     *   allowedOrigins?: list<string>,
     *   defaultForDashboard?: bool,
     *   endpoint?: string,
     *   name?: string,
     *   publicIngestKey?: string,
     *   readKey?: string,
     * }|ConnectionUpdateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ConnectionUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: [
                'projects/%1$s/analytics/connections/%2$s', $projectID, $connectionID,
            ],
            body: (object) $parsed,
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
     * @return BaseResponse<ConnectionListResponse>
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
            convert: ConnectionListResponse::class,
            security: ['teamAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * For hosted connections, delete the linked analytics project and invalidate its keys before removing the saved connection. Stored events expire under the collector retention policy. For custom connections, remove only the saved credentials and connection; the remote server, project and data remain unchanged. Only team owners can delete connections. An uncertain remote result preserves the connection for reconciliation.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: [
                'projects/%1$s/analytics/connections/%2$s', $projectID, $connectionID,
            ],
            options: $requestOptions,
            convert: null,
            security: ['teamAccessToken' => true],
        );
    }
}
