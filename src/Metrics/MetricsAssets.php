<?php

declare(strict_types=1);

namespace Chunkify\Metrics;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Measurements saved on retained Assets. Explicit deletion can change historical results; temporary media cleanup does not erase saved Asset measurements.
 *
 * @phpstan-import-type MetricsAssetDayShape from \Chunkify\Metrics\MetricsAssetDay
 * @phpstan-import-type MetricsAssetValuesShape from \Chunkify\Metrics\MetricsAssetValues
 *
 * @phpstan-type MetricsAssetsShape = array{
 *   daily: list<MetricsAssetDay|MetricsAssetDayShape>,
 *   from: string,
 *   summary: MetricsAssetValues|MetricsAssetValuesShape,
 *   to: string,
 * }
 */
final class MetricsAssets implements BaseModel
{
    /** @use SdkModel<MetricsAssetsShape> */
    use SdkModel;

    /**
     * Daily specifies one record for each selected creation day, oldest first.
     *
     * @var list<MetricsAssetDay> $daily
     */
    #[Required(list: MetricsAssetDay::class)]
    public array $daily;

    /**
     * From specifies the inclusive UTC start date.
     */
    #[Required]
    public string $from;

    /**
     * Summary specifies the complete creation-date cohort.
     */
    #[Required]
    public MetricsAssetValues $summary;

    /**
     * To specifies the exclusive UTC end date.
     */
    #[Required]
    public string $to;

    /**
     * `new MetricsAssets()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MetricsAssets::with(daily: ..., from: ..., summary: ..., to: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MetricsAssets)
     *   ->withDaily(...)
     *   ->withFrom(...)
     *   ->withSummary(...)
     *   ->withTo(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<MetricsAssetDay|MetricsAssetDayShape> $daily
     * @param MetricsAssetValues|MetricsAssetValuesShape $summary
     */
    public static function with(
        array $daily,
        string $from,
        MetricsAssetValues|array $summary,
        string $to
    ): self {
        $self = new self;

        $self['daily'] = $daily;
        $self['from'] = $from;
        $self['summary'] = $summary;
        $self['to'] = $to;

        return $self;
    }

    /**
     * Daily specifies one record for each selected creation day, oldest first.
     *
     * @param list<MetricsAssetDay|MetricsAssetDayShape> $daily
     */
    public function withDaily(array $daily): self
    {
        $self = clone $this;
        $self['daily'] = $daily;

        return $self;
    }

    /**
     * From specifies the inclusive UTC start date.
     */
    public function withFrom(string $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * Summary specifies the complete creation-date cohort.
     *
     * @param MetricsAssetValues|MetricsAssetValuesShape $summary
     */
    public function withSummary(MetricsAssetValues|array $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }

    /**
     * To specifies the exclusive UTC end date.
     */
    public function withTo(string $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
