<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Sources\Source;
use Chunkify\Sources\SourceCreateParams;
use Chunkify\Sources\SourceListParams;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface SourcesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SourceCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Source>
     *
     * @throws APIException
     */
    public function create(
        array|SourceCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $sourceID Source ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Source>
     *
     * @throws APIException
     */
    public function retrieve(
        string $sourceID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SourceListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Source>>
     *
     * @throws APIException
     */
    public function list(
        array|SourceListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $sourceID Source id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $sourceID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
