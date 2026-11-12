<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts\Projects\Analytics\Connections;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Projects\Analytics\Connections\Keys\KeyCreateParams;
use Chunkify\Projects\Analytics\Connections\Keys\KeyListResponse;
use Chunkify\Projects\Analytics\Connections\Keys\KeyNewResponse;
use Chunkify\Projects\Analytics\Connections\Keys\KeyRotateResponse;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface KeysRawContract
{
    /**
     * @api
     *
     * @param string $projectID the owning Chunkify project ID
     * @param string $connectionID the saved analytics connection ID
     * @param array<string,mixed>|KeyCreateParams $params
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
