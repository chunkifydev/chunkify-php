<?php

declare(strict_types=1);

namespace Chunkify\Transcodings;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Transcodings\TranscodingWebmVp9\AudioSamplerate;
use Chunkify\Transcodings\TranscodingWebmVp9\Channels;
use Chunkify\Transcodings\TranscodingWebmVp9\CPUUsed;
use Chunkify\Transcodings\TranscodingWebmVp9\Pixfmt;
use Chunkify\Transcodings\TranscodingWebmVp9\Quality;

/**
 * @phpstan-type TranscodingWebmVp9Shape = array{
 *   id: 'webm_vp9',
 *   audioBitrate?: int|null,
 *   audioSamplerate?: null|AudioSamplerate|value-of<AudioSamplerate>,
 *   bufsize?: int|null,
 *   channels?: null|Channels|value-of<Channels>,
 *   cpuUsed?: null|CPUUsed|value-of<CPUUsed>,
 *   crf?: int|null,
 *   disableAudio?: bool|null,
 *   disableVideo?: bool|null,
 *   duration?: float|null,
 *   framerate?: float|null,
 *   gop?: int|null,
 *   height?: int|null,
 *   maxrate?: int|null,
 *   minrate?: int|null,
 *   perTitle?: bool|null,
 *   pixfmt?: null|Pixfmt|value-of<Pixfmt>,
 *   quality?: null|Quality|value-of<Quality>,
 *   seek?: float|null,
 *   videoBitrate?: int|null,
 *   width?: int|null,
 * }
 */
final class TranscodingWebmVp9 implements BaseModel
{
    /** @use SdkModel<TranscodingWebmVp9Shape> */
    use SdkModel;

    /**
     * Id specifies the output format.
     *
     * @var 'webm_vp9' $id
     */
    #[Required]
    public string $id = 'webm_vp9';

    /**
     * AudioBitrate specifies the output audio bitrate in bits per second. Defaults to 128000.
     */
    #[Optional('audio_bitrate')]
    public ?int $audioBitrate;

    /**
     * AudioSamplerate specifies the output sample rate in Hz. Defaults to 48000. WebM Opus audio uses 48000.
     *
     * @var value-of<AudioSamplerate>|null $audioSamplerate
     */
    #[Optional('audio_samplerate', enum: AudioSamplerate::class)]
    public ?int $audioSamplerate;

    /**
     * Bufsize specifies the video buffer size in bits, from 100000 through 50000000. H.264 and H.265 require maxrate. AV1 and VP9 require a bitrate-controlled mode.
     */
    #[Optional]
    public ?int $bufsize;

    /**
     * Channels specifies the output channel count. Defaults to stereo. Six channels means 5.1; eight means 7.1.
     *
     * @var value-of<Channels>|null $channels
     */
    #[Optional(enum: Channels::class)]
    public ?int $channels;

    /**
     * CpuUsed specifies the CPU usage level for VP9 encoding. Range: 0 to 8.
     * Lower values mean better quality but slower encoding, higher values mean faster encoding but lower quality.
     * Recommended values: 0-2 for high quality, 2-4 for good quality, 4-6 for balanced, 6-8 for speed.
     *
     * @var value-of<CPUUsed>|null $cpuUsed
     */
    #[Optional('cpu_used', enum: CPUUsed::class)]
    public ?string $cpuUsed;

    /**
     * Crf (Constant Rate Factor) controls the quality of the output video.
     * Lower values mean better quality but larger file size. Range: 15 to 35.
     * Recommended values: 18-28 for high quality, 23-28 for good quality, 28-35 for acceptable quality.
     */
    #[Optional]
    public ?int $crf;

    /**
     * DisableAudio omits the audio stream. Defaults to false. A source without audio produces video only.
     */
    #[Optional('disable_audio')]
    public ?bool $disableAudio;

    /**
     * DisableVideo selects an audio-only AAC M4A export. Defaults to false. The source must contain audio.
     */
    #[Optional('disable_video')]
    public ?bool $disableVideo;

    /**
     * Duration specifies the requested output length in seconds. Defaults to the remaining source duration and is capped at the source end. Audio-only output must resolve to at least 0.001 seconds after trimming and sample rounding. The accepted interval determines the fixed price.
     */
    #[Optional]
    public ?float $duration;

    /**
     * Framerate specifies the output video frame rate. Defaults to the source rate and must be between 0.001 and 240 fps.
     */
    #[Optional]
    public ?float $framerate;

    /**
     * Gop specifies the maximum keyframe interval in frames. Defaults to four seconds at the accepted frame rate, capped at 960 frames.
     */
    #[Optional]
    public ?int $gop;

    /**
     * Height specifies the output dimension in pixels. Use -2 or omit one dimension to preserve the source aspect ratio. Explicit dimensions must be 2 to 7680 and even. Omitting both preserves the source dimensions rounded down to even pixels.
     */
    #[Optional]
    public ?int $height;

    /**
     * Maxrate specifies the video buffer maximum rate in bits per second, from 100000 through 50000000. H.264 and H.265 require bufsize. VP9 requires video_bitrate; AV1 requires CRF mode.
     */
    #[Optional]
    public ?int $maxrate;

    /**
     * Minrate selects VP9 constant bitrate when equal to video_bitrate and maxrate. Other minimum-rate combinations are unsupported.
     */
    #[Optional]
    public ?int $minrate;

    /**
     * PerTitle enables independent content-based bitrate prediction for each part of the video. Analysis uses only the selected trim interval. Defaults to false. Explicit rate-control settings cannot be combined with it.
     */
    #[Optional('per_title')]
    public ?bool $perTitle;

    /**
     * Pixfmt specifies the output pixel format. Defaults to yuv420p. The selected profile must support it.
     *
     * @var value-of<Pixfmt>|null $pixfmt
     */
    #[Optional(enum: Pixfmt::class)]
    public ?string $pixfmt;

    /**
     * Quality specifies the VP9 encoding quality preset. Valid values:
     * - good: Balanced quality preset, good for most applications
     * - best: Best quality preset, slower encoding
     * - realtime: Fast encoding preset, suitable for live streaming
     *
     * @var value-of<Quality>|null $quality
     */
    #[Optional(enum: Quality::class)]
    public ?string $quality;

    /**
     * Seek specifies the start in source seconds. Defaults to zero and must precede the source end. The accepted interval uses the output frame or sample timeline. Audio-only output must retain at least 0.001 seconds after sample rounding.
     */
    #[Optional]
    public ?float $seek;

    /**
     * VideoBitrate specifies the target video bitrate in bits per second, from 1000 through 100000000. Omit it for CRF or per-title encoding.
     */
    #[Optional('video_bitrate')]
    public ?int $videoBitrate;

    /**
     * Width specifies the output dimension in pixels. Use -2 or omit one dimension to preserve the source aspect ratio. Explicit dimensions must be 2 to 7680 and even. Omitting both preserves the source dimensions rounded down to even pixels.
     */
    #[Optional]
    public ?int $width;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AudioSamplerate|value-of<AudioSamplerate>|null $audioSamplerate
     * @param Channels|value-of<Channels>|null $channels
     * @param CPUUsed|value-of<CPUUsed>|null $cpuUsed
     * @param Pixfmt|value-of<Pixfmt>|null $pixfmt
     * @param Quality|value-of<Quality>|null $quality
     */
    public static function with(
        ?int $audioBitrate = null,
        AudioSamplerate|int|null $audioSamplerate = null,
        ?int $bufsize = null,
        Channels|int|null $channels = null,
        CPUUsed|string|null $cpuUsed = null,
        ?int $crf = null,
        ?bool $disableAudio = null,
        ?bool $disableVideo = null,
        ?float $duration = null,
        ?float $framerate = null,
        ?int $gop = null,
        ?int $height = null,
        ?int $maxrate = null,
        ?int $minrate = null,
        ?bool $perTitle = null,
        Pixfmt|string|null $pixfmt = null,
        Quality|string|null $quality = null,
        ?float $seek = null,
        ?int $videoBitrate = null,
        ?int $width = null,
    ): self {
        $self = new self;

        null !== $audioBitrate && $self['audioBitrate'] = $audioBitrate;
        null !== $audioSamplerate && $self['audioSamplerate'] = $audioSamplerate;
        null !== $bufsize && $self['bufsize'] = $bufsize;
        null !== $channels && $self['channels'] = $channels;
        null !== $cpuUsed && $self['cpuUsed'] = $cpuUsed;
        null !== $crf && $self['crf'] = $crf;
        null !== $disableAudio && $self['disableAudio'] = $disableAudio;
        null !== $disableVideo && $self['disableVideo'] = $disableVideo;
        null !== $duration && $self['duration'] = $duration;
        null !== $framerate && $self['framerate'] = $framerate;
        null !== $gop && $self['gop'] = $gop;
        null !== $height && $self['height'] = $height;
        null !== $maxrate && $self['maxrate'] = $maxrate;
        null !== $minrate && $self['minrate'] = $minrate;
        null !== $perTitle && $self['perTitle'] = $perTitle;
        null !== $pixfmt && $self['pixfmt'] = $pixfmt;
        null !== $quality && $self['quality'] = $quality;
        null !== $seek && $self['seek'] = $seek;
        null !== $videoBitrate && $self['videoBitrate'] = $videoBitrate;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Id specifies the output format.
     *
     * @param 'webm_vp9' $id
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * AudioBitrate specifies the output audio bitrate in bits per second. Defaults to 128000.
     */
    public function withAudioBitrate(int $audioBitrate): self
    {
        $self = clone $this;
        $self['audioBitrate'] = $audioBitrate;

        return $self;
    }

    /**
     * AudioSamplerate specifies the output sample rate in Hz. Defaults to 48000. WebM Opus audio uses 48000.
     *
     * @param AudioSamplerate|value-of<AudioSamplerate> $audioSamplerate
     */
    public function withAudioSamplerate(
        AudioSamplerate|int $audioSamplerate
    ): self {
        $self = clone $this;
        $self['audioSamplerate'] = $audioSamplerate;

        return $self;
    }

    /**
     * Bufsize specifies the video buffer size in bits, from 100000 through 50000000. H.264 and H.265 require maxrate. AV1 and VP9 require a bitrate-controlled mode.
     */
    public function withBufsize(int $bufsize): self
    {
        $self = clone $this;
        $self['bufsize'] = $bufsize;

        return $self;
    }

    /**
     * Channels specifies the output channel count. Defaults to stereo. Six channels means 5.1; eight means 7.1.
     *
     * @param Channels|value-of<Channels> $channels
     */
    public function withChannels(Channels|int $channels): self
    {
        $self = clone $this;
        $self['channels'] = $channels;

        return $self;
    }

    /**
     * CpuUsed specifies the CPU usage level for VP9 encoding. Range: 0 to 8.
     * Lower values mean better quality but slower encoding, higher values mean faster encoding but lower quality.
     * Recommended values: 0-2 for high quality, 2-4 for good quality, 4-6 for balanced, 6-8 for speed.
     *
     * @param CPUUsed|value-of<CPUUsed> $cpuUsed
     */
    public function withCPUUsed(CPUUsed|string $cpuUsed): self
    {
        $self = clone $this;
        $self['cpuUsed'] = $cpuUsed;

        return $self;
    }

    /**
     * Crf (Constant Rate Factor) controls the quality of the output video.
     * Lower values mean better quality but larger file size. Range: 15 to 35.
     * Recommended values: 18-28 for high quality, 23-28 for good quality, 28-35 for acceptable quality.
     */
    public function withCrf(int $crf): self
    {
        $self = clone $this;
        $self['crf'] = $crf;

        return $self;
    }

    /**
     * DisableAudio omits the audio stream. Defaults to false. A source without audio produces video only.
     */
    public function withDisableAudio(bool $disableAudio): self
    {
        $self = clone $this;
        $self['disableAudio'] = $disableAudio;

        return $self;
    }

    /**
     * DisableVideo selects an audio-only AAC M4A export. Defaults to false. The source must contain audio.
     */
    public function withDisableVideo(bool $disableVideo): self
    {
        $self = clone $this;
        $self['disableVideo'] = $disableVideo;

        return $self;
    }

    /**
     * Duration specifies the requested output length in seconds. Defaults to the remaining source duration and is capped at the source end. Audio-only output must resolve to at least 0.001 seconds after trimming and sample rounding. The accepted interval determines the fixed price.
     */
    public function withDuration(float $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * Framerate specifies the output video frame rate. Defaults to the source rate and must be between 0.001 and 240 fps.
     */
    public function withFramerate(float $framerate): self
    {
        $self = clone $this;
        $self['framerate'] = $framerate;

        return $self;
    }

    /**
     * Gop specifies the maximum keyframe interval in frames. Defaults to four seconds at the accepted frame rate, capped at 960 frames.
     */
    public function withGop(int $gop): self
    {
        $self = clone $this;
        $self['gop'] = $gop;

        return $self;
    }

    /**
     * Height specifies the output dimension in pixels. Use -2 or omit one dimension to preserve the source aspect ratio. Explicit dimensions must be 2 to 7680 and even. Omitting both preserves the source dimensions rounded down to even pixels.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Maxrate specifies the video buffer maximum rate in bits per second, from 100000 through 50000000. H.264 and H.265 require bufsize. VP9 requires video_bitrate; AV1 requires CRF mode.
     */
    public function withMaxrate(int $maxrate): self
    {
        $self = clone $this;
        $self['maxrate'] = $maxrate;

        return $self;
    }

    /**
     * Minrate selects VP9 constant bitrate when equal to video_bitrate and maxrate. Other minimum-rate combinations are unsupported.
     */
    public function withMinrate(int $minrate): self
    {
        $self = clone $this;
        $self['minrate'] = $minrate;

        return $self;
    }

    /**
     * PerTitle enables independent content-based bitrate prediction for each part of the video. Analysis uses only the selected trim interval. Defaults to false. Explicit rate-control settings cannot be combined with it.
     */
    public function withPerTitle(bool $perTitle): self
    {
        $self = clone $this;
        $self['perTitle'] = $perTitle;

        return $self;
    }

    /**
     * Pixfmt specifies the output pixel format. Defaults to yuv420p. The selected profile must support it.
     *
     * @param Pixfmt|value-of<Pixfmt> $pixfmt
     */
    public function withPixfmt(Pixfmt|string $pixfmt): self
    {
        $self = clone $this;
        $self['pixfmt'] = $pixfmt;

        return $self;
    }

    /**
     * Quality specifies the VP9 encoding quality preset. Valid values:
     * - good: Balanced quality preset, good for most applications
     * - best: Best quality preset, slower encoding
     * - realtime: Fast encoding preset, suitable for live streaming
     *
     * @param Quality|value-of<Quality> $quality
     */
    public function withQuality(Quality|string $quality): self
    {
        $self = clone $this;
        $self['quality'] = $quality;

        return $self;
    }

    /**
     * Seek specifies the start in source seconds. Defaults to zero and must precede the source end. The accepted interval uses the output frame or sample timeline. Audio-only output must retain at least 0.001 seconds after sample rounding.
     */
    public function withSeek(float $seek): self
    {
        $self = clone $this;
        $self['seek'] = $seek;

        return $self;
    }

    /**
     * VideoBitrate specifies the target video bitrate in bits per second, from 1000 through 100000000. Omit it for CRF or per-title encoding.
     */
    public function withVideoBitrate(int $videoBitrate): self
    {
        $self = clone $this;
        $self['videoBitrate'] = $videoBitrate;

        return $self;
    }

    /**
     * Width specifies the output dimension in pixels. Use -2 or omit one dimension to preserve the source aspect ratio. Explicit dimensions must be 2 to 7680 and even. Omitting both preserves the source dimensions rounded down to even pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
