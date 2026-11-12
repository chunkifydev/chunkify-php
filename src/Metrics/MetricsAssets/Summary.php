<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricsAssets;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Metrics\MetricsAssets\Summary\Assets;
use Chunkify\Metrics\MetricsAssets\Summary\Outputs;
use Chunkify\Metrics\MetricsAssets\Summary\Sources;
use Chunkify\Metrics\MetricsAssets\Summary\Streaming;
use Chunkify\Metrics\MetricsAssets\Summary\Timings;

/**
 * Summary specifies the complete creation-date cohort.
 *
 * @phpstan-import-type AssetsShape from \Chunkify\Metrics\MetricsAssets\Summary\Assets
 * @phpstan-import-type OutputsShape from \Chunkify\Metrics\MetricsAssets\Summary\Outputs
 * @phpstan-import-type SourcesShape from \Chunkify\Metrics\MetricsAssets\Summary\Sources
 * @phpstan-import-type StreamingShape from \Chunkify\Metrics\MetricsAssets\Summary\Streaming
 * @phpstan-import-type TimingsShape from \Chunkify\Metrics\MetricsAssets\Summary\Timings
 *
 * @phpstan-type SummaryShape = array{
 *   assets: Assets|AssetsShape,
 *   outputs: Outputs|OutputsShape,
 *   sources: Sources|SourcesShape,
 *   streaming: Streaming|StreamingShape,
 *   timings: Timings|TimingsShape,
 * }
 */
final class Summary implements BaseModel
{
    /** @use SdkModel<SummaryShape> */
    use SdkModel;

    /**
     * Asset outcomes grouped by Asset creation date.
     */
    #[Required]
    public Assets $assets;

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
     * `new Summary()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Summary::with(
     *   assets: ..., outputs: ..., sources: ..., streaming: ..., timings: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Summary)
     *   ->withAssets(...)
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
        Outputs|array $outputs,
        Sources|array $sources,
        Streaming|array $streaming,
        Timings|array $timings,
    ): self {
        $self = new self;

        $self['assets'] = $assets;
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
