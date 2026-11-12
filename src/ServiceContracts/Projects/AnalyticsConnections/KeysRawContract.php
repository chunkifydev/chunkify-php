<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Projects\AnalyticsConnections;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Projects\AnalyticsConnections\Keys\KeyCreateParams;
use Chunkify\Projects\AnalyticsConnections\Keys\KeyListParams;
use Chunkify\Projects\AnalyticsConnections\Keys\KeyListResponse;
use Chunkify\Projects\AnalyticsConnections\Keys\KeyNewResponse;
use Chunkify\Projects\AnalyticsConnections\Keys\KeyRotateParams;
use Chunkify\Projects\AnalyticsConnections\Keys\KeyRotateResponse;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface KeysRawContract
{
    /**
     * @api
     *
     * @param string $connectionID path param: The saved analytics connection ID
     * @param array<string,mixed>|KeyCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<KeyNewResponse>
     *
     * @throws APIException
     */
    public function create(
        string $connectionID,
        array|KeyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $connectionID the saved analytics connection ID
     * @param array<string,mixed>|KeyListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<KeyListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $connectionID,
        array|KeyListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $keyID the analytics key ID
     * @param array<string,mixed>|KeyRotateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<KeyRotateResponse>
     *
     * @throws APIException
     */
    public function rotate(
        string $keyID,
        array|KeyRotateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
