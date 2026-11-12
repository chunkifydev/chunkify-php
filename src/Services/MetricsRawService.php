<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\Metrics\MetricAssetsParams;
use Chunkify\Metrics\MetricAssetsParams\Format;
use Chunkify\Metrics\MetricsAssets;
use Chunkify\Metrics\MetricsStorage;
use Chunkify\Metrics\MetricStorageParams;
use Chunkify\Metrics\MetricsUsage;
use Chunkify\Metrics\MetricUsageParams;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\MetricsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class MetricsRawService implements MetricsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve Asset outcomes, timings, output sizes and source profiles by UTC creation date.
     *
     * @param array{
     *   format?: Format|value-of<Format>, from?: string, to?: string
     * }|MetricAssetsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MetricsAssets>
     *
     * @throws APIException
     */
    public function assets(
        array|MetricAssetsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MetricAssetsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'metrics/assets',
            query: $parsed,
            unwrap: 'data',
            options: $options,
            convert: MetricsAssets::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve recorded additions and successful removals by storage and UTC date. Historical coverage depends on event retention.
     *
     * @param array{
     *   format?: MetricStorageParams\Format|value-of<MetricStorageParams\Format>,
     *   from?: string,
     *   storageID?: string,
     *   to?: string,
     * }|MetricStorageParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MetricsStorage>
     *
     * @throws APIException
     */
    public function storage(
        array|MetricStorageParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MetricStorageParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'metrics/storage',
            query: Util::array_transform_keys($parsed, ['storageID' => 'storage_id']),
            unwrap: 'data',
            options: $options,
            convert: MetricsStorage::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve project usage totals and daily values for a UTC date range.
     *
     * @param array{
     *   format?: MetricUsageParams\Format|value-of<MetricUsageParams\Format>,
     *   from?: string,
     *   to?: string,
     * }|MetricUsageParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MetricsUsage>
     *
     * @throws APIException
     */
    public function usage(
        array|MetricUsageParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MetricUsageParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'metrics/usage',
            query: $parsed,
            unwrap: 'data',
            options: $options,
            convert: MetricsUsage::class,
            security: ['projectAccessToken' => true],
        );
    }
}
