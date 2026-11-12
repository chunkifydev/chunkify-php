<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Transcodings\Transcoding;
use Chunkify\Transcodings\TranscodingCreateParams;
use Chunkify\Transcodings\TranscodingDeleteParams;
use Chunkify\Transcodings\TranscodingListParams;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface TranscodingsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|TranscodingCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Transcoding>
     *
     * @throws APIException
     */
    public function create(
        array|TranscodingCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $transcodingID transcodingId identifies a Transcoding in the authenticated Project
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Transcoding>
     *
     * @throws APIException
     */
    public function retrieve(
        string $transcodingID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TranscodingListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Transcoding>>
     *
     * @throws APIException
     */
    public function list(
        array|TranscodingListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $transcodingID transcodingId identifies a Transcoding in the authenticated Project
     * @param array<string,mixed>|TranscodingDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $transcodingID,
        array|TranscodingDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $transcodingID transcodingId identifies a Transcoding in the authenticated Project
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function cancel(
        string $transcodingID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
