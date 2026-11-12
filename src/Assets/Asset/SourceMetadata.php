<?php

declare(strict_types=1);

namespace Chunkify\Assets\Asset;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Original media metadata saved at Asset creation and preserved after Source deletion.
 *
 * @phpstan-type SourceMetadataShape = array{
 *   audioBitrate: int,
 *   audioCodec: string,
 *   audioSamplerate: int,
 *   duration: float,
 *   height: int,
 *   size: int,
 *   videoBitrate: int,
 *   videoCodec: string,
 *   videoFramerate: float,
 *   width: int,
 * }
 */
final class SourceMetadata implements BaseModel
{
    /** @use SdkModel<SourceMetadataShape> */
    use SdkModel;

    /**
     * Original audio bitrate in bits per second, or zero when unavailable.
     */
    #[Required('audio_bitrate')]
    public int $audioBitrate;

    /**
     * Original audio codec, or an empty string when there is no audio.
     */
    #[Required('audio_codec')]
    public string $audioCodec;

    /**
     * Original audio sample rate in Hz, or zero when unavailable.
     */
    #[Required('audio_samplerate')]
    public int $audioSamplerate;

    /**
     * Original duration in seconds.
     */
    #[Required]
    public float $duration;

    /**
     * Original video height in pixels.
     */
    #[Required]
    public int $height;

    /**
     * Original file size in bytes.
     */
    #[Required]
    public int $size;

    /**
     * Original video bitrate in bits per second, or zero when unknown.
     */
    #[Required('video_bitrate')]
    public int $videoBitrate;

    /**
     * Original video codec.
     */
    #[Required('video_codec')]
    public string $videoCodec;

    /**
     * Original video frame rate in frames per second.
     */
    #[Required('video_framerate')]
    public float $videoFramerate;

    /**
     * Original video width in pixels.
     */
    #[Required]
    public int $width;

    /**
     * `new SourceMetadata()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SourceMetadata::with(
     *   audioBitrate: ...,
     *   audioCodec: ...,
     *   audioSamplerate: ...,
     *   duration: ...,
     *   height: ...,
     *   size: ...,
     *   videoBitrate: ...,
     *   videoCodec: ...,
     *   videoFramerate: ...,
     *   width: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SourceMetadata)
     *   ->withAudioBitrate(...)
     *   ->withAudioCodec(...)
     *   ->withAudioSamplerate(...)
     *   ->withDuration(...)
     *   ->withHeight(...)
     *   ->withSize(...)
     *   ->withVideoBitrate(...)
     *   ->withVideoCodec(...)
     *   ->withVideoFramerate(...)
     *   ->withWidth(...)
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
        int $audioBitrate,
        string $audioCodec,
        int $audioSamplerate,
        float $duration,
        int $height,
        int $size,
        int $videoBitrate,
        string $videoCodec,
        float $videoFramerate,
        int $width,
    ): self {
        $self = new self;

        $self['audioBitrate'] = $audioBitrate;
        $self['audioCodec'] = $audioCodec;
        $self['audioSamplerate'] = $audioSamplerate;
        $self['duration'] = $duration;
        $self['height'] = $height;
        $self['size'] = $size;
        $self['videoBitrate'] = $videoBitrate;
        $self['videoCodec'] = $videoCodec;
        $self['videoFramerate'] = $videoFramerate;
        $self['width'] = $width;

        return $self;
    }

    /**
     * Original audio bitrate in bits per second, or zero when unavailable.
     */
    public function withAudioBitrate(int $audioBitrate): self
    {
        $self = clone $this;
        $self['audioBitrate'] = $audioBitrate;

        return $self;
    }

    /**
     * Original audio codec, or an empty string when there is no audio.
     */
    public function withAudioCodec(string $audioCodec): self
    {
        $self = clone $this;
        $self['audioCodec'] = $audioCodec;

        return $self;
    }

    /**
     * Original audio sample rate in Hz, or zero when unavailable.
     */
    public function withAudioSamplerate(int $audioSamplerate): self
    {
        $self = clone $this;
        $self['audioSamplerate'] = $audioSamplerate;

        return $self;
    }

    /**
     * Original duration in seconds.
     */
    public function withDuration(float $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * Original video height in pixels.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Original file size in bytes.
     */
    public function withSize(int $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * Original video bitrate in bits per second, or zero when unknown.
     */
    public function withVideoBitrate(int $videoBitrate): self
    {
        $self = clone $this;
        $self['videoBitrate'] = $videoBitrate;

        return $self;
    }

    /**
     * Original video codec.
     */
    public function withVideoCodec(string $videoCodec): self
    {
        $self = clone $this;
        $self['videoCodec'] = $videoCodec;

        return $self;
    }

    /**
     * Original video frame rate in frames per second.
     */
    public function withVideoFramerate(float $videoFramerate): self
    {
        $self = clone $this;
        $self['videoFramerate'] = $videoFramerate;

        return $self;
    }

    /**
     * Original video width in pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
