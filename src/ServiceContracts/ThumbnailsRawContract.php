<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Thumbnails\Thumbnail;
use Chunkify\Thumbnails\ThumbnailCreateParams;
use Chunkify\Thumbnails\ThumbnailDeleteParams;
use Chunkify\Thumbnails\ThumbnailListParams;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface ThumbnailsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ThumbnailCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Thumbnail>
     *
     * @throws APIException
     */
    public function create(
        array|ThumbnailCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $thumbnailID thumbnailId identifies a Thumbnail in the authenticated Project
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Thumbnail>
     *
     * @throws APIException
     */
    public function retrieve(
        string $thumbnailID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ThumbnailListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Thumbnail>>
     *
     * @throws APIException
     */
    public function list(
        array|ThumbnailListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $thumbnailID thumbnailId identifies a Thumbnail in the authenticated Project
     * @param array<string,mixed>|ThumbnailDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $thumbnailID,
        array|ThumbnailDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
