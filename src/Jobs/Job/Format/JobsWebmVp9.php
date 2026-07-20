<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Job\Format;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Jobs\WebmVp9\Channels;
use Chunkify\Jobs\WebmVp9\CPUUsed;
use Chunkify\Jobs\WebmVp9\Pixfmt;
use Chunkify\Jobs\WebmVp9\Quality;

/**
 * FFmpeg encoding parameters specific to WebM with VP9 encoding.
 *
 * @phpstan-type JobsWebmVp9Shape = array{
 *   id: 'webm_vp9',
 *   audioBitrate?: int|null,
 *   bufsize?: int|null,
 *   channels?: null|Channels|value-of<Channels>,
 *   cpuUsed?: null|CPUUsed|value-of<CPUUsed>,
 *   crf?: int|null,
 *   disableAudio?: bool|null,
 *   disableVideo?: bool|null,
 *   duration?: int|null,
 *   framerate?: float|null,
 *   gop?: int|null,
 *   height?: int|null,
 *   maxrate?: int|null,
 *   minrate?: int|null,
 *   pixfmt?: null|Pixfmt|value-of<Pixfmt>,
 *   quality?: null|Quality|value-of<Quality>,
 *   seek?: int|null,
 *   videoBitrate?: int|null,
 *   width?: int|null,
 * }
 */
final class JobsWebmVp9 implements BaseModel
{
    /** @use SdkModel<JobsWebmVp9Shape> */
    use SdkModel;

    /** @var 'webm_vp9' $id */
    #[Required]
    public string $id = 'webm_vp9';

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

    /**
     * PixFmt specifies the pixel format.
     * Valid value: yuv420p.
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
     * @param CPUUsed|value-of<CPUUsed>|null $cpuUsed
     * @param Pixfmt|value-of<Pixfmt>|null $pixfmt
     * @param Quality|value-of<Quality>|null $quality
     */
    public static function with(
        ?int $audioBitrate = null,
        ?int $bufsize = null,
        Channels|int|null $channels = null,
        CPUUsed|string|null $cpuUsed = null,
        ?int $crf = null,
        ?bool $disableAudio = null,
        ?bool $disableVideo = null,
        ?int $duration = null,
        ?float $framerate = null,
        ?int $gop = null,
        ?int $height = null,
        ?int $maxrate = null,
        ?int $minrate = null,
        Pixfmt|string|null $pixfmt = null,
        Quality|string|null $quality = null,
        ?int $seek = null,
        ?int $videoBitrate = null,
        ?int $width = null,
    ): self {
        $self = new self;

        null !== $audioBitrate && $self['audioBitrate'] = $audioBitrate;
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
        null !== $pixfmt && $self['pixfmt'] = $pixfmt;
        null !== $quality && $self['quality'] = $quality;
        null !== $seek && $self['seek'] = $seek;
        null !== $videoBitrate && $self['videoBitrate'] = $videoBitrate;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * @param 'webm_vp9' $id
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
}
