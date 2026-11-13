<?php

declare(strict_types=1);

namespace Chunkify\Transcodings;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Transcodings\TranscodingFile\ThumbnailStatus;

/**
 * A validated media file published by a Transcoding.
 *
 * @phpstan-import-type TranscodingFileThumbnailShape from \Chunkify\Transcodings\TranscodingFileThumbnail
 *
 * @phpstan-type TranscodingFileShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   duration: float,
 *   mimeType: string,
 *   path: string,
 *   size: int,
 *   storageID: string,
 *   thumbnails: list<TranscodingFileThumbnail|TranscodingFileThumbnailShape>,
 *   transcodingID: string,
 *   audioBitrate?: int|null,
 *   audioCodec?: string|null,
 *   audioSamplerate?: int|null,
 *   cdnURL?: string|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   height?: int|null,
 *   thumbnailStatus?: null|ThumbnailStatus|value-of<ThumbnailStatus>,
 *   url?: string|null,
 *   videoBitrate?: int|null,
 *   videoCodec?: string|null,
 *   videoFramerate?: float|null,
 *   width?: int|null,
 * }
 */
final class TranscodingFile implements BaseModel
{
    /** @use SdkModel<TranscodingFileShape> */
    use SdkModel;

    /**
     * Id identifies this published Transcoding file.
     */
    #[Required]
    public string $id;

    /**
     * CreatedAt records when the validated file was published.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Duration specifies the measured output duration in seconds.
     */
    #[Required]
    public float $duration;

    /**
     * MimeType specifies the media content type.
     */
    #[Required('mime_type')]
    public string $mimeType;

    /**
     * Path specifies the output path relative to the Storage base_prefix saved when the Transcoding was created. Later Storage prefix changes do not move this file.
     */
    #[Required]
    public string $path;

    /**
     * Size specifies the measured file size in bytes.
     */
    #[Required]
    public int $size;

    /**
     * StorageId identifies the output Storage.
     */
    #[Required('storage_id')]
    public string $storageID;

    /**
     * Thumbnails contains available dashboard preview images. Empty for audio-only files, failed previews or expired files.
     *
     * @var list<TranscodingFileThumbnail> $thumbnails
     */
    #[Required(list: TranscodingFileThumbnail::class)]
    public array $thumbnails;

    /**
     * TranscodingId identifies the Transcoding that produced this file.
     */
    #[Required('transcoding_id')]
    public string $transcodingID;

    /**
     * AudioBitrate specifies measured audio bits per second, or zero when unavailable. Omitted without audio.
     */
    #[Optional('audio_bitrate')]
    public ?int $audioBitrate;

    /**
     * AudioCodec specifies the measured audio codec. Omitted without audio.
     */
    #[Optional('audio_codec')]
    public ?string $audioCodec;

    /**
     * AudioSamplerate specifies measured audio samples per second. Omitted without audio.
     */
    #[Optional('audio_samplerate')]
    public ?int $audioSamplerate;

    /**
     * CdnUrl provides the URL from the Storage CDN configuration. Omitted without a configured CDN or after file expiry.
     */
    #[Optional('cdn_url')]
    public ?string $cdnURL;

    /**
     * ExpiresAt specifies when a temporary output expires. Omitted for customer-owned output storage.
     */
    #[Optional('expires_at')]
    public ?\DateTimeInterface $expiresAt;

    /**
     * Height specifies the measured video height in pixels. Omitted for audio-only files.
     */
    #[Optional]
    public ?int $height;

    /**
     * ThumbnailStatus reports the optional dashboard preview result. Failure does not affect the media file. Omitted for audio-only files.
     *
     * @var value-of<ThumbnailStatus>|null $thumbnailStatus
     */
    #[Optional('thumbnail_status', enum: ThumbnailStatus::class)]
    public ?string $thumbnailStatus;

    /**
     * Url provides a signed download valid for at most ten minutes. Omitted when the file has expired or signing is unavailable.
     */
    #[Optional]
    public ?string $url;

    /**
     * VideoBitrate specifies measured video bits per second, or zero when unavailable. Omitted without video.
     */
    #[Optional('video_bitrate')]
    public ?int $videoBitrate;

    /**
     * VideoCodec specifies the measured video codec. Omitted for audio-only files.
     */
    #[Optional('video_codec')]
    public ?string $videoCodec;

    /**
     * VideoFramerate specifies measured video frames per second. Omitted without video.
     */
    #[Optional('video_framerate')]
    public ?float $videoFramerate;

    /**
     * Width specifies the measured video width in pixels. Omitted for audio-only files.
     */
    #[Optional]
    public ?int $width;

    /**
     * `new TranscodingFile()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TranscodingFile::with(
     *   id: ...,
     *   createdAt: ...,
     *   duration: ...,
     *   mimeType: ...,
     *   path: ...,
     *   size: ...,
     *   storageID: ...,
     *   thumbnails: ...,
     *   transcodingID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TranscodingFile)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withDuration(...)
     *   ->withMimeType(...)
     *   ->withPath(...)
     *   ->withSize(...)
     *   ->withStorageID(...)
     *   ->withThumbnails(...)
     *   ->withTranscodingID(...)
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
     * @param list<TranscodingFileThumbnail|TranscodingFileThumbnailShape> $thumbnails
     * @param ThumbnailStatus|value-of<ThumbnailStatus>|null $thumbnailStatus
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        float $duration,
        string $mimeType,
        string $path,
        int $size,
        string $storageID,
        array $thumbnails,
        string $transcodingID,
        ?int $audioBitrate = null,
        ?string $audioCodec = null,
        ?int $audioSamplerate = null,
        ?string $cdnURL = null,
        ?\DateTimeInterface $expiresAt = null,
        ?int $height = null,
        ThumbnailStatus|string|null $thumbnailStatus = null,
        ?string $url = null,
        ?int $videoBitrate = null,
        ?string $videoCodec = null,
        ?float $videoFramerate = null,
        ?int $width = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['duration'] = $duration;
        $self['mimeType'] = $mimeType;
        $self['path'] = $path;
        $self['size'] = $size;
        $self['storageID'] = $storageID;
        $self['thumbnails'] = $thumbnails;
        $self['transcodingID'] = $transcodingID;

        null !== $audioBitrate && $self['audioBitrate'] = $audioBitrate;
        null !== $audioCodec && $self['audioCodec'] = $audioCodec;
        null !== $audioSamplerate && $self['audioSamplerate'] = $audioSamplerate;
        null !== $cdnURL && $self['cdnURL'] = $cdnURL;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $height && $self['height'] = $height;
        null !== $thumbnailStatus && $self['thumbnailStatus'] = $thumbnailStatus;
        null !== $url && $self['url'] = $url;
        null !== $videoBitrate && $self['videoBitrate'] = $videoBitrate;
        null !== $videoCodec && $self['videoCodec'] = $videoCodec;
        null !== $videoFramerate && $self['videoFramerate'] = $videoFramerate;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Id identifies this published Transcoding file.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * CreatedAt records when the validated file was published.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Duration specifies the measured output duration in seconds.
     */
    public function withDuration(float $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * MimeType specifies the media content type.
     */
    public function withMimeType(string $mimeType): self
    {
        $self = clone $this;
        $self['mimeType'] = $mimeType;

        return $self;
    }

    /**
     * Path specifies the output path relative to the Storage base_prefix saved when the Transcoding was created. Later Storage prefix changes do not move this file.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * Size specifies the measured file size in bytes.
     */
    public function withSize(int $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * StorageId identifies the output Storage.
     */
    public function withStorageID(string $storageID): self
    {
        $self = clone $this;
        $self['storageID'] = $storageID;

        return $self;
    }

    /**
     * Thumbnails contains available dashboard preview images. Empty for audio-only files, failed previews or expired files.
     *
     * @param list<TranscodingFileThumbnail|TranscodingFileThumbnailShape> $thumbnails
     */
    public function withThumbnails(array $thumbnails): self
    {
        $self = clone $this;
        $self['thumbnails'] = $thumbnails;

        return $self;
    }

    /**
     * TranscodingId identifies the Transcoding that produced this file.
     */
    public function withTranscodingID(string $transcodingID): self
    {
        $self = clone $this;
        $self['transcodingID'] = $transcodingID;

        return $self;
    }

    /**
     * AudioBitrate specifies measured audio bits per second, or zero when unavailable. Omitted without audio.
     */
    public function withAudioBitrate(int $audioBitrate): self
    {
        $self = clone $this;
        $self['audioBitrate'] = $audioBitrate;

        return $self;
    }

    /**
     * AudioCodec specifies the measured audio codec. Omitted without audio.
     */
    public function withAudioCodec(string $audioCodec): self
    {
        $self = clone $this;
        $self['audioCodec'] = $audioCodec;

        return $self;
    }

    /**
     * AudioSamplerate specifies measured audio samples per second. Omitted without audio.
     */
    public function withAudioSamplerate(int $audioSamplerate): self
    {
        $self = clone $this;
        $self['audioSamplerate'] = $audioSamplerate;

        return $self;
    }

    /**
     * CdnUrl provides the URL from the Storage CDN configuration. Omitted without a configured CDN or after file expiry.
     */
    public function withCdnURL(string $cdnURL): self
    {
        $self = clone $this;
        $self['cdnURL'] = $cdnURL;

        return $self;
    }

    /**
     * ExpiresAt specifies when a temporary output expires. Omitted for customer-owned output storage.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Height specifies the measured video height in pixels. Omitted for audio-only files.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * ThumbnailStatus reports the optional dashboard preview result. Failure does not affect the media file. Omitted for audio-only files.
     *
     * @param ThumbnailStatus|value-of<ThumbnailStatus> $thumbnailStatus
     */
    public function withThumbnailStatus(
        ThumbnailStatus|string $thumbnailStatus
    ): self {
        $self = clone $this;
        $self['thumbnailStatus'] = $thumbnailStatus;

        return $self;
    }

    /**
     * Url provides a signed download valid for at most ten minutes. Omitted when the file has expired or signing is unavailable.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * VideoBitrate specifies measured video bits per second, or zero when unavailable. Omitted without video.
     */
    public function withVideoBitrate(int $videoBitrate): self
    {
        $self = clone $this;
        $self['videoBitrate'] = $videoBitrate;

        return $self;
    }

    /**
     * VideoCodec specifies the measured video codec. Omitted for audio-only files.
     */
    public function withVideoCodec(string $videoCodec): self
    {
        $self = clone $this;
        $self['videoCodec'] = $videoCodec;

        return $self;
    }

    /**
     * VideoFramerate specifies measured video frames per second. Omitted without video.
     */
    public function withVideoFramerate(float $videoFramerate): self
    {
        $self = clone $this;
        $self['videoFramerate'] = $videoFramerate;

        return $self;
    }

    /**
     * Width specifies the measured video width in pixels. Omitted for audio-only files.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
