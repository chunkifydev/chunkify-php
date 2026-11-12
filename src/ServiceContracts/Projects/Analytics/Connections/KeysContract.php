<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Projects\Analytics\Connections;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\Projects\Analytics\Connections\Keys\KeyCreateParams\Purpose;
use Chunkify\Projects\Analytics\Connections\Keys\KeyListResponse;
use Chunkify\Projects\Analytics\Connections\Keys\KeyNewResponse;
use Chunkify\Projects\Analytics\Connections\Keys\KeyRotateResponse;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface KeysContract
{
    /**
     * @api
     *
     * @param string $projectID the owning Chunkify project ID
     * @param string $connectionID the saved analytics connection ID
     * @param Purpose|value-of<Purpose> $purpose Purpose distinguishes player ingestion, read-only API access and a separate read-only MCP credential. Read and MCP keys have the same collector permissions.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $projectID,
        string $connectionID,
        Purpose|string $purpose,
        RequestOptions|array|null $requestOptions = null,
    ): KeyNewResponse;

    /**
     * @api
     *
     * @param string $projectID the owning Chunkify project ID
     * @param string $connectionID the saved analytics connection ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $projectID,
        string $connectionID,
        RequestOptions|array|null $requestOptions = null,
    ): KeyListResponse;

    /**
     * @api
     *
     * @param string $projectID the owning Chunkify project ID
     * @param string $connectionID the saved analytics connection ID
     * @param string $keyID the analytics key ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rotate(
        string $projectID,
        string $connectionID,
        string $keyID,
        RequestOptions|array|null $requestOptions = null,
    ): KeyRotateResponse;
}
