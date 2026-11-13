<?php

declare(strict_types=1);

namespace Chunkify\Transcodings;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Transcodings\TranscodingFormat\ID;

/**
 * Resolved encoding settings accepted at creation. Only settings applicable to the selected streams and codec are included.
 *
 * @phpstan-type TranscodingFormatShape = array{
 *   id: ID|value-of<ID>,
 *   duration: float,
 *   seek: float,
 *   audioBitrate?: int|null,
 *   audioSamplerate?: int|null,
 *   bufsize?: int|null,
 *   channels?: int|null,
 *   cpuUsed?: string|null,
 *   crf?: int|null,
 *   disableAudio?: bool|null,
 *   framerate?: float|null,
 *   gop?: int|null,
 *   height?: int|null,
 *   level?: int|null,
 *   maxrate?: int|null,
 *   minrate?: int|null,
 *   movflags?: string|null,
 *   perTitle?: bool|null,
 *   pixfmt?: string|null,
 *   preset?: string|null,
 *   profilev?: string|null,
 *   quality?: string|null,
 *   videoBitrate?: int|null,
 *   width?: int|null,
 * }
 */
final class TranscodingFormat implements BaseModel
{
    /** @use SdkModel<TranscodingFormatShape> */
    use SdkModel;

    /**
     * Id specifies the resolved container and codec selection.
     *
     * @var value-of<ID> $id
     */
    #[Required(enum: ID::class)]
    public string $id;

    /**
     * Duration specifies the accepted output duration in seconds, including normalized trims.
     */
    #[Required]
    public float $duration;

    /**
     * Seek specifies the accepted start position in source seconds, normalized to the output timeline.
     */
    #[Required]
    public float $seek;

    /**
     * AudioBitrate specifies the resolved audio bitrate in bits per second. Omitted for video-only output.
     */
    #[Optional('audio_bitrate')]
    public ?int $audioBitrate;

    /**
     * AudioSamplerate specifies the resolved audio samples per second. Omitted for video-only output.
     */
    #[Optional('audio_samplerate')]
    public ?int $audioSamplerate;

    /**
     * Bufsize specifies the resolved video buffer size in bits, including codec-level defaults. Omitted when no buffer applies.
     */
    #[Optional]
    public ?int $bufsize;

    /**
     * Channels specifies the resolved audio channel count: 1, 2, 6 or 8. Omitted for video-only output.
     */
    #[Optional]
    public ?int $channels;

    /**
     * CpuUsed specifies the accepted VP9 encoder speed setting from 0 through 8. Omitted for other codecs.
     */
    #[Optional('cpu_used')]
    public ?string $cpuUsed;

    /**
     * Crf specifies the accepted constant quality. Omitted for bitrate-controlled, per-title and audio-only encoding.
     */
    #[Optional]
    public ?int $crf;

    /**
     * DisableAudio is true for video-only output. Omitted when audio is selected.
     */
    #[Optional('disable_audio')]
    public ?bool $disableAudio;

    /**
     * Framerate specifies the resolved video frames per second. Omitted for audio-only output.
     */
    #[Optional]
    public ?float $framerate;

    /**
     * Gop specifies the resolved maximum keyframe interval in frames. Omitted for audio-only output.
     */
    #[Optional]
    public ?int $gop;

    /**
     * Height specifies the resolved video height in pixels. Omitted for audio-only output.
     */
    #[Optional]
    public ?int $height;

    /**
     * Level specifies the accepted codec level when explicitly selected.
     */
    #[Optional]
    public ?int $level;

    /**
     * Maxrate specifies the resolved maximum video bitrate in bits per second, including codec-level defaults. Omitted when no maximum applies.
     */
    #[Optional]
    public ?int $maxrate;

    /**
     * Minrate specifies the accepted minimum video bitrate in bits per second, when configured.
     */
    #[Optional]
    public ?int $minrate;

    /**
     * Movflags specifies MP4 packaging. MP4 video exports use faststart.
     */
    #[Optional]
    public ?string $movflags;

    /**
     * PerTitle specifies whether video rate control is selected during content analysis. Omitted for audio-only output.
     */
    #[Optional('per_title')]
    public ?bool $perTitle;

    /**
     * Pixfmt specifies the accepted video pixel format. Omitted for audio-only output.
     */
    #[Optional]
    public ?string $pixfmt;

    /**
     * Preset specifies the accepted codec preset. Omitted when the codec does not use presets.
     */
    #[Optional]
    public ?string $preset;

    /**
     * Profilev specifies the accepted codec profile when explicitly selected.
     */
    #[Optional]
    public ?string $profilev;

    /**
     * Quality specifies the accepted VP9 deadline policy: good, best or realtime. Omitted for other codecs.
     */
    #[Optional]
    public ?string $quality;

    /**
     * VideoBitrate specifies the accepted video bitrate in bits per second. Omitted for CRF and per-title encoding.
     */
    #[Optional('video_bitrate')]
    public ?int $videoBitrate;

    /**
     * Width specifies the resolved video width in pixels. Omitted for audio-only output.
     */
    #[Optional]
    public ?int $width;

    /**
     * `new TranscodingFormat()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TranscodingFormat::with(id: ..., duration: ..., seek: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TranscodingFormat)->withID(...)->withDuration(...)->withSeek(...)
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
     * @param ID|value-of<ID> $id
     */
    public static function with(
        ID|string $id,
        float $duration,
        float $seek,
        ?int $audioBitrate = null,
        ?int $audioSamplerate = null,
        ?int $bufsize = null,
        ?int $channels = null,
        ?string $cpuUsed = null,
        ?int $crf = null,
        ?bool $disableAudio = null,
        ?float $framerate = null,
        ?int $gop = null,
        ?int $height = null,
        ?int $level = null,
        ?int $maxrate = null,
        ?int $minrate = null,
        ?string $movflags = null,
        ?bool $perTitle = null,
        ?string $pixfmt = null,
        ?string $preset = null,
        ?string $profilev = null,
        ?string $quality = null,
        ?int $videoBitrate = null,
        ?int $width = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['duration'] = $duration;
        $self['seek'] = $seek;

        null !== $audioBitrate && $self['audioBitrate'] = $audioBitrate;
        null !== $audioSamplerate && $self['audioSamplerate'] = $audioSamplerate;
        null !== $bufsize && $self['bufsize'] = $bufsize;
        null !== $channels && $self['channels'] = $channels;
        null !== $cpuUsed && $self['cpuUsed'] = $cpuUsed;
        null !== $crf && $self['crf'] = $crf;
        null !== $disableAudio && $self['disableAudio'] = $disableAudio;
        null !== $framerate && $self['framerate'] = $framerate;
        null !== $gop && $self['gop'] = $gop;
        null !== $height && $self['height'] = $height;
        null !== $level && $self['level'] = $level;
        null !== $maxrate && $self['maxrate'] = $maxrate;
        null !== $minrate && $self['minrate'] = $minrate;
        null !== $movflags && $self['movflags'] = $movflags;
        null !== $perTitle && $self['perTitle'] = $perTitle;
        null !== $pixfmt && $self['pixfmt'] = $pixfmt;
        null !== $preset && $self['preset'] = $preset;
        null !== $profilev && $self['profilev'] = $profilev;
        null !== $quality && $self['quality'] = $quality;
        null !== $videoBitrate && $self['videoBitrate'] = $videoBitrate;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Id specifies the resolved container and codec selection.
     *
     * @param ID|value-of<ID> $id
     */
    public function withID(ID|string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Duration specifies the accepted output duration in seconds, including normalized trims.
     */
    public function withDuration(float $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * Seek specifies the accepted start position in source seconds, normalized to the output timeline.
     */
    public function withSeek(float $seek): self
    {
        $self = clone $this;
        $self['seek'] = $seek;

        return $self;
    }

    /**
     * AudioBitrate specifies the resolved audio bitrate in bits per second. Omitted for video-only output.
     */
    public function withAudioBitrate(int $audioBitrate): self
    {
        $self = clone $this;
        $self['audioBitrate'] = $audioBitrate;

        return $self;
    }

    /**
     * AudioSamplerate specifies the resolved audio samples per second. Omitted for video-only output.
     */
    public function withAudioSamplerate(int $audioSamplerate): self
    {
        $self = clone $this;
        $self['audioSamplerate'] = $audioSamplerate;

        return $self;
    }

    /**
     * Bufsize specifies the resolved video buffer size in bits, including codec-level defaults. Omitted when no buffer applies.
     */
    public function withBufsize(int $bufsize): self
    {
        $self = clone $this;
        $self['bufsize'] = $bufsize;

        return $self;
    }

    /**
     * Channels specifies the resolved audio channel count: 1, 2, 6 or 8. Omitted for video-only output.
     */
    public function withChannels(int $channels): self
    {
        $self = clone $this;
        $self['channels'] = $channels;

        return $self;
    }

    /**
     * CpuUsed specifies the accepted VP9 encoder speed setting from 0 through 8. Omitted for other codecs.
     */
    public function withCPUUsed(string $cpuUsed): self
    {
        $self = clone $this;
        $self['cpuUsed'] = $cpuUsed;

        return $self;
    }

    /**
     * Crf specifies the accepted constant quality. Omitted for bitrate-controlled, per-title and audio-only encoding.
     */
    public function withCrf(int $crf): self
    {
        $self = clone $this;
        $self['crf'] = $crf;

        return $self;
    }

    /**
     * DisableAudio is true for video-only output. Omitted when audio is selected.
     */
    public function withDisableAudio(bool $disableAudio): self
    {
        $self = clone $this;
        $self['disableAudio'] = $disableAudio;

        return $self;
    }

    /**
     * Framerate specifies the resolved video frames per second. Omitted for audio-only output.
     */
    public function withFramerate(float $framerate): self
    {
        $self = clone $this;
        $self['framerate'] = $framerate;

        return $self;
    }

    /**
     * Gop specifies the resolved maximum keyframe interval in frames. Omitted for audio-only output.
     */
    public function withGop(int $gop): self
    {
        $self = clone $this;
        $self['gop'] = $gop;

        return $self;
    }

    /**
     * Height specifies the resolved video height in pixels. Omitted for audio-only output.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Level specifies the accepted codec level when explicitly selected.
     */
    public function withLevel(int $level): self
    {
        $self = clone $this;
        $self['level'] = $level;

        return $self;
    }

    /**
     * Maxrate specifies the resolved maximum video bitrate in bits per second, including codec-level defaults. Omitted when no maximum applies.
     */
    public function withMaxrate(int $maxrate): self
    {
        $self = clone $this;
        $self['maxrate'] = $maxrate;

        return $self;
    }

    /**
     * Minrate specifies the accepted minimum video bitrate in bits per second, when configured.
     */
    public function withMinrate(int $minrate): self
    {
        $self = clone $this;
        $self['minrate'] = $minrate;

        return $self;
    }

    /**
     * Movflags specifies MP4 packaging. MP4 video exports use faststart.
     */
    public function withMovflags(string $movflags): self
    {
        $self = clone $this;
        $self['movflags'] = $movflags;

        return $self;
    }

    /**
     * PerTitle specifies whether video rate control is selected during content analysis. Omitted for audio-only output.
     */
    public function withPerTitle(bool $perTitle): self
    {
        $self = clone $this;
        $self['perTitle'] = $perTitle;

        return $self;
    }

    /**
     * Pixfmt specifies the accepted video pixel format. Omitted for audio-only output.
     */
    public function withPixfmt(string $pixfmt): self
    {
        $self = clone $this;
        $self['pixfmt'] = $pixfmt;

        return $self;
    }

    /**
     * Preset specifies the accepted codec preset. Omitted when the codec does not use presets.
     */
    public function withPreset(string $preset): self
    {
        $self = clone $this;
        $self['preset'] = $preset;

        return $self;
    }

    /**
     * Profilev specifies the accepted codec profile when explicitly selected.
     */
    public function withProfilev(string $profilev): self
    {
        $self = clone $this;
        $self['profilev'] = $profilev;

        return $self;
    }

    /**
     * Quality specifies the accepted VP9 deadline policy: good, best or realtime. Omitted for other codecs.
     */
    public function withQuality(string $quality): self
    {
        $self = clone $this;
        $self['quality'] = $quality;

        return $self;
    }

    /**
     * VideoBitrate specifies the accepted video bitrate in bits per second. Omitted for CRF and per-title encoding.
     */
    public function withVideoBitrate(int $videoBitrate): self
    {
        $self = clone $this;
        $self['videoBitrate'] = $videoBitrate;

        return $self;
    }

    /**
     * Width specifies the resolved video width in pixels. Omitted for audio-only output.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
