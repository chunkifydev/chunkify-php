<?php

declare(strict_types=1);

namespace Chunkify\Jobs;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Jobs\HlsH264\Channels;
use Chunkify\Jobs\HlsH264\HlsSegmentType;
use Chunkify\Jobs\HlsH264\Level;
use Chunkify\Jobs\HlsH264\Pixfmt;
use Chunkify\Jobs\HlsH264\Preset;
use Chunkify\Jobs\HlsH264\Profilev;

/**
 * @phpstan-type HlsH264Shape = array{
 *   id: 'hls_h264',
 *   audioBitrate?: int|null,
 *   bufsize?: int|null,
 *   channels?: null|Channels|value-of<Channels>,
 *   crf?: int|null,
 *   disableAudio?: bool|null,
 *   disableVideo?: bool|null,
 *   duration?: int|null,
 *   framerate?: float|null,
 *   gop?: int|null,
 *   height?: int|null,
 *   hlsEnc?: bool|null,
 *   hlsEncIv?: string|null,
 *   hlsEncKey?: string|null,
 *   hlsEncKeyURL?: string|null,
 *   hlsSegmentType?: null|HlsSegmentType|value-of<HlsSegmentType>,
 *   hlsTime?: int|null,
 *   level?: null|Level|value-of<Level>,
 *   maxrate?: int|null,
 *   minrate?: int|null,
 *   movflags?: string|null,
 *   pixfmt?: null|Pixfmt|value-of<Pixfmt>,
 *   preset?: null|Preset|value-of<Preset>,
 *   profilev?: null|Profilev|value-of<Profilev>,
 *   seek?: int|null,
 *   videoBitrate?: int|null,
 *   width?: int|null,
 *   x264Keyint?: int|null,
 * }
 */
final class HlsH264 implements BaseModel
{
    /** @use SdkModel<HlsH264Shape> */
    use SdkModel;

    /** @var 'hls_h264' $id */
    #[Required]
    public string $id = 'hls_h264';

    /**
     * AudioBitrate specifies the audio bitrate in bits per second.
     * Must be between 32Kbps and 512Kbps.
     */
    #[Optional('audio_bitrate')]
    public ?int $audioBitrate;

    /**
     * Bufsize specifies the video buffer size in bits.
     * Must be between 100Kbps and 50Mbps.
     */
    #[Optional]
    public ?int $bufsize;

    /**
     * Channels specifies the number of audio channels.
     * Valid values: 1 (mono), 2 (stereo), 5 (5.1), 7 (7.1).
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
     * DisableAudio indicates whether to disable audio processing.
     */
    #[Optional('disable_audio')]
    public ?bool $disableAudio;

    /**
     * DisableVideo indicates whether to disable video processing.
     */
    #[Optional('disable_video')]
    public ?bool $disableVideo;

    /**
     * Duration specifies the duration to process in seconds.
     * Must be a positive value.
     */
    #[Optional]
    public ?int $duration;

    /**
     * Framerate specifies the output video frame rate.
     * Must be between 15 and 120 fps.
     */
    #[Optional]
    public ?float $framerate;

    /**
     * Gop specifies the Group of Pictures (GOP) size.
     * Must be between 1 and 300.
     */
    #[Optional]
    public ?int $gop;

    /**
     * Height specifies the output video height in pixels.
     * Must be between -2 and 7680. Use -2 for automatic calculation while maintaining aspect ratio.
     */
    #[Optional]
    public ?int $height;

    /**
     * HlsEnc enables encryption for HLS segments when set to true.
     */
    #[Optional('hls_enc')]
    public ?bool $hlsEnc;

    /**
     * HlsEncIv specifies the initialization vector for encryption. Maximum length: 64 characters.
     * Required when HlsEnc is true.
     */
    #[Optional('hls_enc_iv')]
    public ?string $hlsEncIv;

    /**
     * HlsEncKey specifies the encryption key for HLS segments. Maximum length: 64 characters.
     * Required when HlsEnc is true.
     */
    #[Optional('hls_enc_key')]
    public ?string $hlsEncKey;

    /**
     * HlsEncKeyUrl specifies the URL where clients can fetch the encryption key.
     * Required when HlsEnc is true.
     */
    #[Optional('hls_enc_key_url')]
    public ?string $hlsEncKeyURL;

    /**
     * HlsSegmentType specifies the type of HLS segments. Valid values:
     * - mpegts: Traditional MPEG-TS segments, better compatibility
     * - fmp4: Fragmented MP4 segments, better efficiency
     *
     * @var value-of<HlsSegmentType>|null $hlsSegmentType
     */
    #[Optional('hls_segment_type', enum: HlsSegmentType::class)]
    public ?string $hlsSegmentType;

    /**
     * HlsTime specifies the duration of each HLS segment in seconds. Range: 1 to 10.
     * Shorter segments provide faster startup but more overhead, longer segments are more efficient.
     */
    #[Optional('hls_time')]
    public ?int $hlsTime;

    /**
     * Level specifies the H.264 profile level. Valid values: 10-13 (baseline), 20-22 (main), 30-32 (high), 40-42 (high), 50-51 (high).
     * Higher levels support higher resolutions and bitrates but require more processing power.
     *
     * @var value-of<Level>|null $level
     */
    #[Optional(enum: Level::class)]
    public ?int $level;

    /**
     * Maxrate specifies the maximum video bitrate in bits per second.
     * Must be between 100Kbps and 50Mbps.
     */
    #[Optional]
    public ?int $maxrate;

    /**
     * Minrate specifies the minimum video bitrate in bits per second.
     * Must be between 100Kbps and 50Mbps.
     */
    #[Optional]
    public ?int $minrate;

    #[Optional]
    public ?string $movflags;

    /**
     * PixFmt specifies the pixel format.
     * Valid value: yuv420p.
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
     * Seek specifies the timestamp to start processing from (in seconds).
     * Must be a positive value.
     */
    #[Optional]
    public ?int $seek;

    /**
     * VideoBitrate specifies the video bitrate in bits per second.
     * Must be between 100Kbps and 50Mbps.
     */
    #[Optional('video_bitrate')]
    public ?int $videoBitrate;

    /**
     * Width specifies the output video width in pixels.
     * Must be between -2 and 7680. Use -2 for automatic calculation while maintaining aspect ratio.
     */
    #[Optional]
    public ?int $width;

    /**
     * X264KeyInt specifies the maximum number of frames between keyframes for H.264 encoding.
     * Range: 1 to 300. Higher values can improve compression but may affect seeking.
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
     * @param Channels|value-of<Channels>|null $channels
     * @param HlsSegmentType|value-of<HlsSegmentType>|null $hlsSegmentType
     * @param Level|value-of<Level>|null $level
     * @param Pixfmt|value-of<Pixfmt>|null $pixfmt
     * @param Preset|value-of<Preset>|null $preset
     * @param Profilev|value-of<Profilev>|null $profilev
     */
    public static function with(
        ?int $audioBitrate = null,
        ?int $bufsize = null,
        Channels|int|null $channels = null,
        ?int $crf = null,
        ?bool $disableAudio = null,
        ?bool $disableVideo = null,
        ?int $duration = null,
        ?float $framerate = null,
        ?int $gop = null,
        ?int $height = null,
        ?bool $hlsEnc = null,
        ?string $hlsEncIv = null,
        ?string $hlsEncKey = null,
        ?string $hlsEncKeyURL = null,
        HlsSegmentType|string|null $hlsSegmentType = null,
        ?int $hlsTime = null,
        Level|int|null $level = null,
        ?int $maxrate = null,
        ?int $minrate = null,
        ?string $movflags = null,
        Pixfmt|string|null $pixfmt = null,
        Preset|string|null $preset = null,
        Profilev|string|null $profilev = null,
        ?int $seek = null,
        ?int $videoBitrate = null,
        ?int $width = null,
        ?int $x264Keyint = null,
    ): self {
        $self = new self;

        null !== $audioBitrate && $self['audioBitrate'] = $audioBitrate;
        null !== $bufsize && $self['bufsize'] = $bufsize;
        null !== $channels && $self['channels'] = $channels;
        null !== $crf && $self['crf'] = $crf;
        null !== $disableAudio && $self['disableAudio'] = $disableAudio;
        null !== $disableVideo && $self['disableVideo'] = $disableVideo;
        null !== $duration && $self['duration'] = $duration;
        null !== $framerate && $self['framerate'] = $framerate;
        null !== $gop && $self['gop'] = $gop;
        null !== $height && $self['height'] = $height;
        null !== $hlsEnc && $self['hlsEnc'] = $hlsEnc;
        null !== $hlsEncIv && $self['hlsEncIv'] = $hlsEncIv;
        null !== $hlsEncKey && $self['hlsEncKey'] = $hlsEncKey;
        null !== $hlsEncKeyURL && $self['hlsEncKeyURL'] = $hlsEncKeyURL;
        null !== $hlsSegmentType && $self['hlsSegmentType'] = $hlsSegmentType;
        null !== $hlsTime && $self['hlsTime'] = $hlsTime;
        null !== $level && $self['level'] = $level;
        null !== $maxrate && $self['maxrate'] = $maxrate;
        null !== $minrate && $self['minrate'] = $minrate;
        null !== $movflags && $self['movflags'] = $movflags;
        null !== $pixfmt && $self['pixfmt'] = $pixfmt;
        null !== $preset && $self['preset'] = $preset;
        null !== $profilev && $self['profilev'] = $profilev;
        null !== $seek && $self['seek'] = $seek;
        null !== $videoBitrate && $self['videoBitrate'] = $videoBitrate;
        null !== $width && $self['width'] = $width;
        null !== $x264Keyint && $self['x264Keyint'] = $x264Keyint;

        return $self;
    }

    /**
     * @param 'hls_h264' $id
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * AudioBitrate specifies the audio bitrate in bits per second.
     * Must be between 32Kbps and 512Kbps.
     */
    public function withAudioBitrate(int $audioBitrate): self
    {
        $self = clone $this;
        $self['audioBitrate'] = $audioBitrate;

        return $self;
    }

    /**
     * Bufsize specifies the video buffer size in bits.
     * Must be between 100Kbps and 50Mbps.
     */
    public function withBufsize(int $bufsize): self
    {
        $self = clone $this;
        $self['bufsize'] = $bufsize;

        return $self;
    }

    /**
     * Channels specifies the number of audio channels.
     * Valid values: 1 (mono), 2 (stereo), 5 (5.1), 7 (7.1).
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
     * DisableAudio indicates whether to disable audio processing.
     */
    public function withDisableAudio(bool $disableAudio): self
    {
        $self = clone $this;
        $self['disableAudio'] = $disableAudio;

        return $self;
    }

    /**
     * DisableVideo indicates whether to disable video processing.
     */
    public function withDisableVideo(bool $disableVideo): self
    {
        $self = clone $this;
        $self['disableVideo'] = $disableVideo;

        return $self;
    }

    /**
     * Duration specifies the duration to process in seconds.
     * Must be a positive value.
     */
    public function withDuration(int $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * Framerate specifies the output video frame rate.
     * Must be between 15 and 120 fps.
     */
    public function withFramerate(float $framerate): self
    {
        $self = clone $this;
        $self['framerate'] = $framerate;

        return $self;
    }

    /**
     * Gop specifies the Group of Pictures (GOP) size.
     * Must be between 1 and 300.
     */
    public function withGop(int $gop): self
    {
        $self = clone $this;
        $self['gop'] = $gop;

        return $self;
    }

    /**
     * Height specifies the output video height in pixels.
     * Must be between -2 and 7680. Use -2 for automatic calculation while maintaining aspect ratio.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * HlsEnc enables encryption for HLS segments when set to true.
     */
    public function withHlsEnc(bool $hlsEnc): self
    {
        $self = clone $this;
        $self['hlsEnc'] = $hlsEnc;

        return $self;
    }

    /**
     * HlsEncIv specifies the initialization vector for encryption. Maximum length: 64 characters.
     * Required when HlsEnc is true.
     */
    public function withHlsEncIv(string $hlsEncIv): self
    {
        $self = clone $this;
        $self['hlsEncIv'] = $hlsEncIv;

        return $self;
    }

    /**
     * HlsEncKey specifies the encryption key for HLS segments. Maximum length: 64 characters.
     * Required when HlsEnc is true.
     */
    public function withHlsEncKey(string $hlsEncKey): self
    {
        $self = clone $this;
        $self['hlsEncKey'] = $hlsEncKey;

        return $self;
    }

    /**
     * HlsEncKeyUrl specifies the URL where clients can fetch the encryption key.
     * Required when HlsEnc is true.
     */
    public function withHlsEncKeyURL(string $hlsEncKeyURL): self
    {
        $self = clone $this;
        $self['hlsEncKeyURL'] = $hlsEncKeyURL;

        return $self;
    }

    /**
     * HlsSegmentType specifies the type of HLS segments. Valid values:
     * - mpegts: Traditional MPEG-TS segments, better compatibility
     * - fmp4: Fragmented MP4 segments, better efficiency
     *
     * @param HlsSegmentType|value-of<HlsSegmentType> $hlsSegmentType
     */
    public function withHlsSegmentType(
        HlsSegmentType|string $hlsSegmentType
    ): self {
        $self = clone $this;
        $self['hlsSegmentType'] = $hlsSegmentType;

        return $self;
    }

    /**
     * HlsTime specifies the duration of each HLS segment in seconds. Range: 1 to 10.
     * Shorter segments provide faster startup but more overhead, longer segments are more efficient.
     */
    public function withHlsTime(int $hlsTime): self
    {
        $self = clone $this;
        $self['hlsTime'] = $hlsTime;

        return $self;
    }

    /**
     * Level specifies the H.264 profile level. Valid values: 10-13 (baseline), 20-22 (main), 30-32 (high), 40-42 (high), 50-51 (high).
     * Higher levels support higher resolutions and bitrates but require more processing power.
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
     * Maxrate specifies the maximum video bitrate in bits per second.
     * Must be between 100Kbps and 50Mbps.
     */
    public function withMaxrate(int $maxrate): self
    {
        $self = clone $this;
        $self['maxrate'] = $maxrate;

        return $self;
    }

    /**
     * Minrate specifies the minimum video bitrate in bits per second.
     * Must be between 100Kbps and 50Mbps.
     */
    public function withMinrate(int $minrate): self
    {
        $self = clone $this;
        $self['minrate'] = $minrate;

        return $self;
    }

    public function withMovflags(string $movflags): self
    {
        $self = clone $this;
        $self['movflags'] = $movflags;

        return $self;
    }

    /**
     * PixFmt specifies the pixel format.
     * Valid value: yuv420p.
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
     * Seek specifies the timestamp to start processing from (in seconds).
     * Must be a positive value.
     */
    public function withSeek(int $seek): self
    {
        $self = clone $this;
        $self['seek'] = $seek;

        return $self;
    }

    /**
     * VideoBitrate specifies the video bitrate in bits per second.
     * Must be between 100Kbps and 50Mbps.
     */
    public function withVideoBitrate(int $videoBitrate): self
    {
        $self = clone $this;
        $self['videoBitrate'] = $videoBitrate;

        return $self;
    }

    /**
     * Width specifies the output video width in pixels.
     * Must be between -2 and 7680. Use -2 for automatic calculation while maintaining aspect ratio.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }

    /**
     * X264KeyInt specifies the maximum number of frames between keyframes for H.264 encoding.
     * Range: 1 to 300. Higher values can improve compression but may affect seeking.
     */
    public function withX264Keyint(int $x264Keyint): self
    {
        $self = clone $this;
        $self['x264Keyint'] = $x264Keyint;

        return $self;
    }
}
