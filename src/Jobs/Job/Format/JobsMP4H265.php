<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Job\Format;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Jobs\MP4H265\Channels;
use Chunkify\Jobs\MP4H265\Level;
use Chunkify\Jobs\MP4H265\Pixfmt;
use Chunkify\Jobs\MP4H265\Preset;
use Chunkify\Jobs\MP4H265\Profilev;

/**
 * FFmpeg encoding parameters specific to MP4 with H.265 encoding.
 *
 * @phpstan-type JobsMP4H265Shape = array{
 *   id: 'mp4_h265',
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
 *   level?: null|Level|value-of<Level>,
 *   maxrate?: int|null,
 *   minrate?: int|null,
 *   movflags?: string|null,
 *   perTitle?: bool|null,
 *   pixfmt?: null|Pixfmt|value-of<Pixfmt>,
 *   preset?: null|Preset|value-of<Preset>,
 *   profilev?: null|Profilev|value-of<Profilev>,
 *   seek?: int|null,
 *   videoBitrate?: int|null,
 *   width?: int|null,
 *   x265Keyint?: int|null,
 * }
 */
final class JobsMP4H265 implements BaseModel
{
    /** @use SdkModel<JobsMP4H265Shape> */
    use SdkModel;

    /** @var 'mp4_h265' $id */
    #[Required]
    public string $id = 'mp4_h265';

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
     * Level specifies the H.265 profile level. Valid values: 30-31 (main), 41 (main10).
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
     * Enables per-title optimization. Disabled by default. Set it to true to let Chunkify select rate control automatically. When enabled, explicit rate-control fields cannot be provided. For HLS outputs, either audio_bitrate or video_bitrate is required when per-title optimization is disabled or omitted.
     */
    #[Optional('per_title')]
    public ?bool $perTitle;

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
     * Profilev specifies the H.265 profile. Valid values:
     * - main: Main profile, good for most applications
     * - main10: Main 10-bit profile, supports 10-bit color
     * - mainstillpicture: Still picture profile, optimized for single images
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
     * X265KeyInt specifies the maximum number of frames between keyframes for H.265 encoding.
     * Range: 1 to 300. Higher values can improve compression but may affect seeking.
     */
    #[Optional('x265_keyint')]
    public ?int $x265Keyint;

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
        Level|int|null $level = null,
        ?int $maxrate = null,
        ?int $minrate = null,
        ?string $movflags = null,
        ?bool $perTitle = null,
        Pixfmt|string|null $pixfmt = null,
        Preset|string|null $preset = null,
        Profilev|string|null $profilev = null,
        ?int $seek = null,
        ?int $videoBitrate = null,
        ?int $width = null,
        ?int $x265Keyint = null,
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
        null !== $level && $self['level'] = $level;
        null !== $maxrate && $self['maxrate'] = $maxrate;
        null !== $minrate && $self['minrate'] = $minrate;
        null !== $movflags && $self['movflags'] = $movflags;
        null !== $perTitle && $self['perTitle'] = $perTitle;
        null !== $pixfmt && $self['pixfmt'] = $pixfmt;
        null !== $preset && $self['preset'] = $preset;
        null !== $profilev && $self['profilev'] = $profilev;
        null !== $seek && $self['seek'] = $seek;
        null !== $videoBitrate && $self['videoBitrate'] = $videoBitrate;
        null !== $width && $self['width'] = $width;
        null !== $x265Keyint && $self['x265Keyint'] = $x265Keyint;

        return $self;
    }

    /**
     * @param 'mp4_h265' $id
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
     * Level specifies the H.265 profile level. Valid values: 30-31 (main), 41 (main10).
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
     * Enables per-title optimization. Disabled by default. Set it to true to let Chunkify select rate control automatically. When enabled, explicit rate-control fields cannot be provided. For HLS outputs, either audio_bitrate or video_bitrate is required when per-title optimization is disabled or omitted.
     */
    public function withPerTitle(bool $perTitle): self
    {
        $self = clone $this;
        $self['perTitle'] = $perTitle;

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
     * Profilev specifies the H.265 profile. Valid values:
     * - main: Main profile, good for most applications
     * - main10: Main 10-bit profile, supports 10-bit color
     * - mainstillpicture: Still picture profile, optimized for single images
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
     * X265KeyInt specifies the maximum number of frames between keyframes for H.265 encoding.
     * Range: 1 to 300. Higher values can improve compression but may affect seeking.
     */
    public function withX265Keyint(int $x265Keyint): self
    {
        $self = clone $this;
        $self['x265Keyint'] = $x265Keyint;

        return $self;
    }
}
