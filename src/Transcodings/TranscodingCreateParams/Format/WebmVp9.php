<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingCreateParams\Format;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Transcodings\TranscodingCreateParams\Format\WebmVp9\AudioSamplerate;
use Chunkify\Transcodings\TranscodingCreateParams\Format\WebmVp9\Channels;
use Chunkify\Transcodings\TranscodingCreateParams\Format\WebmVp9\CPUUsed;
use Chunkify\Transcodings\TranscodingCreateParams\Format\WebmVp9\Pixfmt;
use Chunkify\Transcodings\TranscodingCreateParams\Format\WebmVp9\Quality;

/**
 * @phpstan-type WebmVp9Shape = array{
 *   id: 'webm_vp9',
 *   audioBitrate?: int|null,
 *   audioSamplerate?: null|AudioSamplerate|value-of<AudioSamplerate>,
 *   channels?: null|Channels|value-of<Channels>,
 *   cpuUsed?: null|CPUUsed|value-of<CPUUsed>,
 *   crf?: int|null,
 *   duration?: float|null,
 *   minrate?: int|null,
 *   pixfmt?: null|Pixfmt|value-of<Pixfmt>,
 *   quality?: null|Quality|value-of<Quality>,
 *   seek?: float|null,
 * }
 */
final class WebmVp9 implements BaseModel
{
    /** @use SdkModel<WebmVp9Shape> */
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
     * Duration specifies the requested output length in seconds. Defaults to the remaining source duration and is capped at the source end. Audio-only output must resolve to at least 0.001 seconds after trimming and sample rounding. The accepted interval determines the fixed price.
     */
    #[Optional]
    public ?float $duration;

    /**
     * Minrate selects VP9 constant bitrate when equal to video_bitrate and maxrate. Other minimum-rate combinations are unsupported.
     */
    #[Optional]
    public ?int $minrate;

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
        Channels|int|null $channels = null,
        CPUUsed|string|null $cpuUsed = null,
        ?int $crf = null,
        ?float $duration = null,
        ?int $minrate = null,
        Pixfmt|string|null $pixfmt = null,
        Quality|string|null $quality = null,
        ?float $seek = null,
    ): self {
        $self = new self;

        null !== $audioBitrate && $self['audioBitrate'] = $audioBitrate;
        null !== $audioSamplerate && $self['audioSamplerate'] = $audioSamplerate;
        null !== $channels && $self['channels'] = $channels;
        null !== $cpuUsed && $self['cpuUsed'] = $cpuUsed;
        null !== $crf && $self['crf'] = $crf;
        null !== $duration && $self['duration'] = $duration;
        null !== $minrate && $self['minrate'] = $minrate;
        null !== $pixfmt && $self['pixfmt'] = $pixfmt;
        null !== $quality && $self['quality'] = $quality;
        null !== $seek && $self['seek'] = $seek;

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
     * Duration specifies the requested output length in seconds. Defaults to the remaining source duration and is capped at the source end. Audio-only output must resolve to at least 0.001 seconds after trimming and sample rounding. The accepted interval determines the fixed price.
     */
    public function withDuration(float $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

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
}
