<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\Metrics\MetricAssetsParams\Format;
use Chunkify\Metrics\MetricsAssets;
use Chunkify\Metrics\MetricsStorage;
use Chunkify\Metrics\MetricsUsage;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface MetricsContract
{
    /**
     * @api
     *
     * @param Format|value-of<Format> $format Response format. Defaults to JSON unless Accept requests CSV. Overrides Accept when supplied; errors remain JSON.
     * @param string $from Inclusive UTC start date, YYYY-MM-DD. Supply both dates for a custom range of at most 366 days. Omit both for the past 7 UTC calendar days including today.
     * @param string $to Exclusive UTC end date, YYYY-MM-DD. Must be after from and at most 366 days later.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function assets(
        Format|string|null $format = null,
        ?string $from = null,
        ?string $to = null,
        RequestOptions|array|null $requestOptions = null,
    ): MetricsAssets;

    /**
     * @api
     *
     * @param \Chunkify\Metrics\MetricStorageParams\Format|value-of<\Chunkify\Metrics\MetricStorageParams\Format> $format Response format. Defaults to JSON unless Accept requests CSV. Overrides Accept when supplied; errors remain JSON.
     * @param string $from Inclusive UTC start date, YYYY-MM-DD. Supply both dates for a custom range of at most 366 days. Omit both for the past 7 UTC calendar days including today.
     * @param string $storageID filter to one persistent storage configuration in the authenticated project
     * @param string $to Exclusive UTC end date, YYYY-MM-DD. Must be after from and at most 366 days later.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function storage(
        \Chunkify\Metrics\MetricStorageParams\Format|string|null $format = null,
        ?string $from = null,
        ?string $storageID = null,
        ?string $to = null,
        RequestOptions|array|null $requestOptions = null,
    ): MetricsStorage;

    /**
     * @api
     *
     * @param \Chunkify\Metrics\MetricUsageParams\Format|value-of<\Chunkify\Metrics\MetricUsageParams\Format> $format Response format. Defaults to JSON unless Accept requests CSV. Overrides Accept when supplied; errors remain JSON.
     * @param string $from Inclusive UTC start date, YYYY-MM-DD. Supply both dates for a custom range of at most 366 days. Omit both for the past 7 UTC calendar days including today.
     * @param string $to Exclusive UTC end date, YYYY-MM-DD. Must be after from and at most 366 days later.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function usage(
        \Chunkify\Metrics\MetricUsageParams\Format|string|null $format = null,
        ?string $from = null,
        ?string $to = null,
        RequestOptions|array|null $requestOptions = null,
    ): MetricsUsage;
}
