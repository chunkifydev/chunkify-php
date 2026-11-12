<?php

declare(strict_types=1);

namespace Chunkify\Services\Projects\Analytics\Connections;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Projects\Analytics\Connections\Keys\KeyCreateParams;
use Chunkify\Projects\Analytics\Connections\Keys\KeyCreateParams\Purpose;
use Chunkify\Projects\Analytics\Connections\Keys\KeyListResponse;
use Chunkify\Projects\Analytics\Connections\Keys\KeyNewResponse;
use Chunkify\Projects\Analytics\Connections\Keys\KeyRotateResponse;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Projects\Analytics\Connections\KeysRawContract;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class KeysRawService implements KeysRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Generate a public key for players to send events, or a read-only secret key for a dashboard or MCP client to query a hosted Chunkify Analytics server. Save secret keys when returned. Requires a team owner and a Team Access Key.
     *
     * @param string $projectID the owning Chunkify project ID
     * @param string $connectionID the saved analytics connection ID
     * @param array{purpose: Purpose|value-of<Purpose>}|KeyCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<KeyNewResponse>
     *
     * @throws APIException
     */
    public function create(
        string $projectID,
        string $connectionID,
        array|KeyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = KeyCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'projects/%1$s/analytics/connections/%2$s/keys',
                $projectID,
                $connectionID,
            ],
            body: (object) $parsed,
            options: $options,
            convert: KeyNewResponse::class,
            security: ['teamAccessToken' => true],
        );
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
     * @return BaseResponse<KeyListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $projectID,
        string $connectionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'projects/%1$s/analytics/connections/%2$s/keys',
                $projectID,
                $connectionID,
            ],
            options: $requestOptions,
            convert: KeyListResponse::class,
            security: ['teamAccessToken' => true],
        );
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
     * @return BaseResponse<KeyRotateResponse>
     *
     * @throws APIException
     */
    public function rotate(
        string $projectID,
        string $connectionID,
        string $keyID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'projects/%1$s/analytics/connections/%2$s/keys/%3$s/rotate',
                $projectID,
                $connectionID,
                $keyID,
            ],
            options: $requestOptions,
            convert: KeyRotateResponse::class,
            security: ['teamAccessToken' => true],
        );
    }
}
