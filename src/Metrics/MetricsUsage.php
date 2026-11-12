<?php

declare(strict_types=1);

namespace Chunkify\Metrics;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Metrics\MetricsUsage\Daily;
use Chunkify\Metrics\MetricsUsage\Summary;

/**
 * Project usage for the selected UTC accounting period.
 *
 * @phpstan-import-type DailyShape from \Chunkify\Metrics\MetricsUsage\Daily
 * @phpstan-import-type SummaryShape from \Chunkify\Metrics\MetricsUsage\Summary
 *
 * @phpstan-type MetricsUsageShape = array{
 *   daily: list<Daily|DailyShape>,
 *   from: string,
 *   summary: Summary|SummaryShape,
 *   to: string,
 * }
 */
final class MetricsUsage implements BaseModel
{
    /** @use SdkModel<MetricsUsageShape> */
    use SdkModel;

    /**
     * Daily specifies one record for every selected day, oldest first.
     *
     * @var list<Daily> $daily
     */
    #[Required(list: Daily::class)]
    public array $daily;

    /**
     * From specifies the inclusive UTC start date.
     */
    #[Required]
    public string $from;

    /**
     * Summary specifies totals across the selected period.
     */
    #[Required]
    public Summary $summary;

    /**
     * To specifies the exclusive UTC end date.
     */
    #[Required]
    public string $to;

    /**
     * `new MetricsUsage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MetricsUsage::with(daily: ..., from: ..., summary: ..., to: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MetricsUsage)->withDaily(...)->withFrom(...)->withSummary(...)->withTo(...)
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
     * @param list<Daily|DailyShape> $daily
     * @param Summary|SummaryShape $summary
     */
    public static function with(
        array $daily,
        string $from,
        Summary|array $summary,
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
     * Daily specifies one record for every selected day, oldest first.
     *
     * @param list<Daily|DailyShape> $daily
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
     * Summary specifies totals across the selected period.
     *
     * @param Summary|SummaryShape $summary
     */
    public function withSummary(Summary|array $summary): self
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
