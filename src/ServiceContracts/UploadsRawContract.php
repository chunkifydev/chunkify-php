<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Uploads\Upload;
use Chunkify\Uploads\UploadCreateParams;
use Chunkify\Uploads\UploadListParams;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface UploadsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|UploadCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Upload>
     *
     * @throws APIException
     */
    public function create(
        array|UploadCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $uploadID Upload ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Upload>
     *
     * @throws APIException
     */
    public function retrieve(
        string $uploadID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|UploadListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Upload>>
     *
     * @throws APIException
     */
    public function list(
        array|UploadListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $uploadID Upload id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $uploadID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $token Opaque completion capability from completion_url
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function complete(
        string $token,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
