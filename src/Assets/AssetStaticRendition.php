<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\AssetOutputError;
use Chunkify\Assets\AssetStaticRendition\RequestedResolution;
use Chunkify\Assets\AssetStaticRendition\Status;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AssetOutputErrorShape from \Chunkify\AssetOutputError
 * @phpstan-import-type AssetRenditionProgressShape from \Chunkify\Assets\AssetRenditionProgress
 *
 * @phpstan-type AssetStaticRenditionShape = array{
 *   id: string,
 *   assetID: string,
 *   container: 'mp4',
 *   createdAt: \DateTimeInterface,
 *   height: int,
 *   path: string,
 *   requestedResolution: RequestedResolution|value-of<RequestedResolution>,
 *   resolution: string,
 *   status: Status|value-of<Status>,
 *   storageID: string,
 *   updatedAt: \DateTimeInterface,
 *   videoCodec: 'h264',
 *   width: int,
 *   audioBitrate?: int|null,
 *   audioCodec?: string|null,
 *   audioSamplerate?: int|null,
 *   cdnURL?: string|null,
 *   duration?: float|null,
 *   error?: null|AssetOutputError|AssetOutputErrorShape,
 *   progress?: null|AssetRenditionProgress|AssetRenditionProgressShape,
 *   readyAt?: \DateTimeInterface|null,
 *   size?: int|null,
 *   url?: string|null,
 *   videoBitrate?: int|null,
 *   videoFramerate?: float|null,
 * }
 */
final class AssetStaticRendition implements BaseModel
{
    /** @use SdkModel<AssetStaticRenditionShape> */
    use SdkModel;

    /**
     * Media container.
     *
     * @var 'mp4' $container
     */
    #[Required]
    public string $container = 'mp4';

    /**
     * Video codec.
     *
     * @var 'h264' $videoCodec
     */
    #[Required('video_codec')]
    public string $videoCodec = 'h264';

    /**
     * Unique Asset output ID, prefixed with aop_.
     */
    #[Required]
    public string $id;

    /**
     * Parent Asset ID.
     */
    #[Required('asset_id')]
    public string $assetID;

    /**
     * When the rendition was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Output height in pixels.
     */
    #[Required]
    public int $height;

    /**
     * MP4 path in Storage. Recreating the same resolution reuses this path and overwrites any retained file.
     */
    #[Required]
    public string $path;

    /**
     * Requested resolution selector.
     *
     * @var value-of<RequestedResolution> $requestedResolution
     */
    #[Required('requested_resolution', enum: RequestedResolution::class)]
    public string $requestedResolution;

    /**
     * Selected output resolution. May be smaller than 240p for small sources. Use width and height for pixel dimensions.
     */
    #[Required]
    public string $resolution;

    /**
     * Processing status of this MP4, independent of streaming outputs.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Storage containing this rendition, inherited from its Asset.
     */
    #[Required('storage_id')]
    public string $storageID;

    /**
     * When the rendition was last updated.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Output width in pixels.
     */
    #[Required]
    public int $width;

    /**
     * Measured audio bitrate in bits per second. Omitted until known or when there is no audio.
     */
    #[Optional('audio_bitrate')]
    public ?int $audioBitrate;

    /**
     * Measured audio codec. Omitted until known or when there is no audio.
     */
    #[Optional('audio_codec')]
    public ?string $audioCodec;

    /**
     * Measured audio sample rate in Hz. Omitted until known or when there is no audio.
     */
    #[Optional('audio_samplerate')]
    public ?int $audioSamplerate;

    /**
     * Unsigned MP4 CDN URL. Available when ready and unexpired and Storage has a CDN URL.
     */
    #[Optional('cdn_url')]
    public ?string $cdnURL;

    /**
     * Output duration in seconds. Omitted until ready.
     */
    #[Optional]
    public ?float $duration;

    /**
     * A customer-facing Asset output processing failure.
     */
    #[Optional]
    public ?AssetOutputError $error;

    /**
     * Progress specifies the current processing stage and encoding percentage. Omitted after processing ends.
     */
    #[Optional]
    public ?AssetRenditionProgress $progress;

    /**
     * When the MP4 became available.
     */
    #[Optional('ready_at')]
    public ?\DateTimeInterface $readyAt;

    /**
     * File size in bytes. Omitted until ready.
     */
    #[Optional]
    public ?int $size;

    /**
     * Signed MP4 download URL, available when ready and unexpired. Valid for up to ten minutes. Retrieve the output to refresh it. Independent of preview_enabled.
     */
    #[Optional]
    public ?string $url;

    /**
     * Measured video bitrate in bits per second. Omitted until ready.
     */
    #[Optional('video_bitrate')]
    public ?int $videoBitrate;

    /**
     * Measured video frame rate in frames per second. Omitted until known.
     */
    #[Optional('video_framerate')]
    public ?float $videoFramerate;

    /**
     * `new AssetStaticRendition()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetStaticRendition::with(
     *   id: ...,
     *   assetID: ...,
     *   createdAt: ...,
     *   height: ...,
     *   path: ...,
     *   requestedResolution: ...,
     *   resolution: ...,
     *   status: ...,
     *   storageID: ...,
     *   updatedAt: ...,
     *   width: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetStaticRendition)
     *   ->withID(...)
     *   ->withAssetID(...)
     *   ->withCreatedAt(...)
     *   ->withHeight(...)
     *   ->withPath(...)
     *   ->withRequestedResolution(...)
     *   ->withResolution(...)
     *   ->withStatus(...)
     *   ->withStorageID(...)
     *   ->withUpdatedAt(...)
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
     * @param RequestedResolution|value-of<RequestedResolution> $requestedResolution
     * @param Status|value-of<Status> $status
     * @param AssetOutputError|AssetOutputErrorShape|null $error
     * @param AssetRenditionProgress|AssetRenditionProgressShape|null $progress
     */
    public static function with(
        string $id,
        string $assetID,
        \DateTimeInterface $createdAt,
        int $height,
        string $path,
        RequestedResolution|string $requestedResolution,
        string $resolution,
        Status|string $status,
        string $storageID,
        \DateTimeInterface $updatedAt,
        int $width,
        ?int $audioBitrate = null,
        ?string $audioCodec = null,
        ?int $audioSamplerate = null,
        ?string $cdnURL = null,
        ?float $duration = null,
        AssetOutputError|array|null $error = null,
        AssetRenditionProgress|array|null $progress = null,
        ?\DateTimeInterface $readyAt = null,
        ?int $size = null,
        ?string $url = null,
        ?int $videoBitrate = null,
        ?float $videoFramerate = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['assetID'] = $assetID;
        $self['createdAt'] = $createdAt;
        $self['height'] = $height;
        $self['path'] = $path;
        $self['requestedResolution'] = $requestedResolution;
        $self['resolution'] = $resolution;
        $self['status'] = $status;
        $self['storageID'] = $storageID;
        $self['updatedAt'] = $updatedAt;
        $self['width'] = $width;

        null !== $audioBitrate && $self['audioBitrate'] = $audioBitrate;
        null !== $audioCodec && $self['audioCodec'] = $audioCodec;
        null !== $audioSamplerate && $self['audioSamplerate'] = $audioSamplerate;
        null !== $cdnURL && $self['cdnURL'] = $cdnURL;
        null !== $duration && $self['duration'] = $duration;
        null !== $error && $self['error'] = $error;
        null !== $progress && $self['progress'] = $progress;
        null !== $readyAt && $self['readyAt'] = $readyAt;
        null !== $size && $self['size'] = $size;
        null !== $url && $self['url'] = $url;
        null !== $videoBitrate && $self['videoBitrate'] = $videoBitrate;
        null !== $videoFramerate && $self['videoFramerate'] = $videoFramerate;

        return $self;
    }

    /**
     * Unique Asset output ID, prefixed with aop_.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Parent Asset ID.
     */
    public function withAssetID(string $assetID): self
    {
        $self = clone $this;
        $self['assetID'] = $assetID;

        return $self;
    }

    /**
     * Media container.
     *
     * @param 'mp4' $container
     */
    public function withContainer(string $container): self
    {
        $self = clone $this;
        $self['container'] = $container;

        return $self;
    }

    /**
     * When the rendition was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Output height in pixels.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * MP4 path in Storage. Recreating the same resolution reuses this path and overwrites any retained file.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * Requested resolution selector.
     *
     * @param RequestedResolution|value-of<RequestedResolution> $requestedResolution
     */
    public function withRequestedResolution(
        RequestedResolution|string $requestedResolution
    ): self {
        $self = clone $this;
        $self['requestedResolution'] = $requestedResolution;

        return $self;
    }

    /**
     * Selected output resolution. May be smaller than 240p for small sources. Use width and height for pixel dimensions.
     */
    public function withResolution(string $resolution): self
    {
        $self = clone $this;
        $self['resolution'] = $resolution;

        return $self;
    }

    /**
     * Processing status of this MP4, independent of streaming outputs.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Storage containing this rendition, inherited from its Asset.
     */
    public function withStorageID(string $storageID): self
    {
        $self = clone $this;
        $self['storageID'] = $storageID;

        return $self;
    }

    /**
     * When the rendition was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Video codec.
     *
     * @param 'h264' $videoCodec
     */
    public function withVideoCodec(string $videoCodec): self
    {
        $self = clone $this;
        $self['videoCodec'] = $videoCodec;

        return $self;
    }

    /**
     * Output width in pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }

    /**
     * Measured audio bitrate in bits per second. Omitted until known or when there is no audio.
     */
    public function withAudioBitrate(int $audioBitrate): self
    {
        $self = clone $this;
        $self['audioBitrate'] = $audioBitrate;

        return $self;
    }

    /**
     * Measured audio codec. Omitted until known or when there is no audio.
     */
    public function withAudioCodec(string $audioCodec): self
    {
        $self = clone $this;
        $self['audioCodec'] = $audioCodec;

        return $self;
    }

    /**
     * Measured audio sample rate in Hz. Omitted until known or when there is no audio.
     */
    public function withAudioSamplerate(int $audioSamplerate): self
    {
        $self = clone $this;
        $self['audioSamplerate'] = $audioSamplerate;

        return $self;
    }

    /**
     * Unsigned MP4 CDN URL. Available when ready and unexpired and Storage has a CDN URL.
     */
    public function withCdnURL(string $cdnURL): self
    {
        $self = clone $this;
        $self['cdnURL'] = $cdnURL;

        return $self;
    }

    /**
     * Output duration in seconds. Omitted until ready.
     */
    public function withDuration(float $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * A customer-facing Asset output processing failure.
     *
     * @param AssetOutputError|AssetOutputErrorShape $error
     */
    public function withError(AssetOutputError|array $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Progress specifies the current processing stage and encoding percentage. Omitted after processing ends.
     *
     * @param AssetRenditionProgress|AssetRenditionProgressShape $progress
     */
    public function withProgress(AssetRenditionProgress|array $progress): self
    {
        $self = clone $this;
        $self['progress'] = $progress;

        return $self;
    }

    /**
     * When the MP4 became available.
     */
    public function withReadyAt(\DateTimeInterface $readyAt): self
    {
        $self = clone $this;
        $self['readyAt'] = $readyAt;

        return $self;
    }

    /**
     * File size in bytes. Omitted until ready.
     */
    public function withSize(int $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * Signed MP4 download URL, available when ready and unexpired. Valid for up to ten minutes. Retrieve the output to refresh it. Independent of preview_enabled.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Measured video bitrate in bits per second. Omitted until ready.
     */
    public function withVideoBitrate(int $videoBitrate): self
    {
        $self = clone $this;
        $self['videoBitrate'] = $videoBitrate;

        return $self;
    }

    /**
     * Measured video frame rate in frames per second. Omitted until known.
     */
    public function withVideoFramerate(float $videoFramerate): self
    {
        $self = clone $this;
        $self['videoFramerate'] = $videoFramerate;

        return $self;
    }
}
