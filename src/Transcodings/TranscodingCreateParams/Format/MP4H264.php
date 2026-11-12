<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingCreateParams\Format;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H264\AudioSamplerate;
use Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H264\Channels;
use Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H264\Level;
use Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H264\Movflags;
use Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H264\Pixfmt;
use Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H264\Preset;
use Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H264\Profilev;

/**
 * @phpstan-type MP4H264Shape = array{
 *   id: 'mp4_h264',
 *   audioBitrate?: int|null,
 *   audioSamplerate?: null|AudioSamplerate|value-of<AudioSamplerate>,
 *   channels?: null|Channels|value-of<Channels>,
 *   crf?: int|null,
 *   duration?: float|null,
 *   level?: null|Level|value-of<Level>,
 *   movflags?: null|Movflags|value-of<Movflags>,
 *   pixfmt?: null|Pixfmt|value-of<Pixfmt>,
 *   preset?: null|Preset|value-of<Preset>,
 *   profilev?: null|Profilev|value-of<Profilev>,
 *   seek?: float|null,
 *   x264Keyint?: int|null,
 * }
 */
final class MP4H264 implements BaseModel
{
    /** @use SdkModel<MP4H264Shape> */
    use SdkModel;

    /**
     * Id specifies the output format.
     *
     * @var 'mp4_h264' $id
     */
    #[Required]
    public string $id = 'mp4_h264';

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
     * Channels specifies the output channel count. Defaults to stereo. Six channels means 5.1; eight means 7.1.
     *
     * @var value-of<Channels>|null $channels
     */
    #[Optional(enum: Channels::class)]
    public ?int $channels;

    /**
     * Crf (Constant Rate Factor) controls the quality of the output video.
     * Lower values mean better quality but larger file size. Range: 16 to 35.
     * Recommended values: 18-28 for high quality, 23-28 for good quality, 28-35 for acceptable quality.
     */
    #[Optional]
    public ?int $crf;

    /**
     * Duration specifies the requested output length in seconds. Defaults to the remaining source duration and is capped at the source end. Audio-only output must resolve to at least 0.001 seconds after trimming and sample rounding. The accepted interval determines the fixed price.
     */
    #[Optional]
    public ?float $duration;

    /**
     * Level specifies the H.264 decoder level using its two-digit representation, such as 41 for level 4.1. The dimensions, frame rate and rate controls must fit this level and the effective profile. Omitted rate limits resolve to level-compatible defaults.
     *
     * @var value-of<Level>|null $level
     */
    #[Optional(enum: Level::class)]
    public ?int $level;

    /**
     * Movflags specifies MP4 packaging. Defaults to faststart, which places playback metadata before the media.
     *
     * @var value-of<Movflags>|null $movflags
     */
    #[Optional(enum: Movflags::class)]
    public ?string $movflags;

    /**
     * Pixfmt specifies the output pixel format. Defaults to yuv420p. The selected profile must support it.
     *
     * @var value-of<Pixfmt>|null $pixfmt
     */
    #[Optional(enum: Pixfmt::class)]
    public ?string $pixfmt;

    /**
     * Preset specifies the encoding speed preset. Valid values (from fastest to slowest):
     * - ultrafast: Fastest encoding, lowest quality
     * - superfast: Very fast encoding, lower quality
     * - veryfast: Fast encoding, moderate quality
     * - faster: Faster encoding, good quality
     * - fast: Fast encoding, better quality
     * - medium: Balanced preset, best quality
     *
     * @var value-of<Preset>|null $preset
     */
    #[Optional(enum: Preset::class)]
    public ?string $preset;

    /**
     * Profilev specifies the H.264 profile. Valid values:
     * - baseline: Basic profile, good for mobile devices
     * - main: Main profile, good for most applications
     * - high: High profile, best quality but requires more processing
     * - high10: High 10-bit profile, supports 10-bit color
     * - high422: High 4:2:2 profile, supports 4:2:2 color sampling
     * - high444: High 4:4:4 profile, supports 4:4:4 color sampling
     *
     * @var value-of<Profilev>|null $profilev
     */
    #[Optional(enum: Profilev::class)]
    public ?string $profilev;

    /**
     * Seek specifies the start in source seconds. Defaults to zero and must precede the source end. The accepted interval uses the output frame or sample timeline. Audio-only output must retain at least 0.001 seconds after sample rounding.
     */
    #[Optional]
    public ?float $seek;

    /**
     * X264KeyInt specifies the maximum number of frames between keyframes for H.264 encoding.
     * Range: 1 to 960. Higher values can improve compression but may affect seeking.
     */
    #[Optional('x264_keyint')]
    public ?int $x264Keyint;

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
     * @param Level|value-of<Level>|null $level
     * @param Movflags|value-of<Movflags>|null $movflags
     * @param Pixfmt|value-of<Pixfmt>|null $pixfmt
     * @param Preset|value-of<Preset>|null $preset
     * @param Profilev|value-of<Profilev>|null $profilev
     */
    public static function with(
        ?int $audioBitrate = null,
        AudioSamplerate|int|null $audioSamplerate = null,
        Channels|int|null $channels = null,
        ?int $crf = null,
        ?float $duration = null,
        Level|int|null $level = null,
        Movflags|string|null $movflags = null,
        Pixfmt|string|null $pixfmt = null,
        Preset|string|null $preset = null,
        Profilev|string|null $profilev = null,
        ?float $seek = null,
        ?int $x264Keyint = null,
    ): self {
        $self = new self;

        null !== $audioBitrate && $self['audioBitrate'] = $audioBitrate;
        null !== $audioSamplerate && $self['audioSamplerate'] = $audioSamplerate;
        null !== $channels && $self['channels'] = $channels;
        null !== $crf && $self['crf'] = $crf;
        null !== $duration && $self['duration'] = $duration;
        null !== $level && $self['level'] = $level;
        null !== $movflags && $self['movflags'] = $movflags;
        null !== $pixfmt && $self['pixfmt'] = $pixfmt;
        null !== $preset && $self['preset'] = $preset;
        null !== $profilev && $self['profilev'] = $profilev;
        null !== $seek && $self['seek'] = $seek;
        null !== $x264Keyint && $self['x264Keyint'] = $x264Keyint;

        return $self;
    }

    /**
     * Id specifies the output format.
     *
     * @param 'mp4_h264' $id
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
     * Crf (Constant Rate Factor) controls the quality of the output video.
     * Lower values mean better quality but larger file size. Range: 16 to 35.
     * Recommended values: 18-28 for high quality, 23-28 for good quality, 28-35 for acceptable quality.
     */
    public function withCrf(int $crf): self
    {
        $self = clone $this;
        $self['crf'] = $crf;

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
     * Level specifies the H.264 decoder level using its two-digit representation, such as 41 for level 4.1. The dimensions, frame rate and rate controls must fit this level and the effective profile. Omitted rate limits resolve to level-compatible defaults.
     *
     * @param Level|value-of<Level> $level
     */
    public function withLevel(Level|int $level): self
    {
        $self = clone $this;
        $self['level'] = $level;

        return $self;
    }

    /**
     * Movflags specifies MP4 packaging. Defaults to faststart, which places playback metadata before the media.
     *
     * @param Movflags|value-of<Movflags> $movflags
     */
    public function withMovflags(Movflags|string $movflags): self
    {
        $self = clone $this;
        $self['movflags'] = $movflags;

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
     * Preset specifies the encoding speed preset. Valid values (from fastest to slowest):
     * - ultrafast: Fastest encoding, lowest quality
     * - superfast: Very fast encoding, lower quality
     * - veryfast: Fast encoding, moderate quality
     * - faster: Faster encoding, good quality
     * - fast: Fast encoding, better quality
     * - medium: Balanced preset, best quality
     *
     * @param Preset|value-of<Preset> $preset
     */
    public function withPreset(Preset|string $preset): self
    {
        $self = clone $this;
        $self['preset'] = $preset;

        return $self;
    }

    /**
     * Profilev specifies the H.264 profile. Valid values:
     * - baseline: Basic profile, good for mobile devices
     * - main: Main profile, good for most applications
     * - high: High profile, best quality but requires more processing
     * - high10: High 10-bit profile, supports 10-bit color
     * - high422: High 4:2:2 profile, supports 4:2:2 color sampling
     * - high444: High 4:4:4 profile, supports 4:4:4 color sampling
     *
     * @param Profilev|value-of<Profilev> $profilev
     */
    public function withProfilev(Profilev|string $profilev): self
    {
        $self = clone $this;
        $self['profilev'] = $profilev;

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
     * X264KeyInt specifies the maximum number of frames between keyframes for H.264 encoding.
     * Range: 1 to 960. Higher values can improve compression but may affect seeking.
     */
    public function withX264Keyint(int $x264Keyint): self
    {
        $self = clone $this;
        $self['x264Keyint'] = $x264Keyint;

        return $self;
    }
}
