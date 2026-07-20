<?php

declare(strict_types=1);

namespace Chunkify\Sources;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type SourceShape = array{
 *   id: string,
 *   audioBitrate: int,
 *   audioCodec: string,
 *   createdAt: \DateTimeInterface,
 *   device: string,
 *   duration: int,
 *   height: int,
 *   metadata: array<string,string>,
 *   size: int,
 *   url: string,
 *   videoBitrate: int,
 *   videoCodec: string,
 *   videoFramerate: float,
 *   width: int,
 * }
 */
final class Source implements BaseModel
{
    /** @use SdkModel<SourceShape> */
    use SdkModel;

    /**
     * Unique identifier of the source.
     */
    #[Required]
    public string $id;

    /**
     * Audio bitrate in bits per second.
     */
    #[Required('audio_bitrate')]
    public int $audioBitrate;

    /**
     * Audio codec used.
     */
    #[Required('audio_codec')]
    public string $audioCodec;

    /**
     * Timestamp when the source was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Device used to record the video.
     */
    #[Required]
    public string $device;

    /**
     * Duration of the video in seconds.
     */
    #[Required]
    public int $duration;

    /**
     * Height of the video in pixels.
     */
    #[Required]
    public int $height;

    /**
     * Additional metadata for the source.
     *
     * @var array<string,string> $metadata
     */
    #[Required(map: 'string')]
    public array $metadata;

    /**
     * Size of the source file in bytes.
     */
    #[Required]
    public int $size;

    /**
     * URL where the source video can be accessed.
     */
    #[Required]
    public string $url;

    /**
     * Video bitrate in bits per second.
     */
    #[Required('video_bitrate')]
    public int $videoBitrate;

    /**
     * Video codec used.
     */
    #[Required('video_codec')]
    public string $videoCodec;

    /**
     * Video framerate in frames per second.
     */
    #[Required('video_framerate')]
    public float $videoFramerate;

    /**
     * Width of the video in pixels.
     */
    #[Required]
    public int $width;

    /**
     * `new Source()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Source::with(
     *   id: ...,
     *   audioBitrate: ...,
     *   audioCodec: ...,
     *   createdAt: ...,
     *   device: ...,
     *   duration: ...,
     *   height: ...,
     *   metadata: ...,
     *   size: ...,
     *   url: ...,
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
     * (new Source)
     *   ->withID(...)
     *   ->withAudioBitrate(...)
     *   ->withAudioCodec(...)
     *   ->withCreatedAt(...)
     *   ->withDevice(...)
     *   ->withDuration(...)
     *   ->withHeight(...)
     *   ->withMetadata(...)
     *   ->withSize(...)
     *   ->withURL(...)
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
     *
     * @param array<string,string> $metadata
     */
    public static function with(
        string $id,
        int $audioBitrate,
        string $audioCodec,
        \DateTimeInterface $createdAt,
        string $device,
        int $duration,
        int $height,
        array $metadata,
        int $size,
        string $url,
        int $videoBitrate,
        string $videoCodec,
        float $videoFramerate,
        int $width,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['audioBitrate'] = $audioBitrate;
        $self['audioCodec'] = $audioCodec;
        $self['createdAt'] = $createdAt;
        $self['device'] = $device;
        $self['duration'] = $duration;
        $self['height'] = $height;
        $self['metadata'] = $metadata;
        $self['size'] = $size;
        $self['url'] = $url;
        $self['videoBitrate'] = $videoBitrate;
        $self['videoCodec'] = $videoCodec;
        $self['videoFramerate'] = $videoFramerate;
        $self['width'] = $width;

        return $self;
    }

    /**
     * Unique identifier of the source.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Audio bitrate in bits per second.
     */
    public function withAudioBitrate(int $audioBitrate): self
    {
        $self = clone $this;
        $self['audioBitrate'] = $audioBitrate;

        return $self;
    }

    /**
     * Audio codec used.
     */
    public function withAudioCodec(string $audioCodec): self
    {
        $self = clone $this;
        $self['audioCodec'] = $audioCodec;

        return $self;
    }

    /**
     * Timestamp when the source was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Device used to record the video.
     */
    public function withDevice(string $device): self
    {
        $self = clone $this;
        $self['device'] = $device;

        return $self;
    }

    /**
     * Duration of the video in seconds.
     */
    public function withDuration(int $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * Height of the video in pixels.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Additional metadata for the source.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Size of the source file in bytes.
     */
    public function withSize(int $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * URL where the source video can be accessed.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Video bitrate in bits per second.
     */
    public function withVideoBitrate(int $videoBitrate): self
    {
        $self = clone $this;
        $self['videoBitrate'] = $videoBitrate;

        return $self;
    }

    /**
     * Video codec used.
     */
    public function withVideoCodec(string $videoCodec): self
    {
        $self = clone $this;
        $self['videoCodec'] = $videoCodec;

        return $self;
    }

    /**
     * Video framerate in frames per second.
     */
    public function withVideoFramerate(float $videoFramerate): self
    {
        $self = clone $this;
        $self['videoFramerate'] = $videoFramerate;

        return $self;
    }

    /**
     * Width of the video in pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
