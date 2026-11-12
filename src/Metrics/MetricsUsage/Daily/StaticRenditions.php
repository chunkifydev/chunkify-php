<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricsUsage\Daily;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Static rendition usage.
 *
 * @phpstan-type StaticRenditionsShape = array{
 *   audioOutputSeconds: int,
 *   outputSeconds: int,
 *   outputSecondsByResolution: array<string,int>,
 * }
 */
final class StaticRenditions implements BaseModel
{
    /** @use SdkModel<StaticRenditionsShape> */
    use SdkModel;

    /**
     * AudioOutputSeconds specifies the audio-only subset of output_seconds.
     */
    #[Required('audio_output_seconds')]
    public int $audioOutputSeconds;

    /**
     * OutputSeconds specifies settled billable output duration, including audio-only output.
     */
    #[Required('output_seconds')]
    public int $outputSeconds;

    /**
     * Video duration in seconds by pricing resolution tier. Contains sd, hd, 2k and uhd keys; audio is reported separately.
     *
     * @var array<string,int> $outputSecondsByResolution
     */
    #[Required('output_seconds_by_resolution', map: 'int')]
    public array $outputSecondsByResolution;

    /**
     * `new StaticRenditions()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StaticRenditions::with(
     *   audioOutputSeconds: ..., outputSeconds: ..., outputSecondsByResolution: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StaticRenditions)
     *   ->withAudioOutputSeconds(...)
     *   ->withOutputSeconds(...)
     *   ->withOutputSecondsByResolution(...)
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
     * @param array<string,int> $outputSecondsByResolution
     */
    public static function with(
        int $audioOutputSeconds,
        int $outputSeconds,
        array $outputSecondsByResolution,
    ): self {
        $self = new self;

        $self['audioOutputSeconds'] = $audioOutputSeconds;
        $self['outputSeconds'] = $outputSeconds;
        $self['outputSecondsByResolution'] = $outputSecondsByResolution;

        return $self;
    }

    /**
     * AudioOutputSeconds specifies the audio-only subset of output_seconds.
     */
    public function withAudioOutputSeconds(int $audioOutputSeconds): self
    {
        $self = clone $this;
        $self['audioOutputSeconds'] = $audioOutputSeconds;

        return $self;
    }

    /**
     * OutputSeconds specifies settled billable output duration, including audio-only output.
     */
    public function withOutputSeconds(int $outputSeconds): self
    {
        $self = clone $this;
        $self['outputSeconds'] = $outputSeconds;

        return $self;
    }

    /**
     * Video duration in seconds by pricing resolution tier. Contains sd, hd, 2k and uhd keys; audio is reported separately.
     *
     * @param array<string,int> $outputSecondsByResolution
     */
    public function withOutputSecondsByResolution(
        array $outputSecondsByResolution
    ): self {
        $self = clone $this;
        $self['outputSecondsByResolution'] = $outputSecondsByResolution;

        return $self;
    }
}
