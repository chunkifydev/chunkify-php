<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\TokensRawContract;
use Chunkify\Tokens\Token;
use Chunkify\Tokens\TokenCreateParams;
use Chunkify\Tokens\TokenCreateParams\Scope;
use Chunkify\Tokens\TokenListResponse;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class TokensRawService implements TokensRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new access token for either account-wide or project-specific access. Project tokens require a valid project slug.
     *
     * @param array{
     *   scope: Scope|value-of<Scope>, name?: string, projectID?: string
     * }|TokenCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Token>
     *
     * @throws APIException
     */
    public function create(
        array|TokenCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TokenCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/tokens',
            body: (object) $parsed,
            unwrap: 'data',
            options: $options,
            convert: Token::class,
            security: ['teamAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve a list of all API tokens for your account, including both team-scoped and project-scoped tokens. For each token, the response includes its name, scope, creation date, and usage statistics. The token values are not included in the response for security reasons.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TokenListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/tokens',
            options: $requestOptions,
            convert: TokenListResponse::class,
            security: ['teamAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Revoke an access token by its ID. This action is irreversible and will immediately invalidate the token.
     *
     * @param string $tokenID Token ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function revoke(
        string $tokenID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['api/tokens/%1$s', $tokenID],
            options: $requestOptions,
            convert: null,
            security: ['teamAccessToken' => true],
        );
    }
}
