<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricsAssets;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Metrics\MetricsAssets\Daily\Assets;
use Chunkify\Metrics\MetricsAssets\Daily\Outputs;
use Chunkify\Metrics\MetricsAssets\Daily\Sources;
use Chunkify\Metrics\MetricsAssets\Daily\Streaming;
use Chunkify\Metrics\MetricsAssets\Daily\Timings;

/**
 * Asset measurements grouped by creation day.
 *
 * @phpstan-import-type AssetsShape from \Chunkify\Metrics\MetricsAssets\Daily\Assets
 * @phpstan-import-type OutputsShape from \Chunkify\Metrics\MetricsAssets\Daily\Outputs
 * @phpstan-import-type SourcesShape from \Chunkify\Metrics\MetricsAssets\Daily\Sources
 * @phpstan-import-type StreamingShape from \Chunkify\Metrics\MetricsAssets\Daily\Streaming
 * @phpstan-import-type TimingsShape from \Chunkify\Metrics\MetricsAssets\Daily\Timings
 *
 * @phpstan-type DailyShape = array{
 *   assets: Assets|AssetsShape,
 *   date: string,
 *   outputs: Outputs|OutputsShape,
 *   sources: Sources|SourcesShape,
 *   streaming: Streaming|StreamingShape,
 *   timings: Timings|TimingsShape,
 * }
 */
final class Daily implements BaseModel
{
    /** @use SdkModel<DailyShape> */
    use SdkModel;

    /**
     * Asset outcomes grouped by Asset creation date.
     */
    #[Required]
    public Assets $assets;

    /**
     * Date specifies the UTC Asset creation day.
     */
    #[Required]
    public string $date;

    /**
     * Measured output sizes for completed Assets. Sample counts describe measurement coverage.
     */
    #[Required]
    public Outputs $outputs;

    /**
     * Source profiles count Assets, not unique Sources.
     */
    #[Required]
    public Sources $sources;

    /**
     * Streaming output distribution on completed Assets.
     */
    #[Required]
    public Streaming $streaming;

    /**
     * Lifecycle timing measurements. Period medians use all samples, not averages of daily medians.
     */
    #[Required]
    public Timings $timings;

    /**
     * `new Daily()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Daily::with(
     *   assets: ...,
     *   date: ...,
     *   outputs: ...,
     *   sources: ...,
     *   streaming: ...,
     *   timings: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Daily)
     *   ->withAssets(...)
     *   ->withDate(...)
     *   ->withOutputs(...)
     *   ->withSources(...)
     *   ->withStreaming(...)
     *   ->withTimings(...)
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
     * @param Assets|AssetsShape $assets
     * @param Outputs|OutputsShape $outputs
     * @param Sources|SourcesShape $sources
     * @param Streaming|StreamingShape $streaming
     * @param Timings|TimingsShape $timings
     */
    public static function with(
        Assets|array $assets,
        string $date,
        Outputs|array $outputs,
        Sources|array $sources,
        Streaming|array $streaming,
        Timings|array $timings,
    ): self {
        $self = new self;

        $self['assets'] = $assets;
        $self['date'] = $date;
        $self['outputs'] = $outputs;
        $self['sources'] = $sources;
        $self['streaming'] = $streaming;
        $self['timings'] = $timings;

        return $self;
    }

    /**
     * Asset outcomes grouped by Asset creation date.
     *
     * @param Assets|AssetsShape $assets
     */
    public function withAssets(Assets|array $assets): self
    {
        $self = clone $this;
        $self['assets'] = $assets;

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

    /**
     * Measured output sizes for completed Assets. Sample counts describe measurement coverage.
     *
     * @param Outputs|OutputsShape $outputs
     */
    public function withOutputs(Outputs|array $outputs): self
    {
        $self = clone $this;
        $self['outputs'] = $outputs;

        return $self;
    }

    /**
     * Source profiles count Assets, not unique Sources.
     *
     * @param Sources|SourcesShape $sources
     */
    public function withSources(Sources|array $sources): self
    {
        $self = clone $this;
        $self['sources'] = $sources;

        return $self;
    }

    /**
     * Streaming output distribution on completed Assets.
     *
     * @param Streaming|StreamingShape $streaming
     */
    public function withStreaming(Streaming|array $streaming): self
    {
        $self = clone $this;
        $self['streaming'] = $streaming;

        return $self;
    }

    /**
     * Lifecycle timing measurements. Period medians use all samples, not averages of daily medians.
     *
     * @param Timings|TimingsShape $timings
     */
    public function withTimings(Timings|array $timings): self
    {
        $self = clone $this;
        $self['timings'] = $timings;

        return $self;
    }
}
