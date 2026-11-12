<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Projects\AnalyticsConnections;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\Projects\AnalyticsConnections\Keys\KeyCreateParams\Purpose;
use Chunkify\Projects\AnalyticsConnections\Keys\KeyListResponse;
use Chunkify\Projects\AnalyticsConnections\Keys\KeyNewResponse;
use Chunkify\Projects\AnalyticsConnections\Keys\KeyRotateResponse;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface KeysContract
{
    /**
     * @api
     *
     * @param string $connectionID path param: The saved analytics connection ID
     * @param string $projectID path param: The owning Chunkify project ID
     * @param Purpose|value-of<Purpose> $purpose Body param: Purpose distinguishes player ingestion, read-only API access and a separate read-only MCP credential. Read and MCP keys have the same collector permissions.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $connectionID,
        string $projectID,
        Purpose|string $purpose,
        RequestOptions|array|null $requestOptions = null,
    ): KeyNewResponse;

    /**
     * @api
     *
     * @param string $connectionID the saved analytics connection ID
     * @param string $projectID the owning Chunkify project ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $connectionID,
        string $projectID,
        RequestOptions|array|null $requestOptions = null,
    ): KeyListResponse;

    /**
     * @api
     *
     * @param string $keyID the analytics key ID
     * @param string $projectID the owning Chunkify project ID
     * @param string $connectionID the saved analytics connection ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rotate(
        string $keyID,
        string $projectID,
        string $connectionID,
        RequestOptions|array|null $requestOptions = null,
    ): KeyRotateResponse;
}
