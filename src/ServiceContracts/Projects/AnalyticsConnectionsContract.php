<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Projects;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnection;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionCreateParams\Type;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionListResponse;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionNewResponse;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface AnalyticsConnectionsContract
{
    /**
     * @api
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
    ): AnalyticsConnectionNewResponse;

    /**
     * @api
     *
     * @param string $connectionID the saved analytics connection ID
     * @param string $projectID the owning Chunkify project ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $connectionID,
        string $projectID,
        RequestOptions|array|null $requestOptions = null,
    ): AnalyticsConnection;

    /**
     * @api
     *
     * @param string $connectionID path param: The saved analytics connection ID
     * @param string $projectID path param: The owning Chunkify project ID
     * @param list<string> $allowedOrigins Body param: AllowedOrigins lists additional website origins permitted to ingest events for a hosted connection. Shared installation origins remain allowed. An empty list clears project-specific origins. Custom servers manage origins on their own infrastructure.
     * @param bool $defaultForDashboard Body param: DefaultForDashboard selects this ready connection for Chunkify dashboard players, public previews, the playground and newly generated snippets. Requires a public ingest key. Setting true replaces the previous default atomically. Setting false disables dashboard tracking if no default remains; another connection is not selected automatically. Existing external players keep their own configuration.
     * @param string $endpoint Body param: Endpoint specifies a replacement custom server base URL. Supply read_key together with it.
     * @param string $name body param: Name identifies this connection in the dashboard
     * @param string $publicIngestKey Body param: PublicIngestKey optionally enables preview tracking for a custom connection. Supply the public ingestion key for the same analytics project as read_key. It is returned in connection reads and used in browser code. Omit for hosted connections. An empty string disables preview tracking. A replacement endpoint clears the saved public key unless a replacement is supplied.
     * @param string $readKey Body param: ReadKey replaces the custom connection credential after validation. Its value is never returned.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $connectionID,
        string $projectID,
        ?array $allowedOrigins = null,
        ?bool $defaultForDashboard = null,
        ?string $endpoint = null,
        ?string $name = null,
        ?string $publicIngestKey = null,
        ?string $readKey = null,
        RequestOptions|array|null $requestOptions = null,
    ): AnalyticsConnection;

    /**
     * @api
     *
     * @param string $projectID the owning Chunkify project ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $projectID,
        RequestOptions|array|null $requestOptions = null
    ): AnalyticsConnectionListResponse;

    /**
     * @api
     *
     * @param string $connectionID the saved analytics connection ID
     * @param string $projectID the owning Chunkify project ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $connectionID,
        string $projectID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
