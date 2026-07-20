<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\RequestOptions;
use Chunkify\Tokens\Token;
use Chunkify\Tokens\TokenCreateParams;
use Chunkify\Tokens\TokenListResponse;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface TokensRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|TokenCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Token>
     *
     * @throws APIException
     */
    public function create(
        array|TokenCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TokenListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
