<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricsAssets\Daily;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Lifecycle timing measurements. Period medians use all samples, not averages of daily medians.
 *
 * @phpstan-type TimingsShape = array{
 *   completionMedianSeconds: float|null,
 *   completionSampleCount: int,
 *   playbackMedianSeconds: float|null,
 *   playbackSampleCount: int,
 * }
 */
final class Timings implements BaseModel
{
    /** @use SdkModel<TimingsShape> */
    use SdkModel;

    /**
     * CompletionMedianSeconds specifies the median elapsed time from creation to full readiness. Null when no samples exist.
     */
    #[Required('completion_median_seconds')]
    public ?float $completionMedianSeconds;

    /**
     * CompletionSampleCount specifies Assets with a full readiness measurement.
     */
    #[Required('completion_sample_count')]
    public int $completionSampleCount;

    /**
     * PlaybackMedianSeconds specifies the median elapsed time from creation to playback readiness. Null when no samples exist.
     */
    #[Required('playback_median_seconds')]
    public ?float $playbackMedianSeconds;

    /**
     * PlaybackSampleCount specifies Assets with a playback readiness measurement.
     */
    #[Required('playback_sample_count')]
    public int $playbackSampleCount;

    /**
     * `new Timings()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Timings::with(
     *   completionMedianSeconds: ...,
     *   completionSampleCount: ...,
     *   playbackMedianSeconds: ...,
     *   playbackSampleCount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Timings)
     *   ->withCompletionMedianSeconds(...)
     *   ->withCompletionSampleCount(...)
     *   ->withPlaybackMedianSeconds(...)
     *   ->withPlaybackSampleCount(...)
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
     */
    public static function with(
        ?float $completionMedianSeconds,
        int $completionSampleCount,
        ?float $playbackMedianSeconds,
        int $playbackSampleCount,
    ): self {
        $self = new self;

        $self['completionMedianSeconds'] = $completionMedianSeconds;
        $self['completionSampleCount'] = $completionSampleCount;
        $self['playbackMedianSeconds'] = $playbackMedianSeconds;
        $self['playbackSampleCount'] = $playbackSampleCount;

        return $self;
    }

    /**
     * CompletionMedianSeconds specifies the median elapsed time from creation to full readiness. Null when no samples exist.
     */
    public function withCompletionMedianSeconds(
        ?float $completionMedianSeconds
    ): self {
        $self = clone $this;
        $self['completionMedianSeconds'] = $completionMedianSeconds;

        return $self;
    }

    /**
     * CompletionSampleCount specifies Assets with a full readiness measurement.
     */
    public function withCompletionSampleCount(int $completionSampleCount): self
    {
        $self = clone $this;
        $self['completionSampleCount'] = $completionSampleCount;

        return $self;
    }

    /**
     * PlaybackMedianSeconds specifies the median elapsed time from creation to playback readiness. Null when no samples exist.
     */
    public function withPlaybackMedianSeconds(
        ?float $playbackMedianSeconds
    ): self {
        $self = clone $this;
        $self['playbackMedianSeconds'] = $playbackMedianSeconds;

        return $self;
    }

    /**
     * PlaybackSampleCount specifies Assets with a playback readiness measurement.
     */
    public function withPlaybackSampleCount(int $playbackSampleCount): self
    {
        $self = clone $this;
        $self['playbackSampleCount'] = $playbackSampleCount;

        return $self;
    }
}
