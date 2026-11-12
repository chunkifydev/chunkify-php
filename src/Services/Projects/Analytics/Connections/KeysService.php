<?php

declare(strict_types=1);

namespace Chunkify\Services\Projects\Analytics\Connections;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Projects\Analytics\Connections\Keys\KeyCreateParams\Purpose;
use Chunkify\Projects\Analytics\Connections\Keys\KeyListResponse;
use Chunkify\Projects\Analytics\Connections\Keys\KeyNewResponse;
use Chunkify\Projects\Analytics\Connections\Keys\KeyRotateResponse;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Projects\Analytics\Connections\KeysContract;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class KeysService implements KeysContract
{
    /**
     * @api
     */
    public KeysRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new KeysRawService($client);
    }

    /**
     * @api
     *
     * Generate a public key for players to send events, or a read-only secret key for a dashboard or MCP client to query a hosted Chunkify Analytics server. Save secret keys when returned. Requires a team owner and a Team Access Key.
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
    ): KeyNewResponse {
        $params = [];
        $params['purpose'] = $purpose;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($projectID, $connectionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List keys for a hosted Chunkify Analytics server: the public key used by players to send events, and read-only secret key records for dashboard and MCP access. Secret values are not returned. Requires a team owner and a Team Access Key.
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
    ): KeyListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($projectID, $connectionID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Rotate a public or read-only secret key for a hosted Chunkify Analytics server. Update the player, dashboard, or MCP client with the new key; the old key stops working immediately. Requires a team owner and a Team Access Key.
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
    ): KeyRotateResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->rotate($projectID, $connectionID, $keyID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
