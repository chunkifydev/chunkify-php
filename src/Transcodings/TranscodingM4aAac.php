<?php

declare(strict_types=1);

namespace Chunkify\Transcodings;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Transcodings\TranscodingM4aAac\AudioSamplerate;
use Chunkify\Transcodings\TranscodingM4aAac\Channels;

/**
 * @phpstan-type TranscodingM4aAacShape = array{
 *   id: 'm4a_aac',
 *   audioBitrate?: int|null,
 *   audioSamplerate?: null|AudioSamplerate|value-of<AudioSamplerate>,
 *   channels?: null|Channels|value-of<Channels>,
 *   duration?: float|null,
 *   seek?: float|null,
 * }
 */
final class TranscodingM4aAac implements BaseModel
{
    /** @use SdkModel<TranscodingM4aAacShape> */
    use SdkModel;

    /**
     * Id specifies an AAC M4A export.
     *
     * @var 'm4a_aac' $id
     */
    #[Required]
    public string $id = 'm4a_aac';

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
     * Duration specifies the requested output length in seconds. Defaults to the remaining source duration and is capped at the source end. Audio-only output must resolve to at least 0.001 seconds after trimming and sample rounding. The accepted interval determines the fixed price.
     */
    #[Optional]
    public ?float $duration;

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
     */
    public static function with(
        ?int $audioBitrate = null,
        AudioSamplerate|int|null $audioSamplerate = null,
        Channels|int|null $channels = null,
        ?float $duration = null,
        ?float $seek = null,
    ): self {
        $self = new self;

        null !== $audioBitrate && $self['audioBitrate'] = $audioBitrate;
        null !== $audioSamplerate && $self['audioSamplerate'] = $audioSamplerate;
        null !== $channels && $self['channels'] = $channels;
        null !== $duration && $self['duration'] = $duration;
        null !== $seek && $self['seek'] = $seek;

        return $self;
    }

    /**
     * Id specifies an AAC M4A export.
     *
     * @param 'm4a_aac' $id
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
     * Duration specifies the requested output length in seconds. Defaults to the remaining source duration and is capped at the source end. Audio-only output must resolve to at least 0.001 seconds after trimming and sample rounding. The accepted interval determines the fixed price.
     */
    public function withDuration(float $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

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
