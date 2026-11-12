<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricsUsage\Daily;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Standalone Transcoding usage.
 *
 * @phpstan-type TranscodingsShape = array{
 *   audioOutputSeconds: int,
 *   failed: int,
 *   outputSeconds: int,
 *   outputSecondsByResolution: array<string,int>,
 *   ready: int,
 * }
 */
final class Transcodings implements BaseModel
{
    /** @use SdkModel<TranscodingsShape> */
    use SdkModel;

    /**
     * AudioOutputSeconds specifies the audio-only subset of output_seconds.
     */
    #[Required('audio_output_seconds')]
    public int $audioOutputSeconds;

    /**
     * Failed specifies recorded failed Transcoding outcomes.
     */
    #[Required]
    public int $failed;

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
     * Ready specifies recorded successful Transcoding outcomes.
     */
    #[Required]
    public int $ready;

    /**
     * `new Transcodings()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Transcodings::with(
     *   audioOutputSeconds: ...,
     *   failed: ...,
     *   outputSeconds: ...,
     *   outputSecondsByResolution: ...,
     *   ready: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Transcodings)
     *   ->withAudioOutputSeconds(...)
     *   ->withFailed(...)
     *   ->withOutputSeconds(...)
     *   ->withOutputSecondsByResolution(...)
     *   ->withReady(...)
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
        int $failed,
        int $outputSeconds,
        array $outputSecondsByResolution,
        int $ready,
    ): self {
        $self = new self;

        $self['audioOutputSeconds'] = $audioOutputSeconds;
        $self['failed'] = $failed;
        $self['outputSeconds'] = $outputSeconds;
        $self['outputSecondsByResolution'] = $outputSecondsByResolution;
        $self['ready'] = $ready;

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
     * Failed specifies recorded failed Transcoding outcomes.
     */
    public function withFailed(int $failed): self
    {
        $self = clone $this;
        $self['failed'] = $failed;

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

    /**
     * Ready specifies recorded successful Transcoding outcomes.
     */
    public function withReady(int $ready): self
    {
        $self = clone $this;
        $self['ready'] = $ready;

        return $self;
    }
}
