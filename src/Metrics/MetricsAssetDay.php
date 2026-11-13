<?php

declare(strict_types=1);

namespace Chunkify\Metrics;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Asset measurements grouped by creation day.
 *
 * @phpstan-import-type MetricsAssetCountsShape from \Chunkify\Metrics\MetricsAssetCounts
 * @phpstan-import-type MetricsAssetOutputsShape from \Chunkify\Metrics\MetricsAssetOutputs
 * @phpstan-import-type MetricsAssetSourcesShape from \Chunkify\Metrics\MetricsAssetSources
 * @phpstan-import-type MetricsAssetStreamingShape from \Chunkify\Metrics\MetricsAssetStreaming
 * @phpstan-import-type MetricsAssetTimingsShape from \Chunkify\Metrics\MetricsAssetTimings
 *
 * @phpstan-type MetricsAssetDayShape = array{
 *   assets: MetricsAssetCounts|MetricsAssetCountsShape,
 *   outputs: MetricsAssetOutputs|MetricsAssetOutputsShape,
 *   sources: MetricsAssetSources|MetricsAssetSourcesShape,
 *   streaming: MetricsAssetStreaming|MetricsAssetStreamingShape,
 *   timings: MetricsAssetTimings|MetricsAssetTimingsShape,
 *   date: string,
 * }
 */
final class MetricsAssetDay implements BaseModel
{
    /** @use SdkModel<MetricsAssetDayShape> */
    use SdkModel;

    /**
     * Asset outcomes grouped by Asset creation date.
     */
    #[Required]
    public MetricsAssetCounts $assets;

    /**
     * Measured output sizes for completed Assets. Sample counts describe measurement coverage.
     */
    #[Required]
    public MetricsAssetOutputs $outputs;

    /**
     * Source profiles count Assets, not unique Sources.
     */
    #[Required]
    public MetricsAssetSources $sources;

    /**
     * Streaming output distribution on completed Assets.
     */
    #[Required]
    public MetricsAssetStreaming $streaming;

    /**
     * Lifecycle timing measurements. Period medians use all samples, not averages of daily medians.
     */
    #[Required]
    public MetricsAssetTimings $timings;

    /**
     * Date specifies the UTC Asset creation day.
     */
    #[Required]
    public string $date;

    /**
     * `new MetricsAssetDay()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MetricsAssetDay::with(
     *   assets: ...,
     *   outputs: ...,
     *   sources: ...,
     *   streaming: ...,
     *   timings: ...,
     *   date: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MetricsAssetDay)
     *   ->withAssets(...)
     *   ->withOutputs(...)
     *   ->withSources(...)
     *   ->withStreaming(...)
     *   ->withTimings(...)
     *   ->withDate(...)
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
     * @param MetricsAssetCounts|MetricsAssetCountsShape $assets
     * @param MetricsAssetOutputs|MetricsAssetOutputsShape $outputs
     * @param MetricsAssetSources|MetricsAssetSourcesShape $sources
     * @param MetricsAssetStreaming|MetricsAssetStreamingShape $streaming
     * @param MetricsAssetTimings|MetricsAssetTimingsShape $timings
     */
    public static function with(
        MetricsAssetCounts|array $assets,
        MetricsAssetOutputs|array $outputs,
        MetricsAssetSources|array $sources,
        MetricsAssetStreaming|array $streaming,
        MetricsAssetTimings|array $timings,
        string $date,
    ): self {
        $self = new self;

        $self['assets'] = $assets;
        $self['outputs'] = $outputs;
        $self['sources'] = $sources;
        $self['streaming'] = $streaming;
        $self['timings'] = $timings;
        $self['date'] = $date;

        return $self;
    }

    /**
     * Asset outcomes grouped by Asset creation date.
     *
     * @param MetricsAssetCounts|MetricsAssetCountsShape $assets
     */
    public function withAssets(MetricsAssetCounts|array $assets): self
    {
        $self = clone $this;
        $self['assets'] = $assets;

        return $self;
    }

    /**
     * Measured output sizes for completed Assets. Sample counts describe measurement coverage.
     *
     * @param MetricsAssetOutputs|MetricsAssetOutputsShape $outputs
     */
    public function withOutputs(MetricsAssetOutputs|array $outputs): self
    {
        $self = clone $this;
        $self['outputs'] = $outputs;

        return $self;
    }

    /**
     * Source profiles count Assets, not unique Sources.
     *
     * @param MetricsAssetSources|MetricsAssetSourcesShape $sources
     */
    public function withSources(MetricsAssetSources|array $sources): self
    {
        $self = clone $this;
        $self['sources'] = $sources;

        return $self;
    }

    /**
     * Streaming output distribution on completed Assets.
     *
     * @param MetricsAssetStreaming|MetricsAssetStreamingShape $streaming
     */
    public function withStreaming(MetricsAssetStreaming|array $streaming): self
    {
        $self = clone $this;
        $self['streaming'] = $streaming;

        return $self;
    }

    /**
     * Lifecycle timing measurements. Period medians use all samples, not averages of daily medians.
     *
     * @param MetricsAssetTimings|MetricsAssetTimingsShape $timings
     */
    public function withTimings(MetricsAssetTimings|array $timings): self
    {
        $self = clone $this;
        $self['timings'] = $timings;

        return $self;
    }

    /**
     * Date specifies the UTC Asset creation day.
     */
    public function withDate(string $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }
}
