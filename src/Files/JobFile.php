<?php

declare(strict_types=1);

namespace Chunkify\Files;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type JobFileShape = array{
 *   id: string,
 *   audioBitrate: int,
 *   audioCodec: string,
 *   createdAt: \DateTimeInterface,
 *   duration: int,
 *   height: int,
 *   jobID: string,
 *   mimeType: string,
 *   path: string,
 *   size: int,
 *   storageID: string,
 *   url: string,
 *   videoBitrate: int,
 *   videoCodec: string,
 *   videoFramerate: float,
 *   width: int,
 * }
 */
final class JobFile implements BaseModel
{
    /** @use SdkModel<JobFileShape> */
    use SdkModel;

    /**
     * Unique identifier of the file.
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
     * Timestamp when the file was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

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
     * ID of the job that created this file.
     */
    #[Required('job_id')]
    public string $jobID;

    /**
     * MIME type of the file.
     */
    #[Required('mime_type')]
    public string $mimeType;

    /**
     * Path to the file in storage.
     */
    #[Required]
    public string $path;

    /**
     * Size of the file in bytes.
     */
    #[Required]
    public int $size;

    /**
     * StorageId identifier where the file is stored.
     */
    #[Required('storage_id')]
    public string $storageID;

    /**
     * Pre-signed URL to directly access the file (only included when available).
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
     * `new JobFile()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JobFile::with(
     *   id: ...,
     *   audioBitrate: ...,
     *   audioCodec: ...,
     *   createdAt: ...,
     *   duration: ...,
     *   height: ...,
     *   jobID: ...,
     *   mimeType: ...,
     *   path: ...,
     *   size: ...,
     *   storageID: ...,
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
     * (new JobFile)
     *   ->withID(...)
     *   ->withAudioBitrate(...)
     *   ->withAudioCodec(...)
     *   ->withCreatedAt(...)
     *   ->withDuration(...)
     *   ->withHeight(...)
     *   ->withJobID(...)
     *   ->withMimeType(...)
     *   ->withPath(...)
     *   ->withSize(...)
     *   ->withStorageID(...)
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
     */
    public static function with(
        string $id,
        int $audioBitrate,
        string $audioCodec,
        \DateTimeInterface $createdAt,
        int $duration,
        int $height,
        string $jobID,
        string $mimeType,
        string $path,
        int $size,
        string $storageID,
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
        $self['duration'] = $duration;
        $self['height'] = $height;
        $self['jobID'] = $jobID;
        $self['mimeType'] = $mimeType;
        $self['path'] = $path;
        $self['size'] = $size;
        $self['storageID'] = $storageID;
        $self['url'] = $url;
        $self['videoBitrate'] = $videoBitrate;
        $self['videoCodec'] = $videoCodec;
        $self['videoFramerate'] = $videoFramerate;
        $self['width'] = $width;

        return $self;
    }

    /**
     * Unique identifier of the file.
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
     * Timestamp when the file was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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
     * ID of the job that created this file.
     */
    public function withJobID(string $jobID): self
    {
        $self = clone $this;
        $self['jobID'] = $jobID;

        return $self;
    }

    /**
     * MIME type of the file.
     */
    public function withMimeType(string $mimeType): self
    {
        $self = clone $this;
        $self['mimeType'] = $mimeType;

        return $self;
    }

    /**
     * Path to the file in storage.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * Size of the file in bytes.
     */
    public function withSize(int $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * StorageId identifier where the file is stored.
     */
    public function withStorageID(string $storageID): self
    {
        $self = clone $this;
        $self['storageID'] = $storageID;

        return $self;
    }

    /**
     * Pre-signed URL to directly access the file (only included when available).
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
