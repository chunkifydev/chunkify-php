<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Metrics\MetricAssetsParams;
use Chunkify\Metrics\MetricsAssets;
use Chunkify\Metrics\MetricsStorage;
use Chunkify\Metrics\MetricStorageParams;
use Chunkify\Metrics\MetricsUsage;
use Chunkify\Metrics\MetricUsageParams;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface MetricsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|MetricAssetsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MetricsAssets>
     *
     * @throws APIException
     */
    public function assets(
        array|MetricAssetsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MetricStorageParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MetricsStorage>
     *
     * @throws APIException
     */
    public function storage(
        array|MetricStorageParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MetricUsageParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MetricsUsage>
     *
     * @throws APIException
     */
    public function usage(
        array|MetricUsageParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
