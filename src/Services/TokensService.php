<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\TokensContract;
use Chunkify\Tokens\Token;
use Chunkify\Tokens\TokenCreateParams\Scope;
use Chunkify\Tokens\TokenListResponse;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class TokensService implements TokensContract
{
    /**
     * @api
     */
    public TokensRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TokensRawService($client);
    }

    /**
     * @api
     *
     * Create a new access token for either account-wide or project-specific access. Project tokens require a valid project slug.
     *
     * @param Scope|value-of<Scope> $scope scope specifies the scope of the token, which must be either "team" or "project"
     * @param string $name name is the name of the token, which can be up to 64 characters long
     * @param string $projectID projectId is required if the scope is set to "project"
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        Scope|string $scope,
        ?string $name = null,
        ?string $projectID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Token {
        $params = Util::removeNulls(
            ['scope' => $scope, 'name' => $name, 'projectID' => $projectID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a list of all API tokens for your account, including both team-scoped and project-scoped tokens. For each token, the response includes its name, scope, creation date, and usage statistics. The token values are not included in the response for security reasons.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): TokenListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Revoke an access token by its ID. This action is irreversible and will immediately invalidate the token.
     *
     * @param string $tokenID Token ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function revoke(
        string $tokenID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->revoke($tokenID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
