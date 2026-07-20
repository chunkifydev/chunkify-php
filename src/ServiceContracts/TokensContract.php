<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\RequestOptions;
use Chunkify\Tokens\Token;
use Chunkify\Tokens\TokenCreateParams\Scope;
use Chunkify\Tokens\TokenListResponse;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface TokensContract
{
    /**
     * @api
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
    ): Token;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): TokenListResponse;

    /**
     * @api
     *
     * @param string $tokenID Token ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function revoke(
        string $tokenID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
