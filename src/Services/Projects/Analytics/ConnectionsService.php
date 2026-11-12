<?php

declare(strict_types=1);

namespace Chunkify\Services\Projects\Analytics;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Projects\Analytics\Connections\AnalyticsConnection;
use Chunkify\Projects\Analytics\Connections\ConnectionCreateParams\Type;
use Chunkify\Projects\Analytics\Connections\ConnectionListResponse;
use Chunkify\Projects\Analytics\Connections\ConnectionNewResponse;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Projects\Analytics\ConnectionsContract;
use Chunkify\Services\Projects\Analytics\Connections\KeysService;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class ConnectionsService implements ConnectionsContract
{
    /**
     * @api
     */
    public ConnectionsRawService $raw;

    /**
     * @api
     */
    public KeysService $keys;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ConnectionsRawService($client);
        $this->keys = new KeysService($client);
    }

    /**
     * @api
     *
     * Add a hosted connection or validate and save a custom server. Only team owners can create connections. Retry a known failed hosted setup with the same name to resume its saved project; an unknown creation outcome requires operator reconciliation.
     *
     * @param string $projectID the owning Chunkify project ID
     * @param string $name name identifies this connection in the dashboard
     * @param Type|value-of<Type> $type type specifies whether Chunkify manages the analytics project
     * @param string $endpoint Endpoint specifies the custom server base URL. Required for custom connections and omitted for hosted connections.
     * @param string $publicIngestKey PublicIngestKey optionally enables preview tracking for a custom connection. Supply the public ingestion key for the same analytics project as read_key. It is returned in connection reads and used in browser code. Omit for hosted connections.
     * @param string $readKey ReadKey supplies a read-only project credential for a custom connection. Required for custom connections and omitted for hosted connections. Stored encrypted and never returned.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $projectID,
        string $name,
        Type|string $type,
        ?string $endpoint = null,
        ?string $publicIngestKey = null,
        ?string $readKey = null,
        RequestOptions|array|null $requestOptions = null,
    ): ConnectionNewResponse {
        $params = [];
        $params['name'] = $name;
        $params['type'] = $type;
        null !== $endpoint && $params['endpoint'] = $endpoint;
        null !== $publicIngestKey && $params['publicIngestKey'] = $publicIngestKey;
        null !== $readKey && $params['readKey'] = $readKey;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($projectID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @throws APIException
     */
    public function retrieve(
        string $projectID,
        string $connectionID,
        RequestOptions|array|null $requestOptions = null,
    ): AnalyticsConnection {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($projectID, $connectionID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Rename a connection or validate replacement custom credentials. Only team owners can update connections. Existing settings remain unchanged if validation fails.
     *
     * @param string $projectID the owning Chunkify project ID
     * @param string $connectionID the saved analytics connection ID
     * @param list<string> $allowedOrigins AllowedOrigins lists additional website origins permitted to ingest events for a hosted connection. Shared installation origins remain allowed. An empty list clears project-specific origins. Custom servers manage origins on their own infrastructure.
     * @param bool $defaultForDashboard DefaultForDashboard selects this ready connection for Chunkify dashboard players, public previews, the playground and newly generated snippets. Requires a public ingest key. Setting true replaces the previous default atomically. Setting false disables dashboard tracking if no default remains; another connection is not selected automatically. Existing external players keep their own configuration.
     * @param string $endpoint Endpoint specifies a replacement custom server base URL. Supply read_key together with it.
     * @param string $name name identifies this connection in the dashboard
     * @param string $publicIngestKey PublicIngestKey optionally enables preview tracking for a custom connection. Supply the public ingestion key for the same analytics project as read_key. It is returned in connection reads and used in browser code. Omit for hosted connections. An empty string disables preview tracking. A replacement endpoint clears the saved public key unless a replacement is supplied.
     * @param string $readKey ReadKey replaces the custom connection credential after validation. Its value is never returned.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $projectID,
        string $connectionID,
        ?array $allowedOrigins = null,
        ?bool $defaultForDashboard = null,
        ?string $endpoint = null,
        ?string $name = null,
        ?string $publicIngestKey = null,
        ?string $readKey = null,
        RequestOptions|array|null $requestOptions = null,
    ): AnalyticsConnection {
        $params = [];
        null !== $allowedOrigins && $params['allowedOrigins'] = $allowedOrigins;
        null !== $defaultForDashboard && $params['defaultForDashboard'] = $defaultForDashboard;
        null !== $endpoint && $params['endpoint'] = $endpoint;
        null !== $name && $params['name'] = $name;
        null !== $publicIngestKey && $params['publicIngestKey'] = $publicIngestKey;
        null !== $readKey && $params['readKey'] = $readKey;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($projectID, $connectionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List the saved connections for this project. No connection is activated by this request.
     *
     * @param string $projectID the owning Chunkify project ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $projectID,
        RequestOptions|array|null $requestOptions = null
    ): ConnectionListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($projectID, requestOptions: $requestOptions);

        return $response->parse();
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
     * @throws APIException
     */
    public function delete(
        string $projectID,
        string $connectionID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($projectID, $connectionID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
