<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\Metrics\MetricAssetsParams\Format;
use Chunkify\Metrics\MetricsAssets;
use Chunkify\Metrics\MetricsStorage;
use Chunkify\Metrics\MetricsUsage;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\MetricsContract;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class MetricsService implements MetricsContract
{
    /**
     * @api
     */
    public MetricsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MetricsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve Asset outcomes, timings, output sizes and source profiles by UTC creation date.
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
    ): MetricsAssets {
        $params = Util::removeNulls(
            ['format' => $format, 'from' => $from, 'to' => $to]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->assets(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve recorded additions and successful removals by storage and UTC date. Historical coverage depends on event retention.
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
    ): MetricsStorage {
        $params = Util::removeNulls(
            [
                'format' => $format,
                'from' => $from,
                'storageID' => $storageID,
                'to' => $to,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->storage(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve project usage totals and daily values for a UTC date range.
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
    ): MetricsUsage {
        $params = Util::removeNulls(
            ['format' => $format, 'from' => $from, 'to' => $to]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->usage(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
