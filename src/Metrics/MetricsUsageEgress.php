<?php

declare(strict_types=1);

namespace Chunkify\Metrics;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Recorded output egress eligible for the transfer tariff. Provider-exempt transfers are excluded.
 *
 * @phpstan-type MetricsUsageEgressShape = array{
 *   assetPreparationBytes: int,
 *   assetRenditionBytes: int,
 *   billableBytes: int,
 *   captionBytes: int,
 *   includedBytes: int,
 *   staticRenditionBytes: int,
 *   thumbnailBytes: int,
 *   totalBytes: int,
 *   transcodingBytes: int,
 * }
 */
final class MetricsUsageEgress implements BaseModel
{
    /** @use SdkModel<MetricsUsageEgressShape> */
    use SdkModel;

    /**
     * Bytes specifies tariff-eligible output transfer bytes for Asset preparation.
     */
    #[Required('asset_preparation_bytes')]
    public int $assetPreparationBytes;

    /**
     * Bytes specifies tariff-eligible output transfer bytes for streaming renditions.
     */
    #[Required('asset_rendition_bytes')]
    public int $assetRenditionBytes;

    /**
     * BillableBytes specifies external output bytes charged after the allowance.
     */
    #[Required('billable_bytes')]
    public int $billableBytes;

    /**
     * Bytes specifies tariff-eligible output transfer bytes for captions.
     */
    #[Required('caption_bytes')]
    public int $captionBytes;

    /**
     * IncludedBytes specifies external output bytes covered by the allowance.
     */
    #[Required('included_bytes')]
    public int $includedBytes;

    /**
     * Bytes specifies tariff-eligible output transfer bytes for static renditions.
     */
    #[Required('static_rendition_bytes')]
    public int $staticRenditionBytes;

    /**
     * Bytes specifies tariff-eligible output transfer bytes for Thumbnails.
     */
    #[Required('thumbnail_bytes')]
    public int $thumbnailBytes;

    /**
     * TotalBytes specifies the sum of tariff-eligible output transfers.
     */
    #[Required('total_bytes')]
    public int $totalBytes;

    /**
     * Bytes specifies tariff-eligible output transfer bytes for Transcodings.
     */
    #[Required('transcoding_bytes')]
    public int $transcodingBytes;

    /**
     * `new MetricsUsageEgress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MetricsUsageEgress::with(
     *   assetPreparationBytes: ...,
     *   assetRenditionBytes: ...,
     *   billableBytes: ...,
     *   captionBytes: ...,
     *   includedBytes: ...,
     *   staticRenditionBytes: ...,
     *   thumbnailBytes: ...,
     *   totalBytes: ...,
     *   transcodingBytes: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MetricsUsageEgress)
     *   ->withAssetPreparationBytes(...)
     *   ->withAssetRenditionBytes(...)
     *   ->withBillableBytes(...)
     *   ->withCaptionBytes(...)
     *   ->withIncludedBytes(...)
     *   ->withStaticRenditionBytes(...)
     *   ->withThumbnailBytes(...)
     *   ->withTotalBytes(...)
     *   ->withTranscodingBytes(...)
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
        int $assetPreparationBytes,
        int $assetRenditionBytes,
        int $billableBytes,
        int $captionBytes,
        int $includedBytes,
        int $staticRenditionBytes,
        int $thumbnailBytes,
        int $totalBytes,
        int $transcodingBytes,
    ): self {
        $self = new self;

        $self['assetPreparationBytes'] = $assetPreparationBytes;
        $self['assetRenditionBytes'] = $assetRenditionBytes;
        $self['billableBytes'] = $billableBytes;
        $self['captionBytes'] = $captionBytes;
        $self['includedBytes'] = $includedBytes;
        $self['staticRenditionBytes'] = $staticRenditionBytes;
        $self['thumbnailBytes'] = $thumbnailBytes;
        $self['totalBytes'] = $totalBytes;
        $self['transcodingBytes'] = $transcodingBytes;

        return $self;
    }

    /**
     * Bytes specifies tariff-eligible output transfer bytes for Asset preparation.
     */
    public function withAssetPreparationBytes(int $assetPreparationBytes): self
    {
        $self = clone $this;
        $self['assetPreparationBytes'] = $assetPreparationBytes;

        return $self;
    }

    /**
     * Bytes specifies tariff-eligible output transfer bytes for streaming renditions.
     */
    public function withAssetRenditionBytes(int $assetRenditionBytes): self
    {
        $self = clone $this;
        $self['assetRenditionBytes'] = $assetRenditionBytes;

        return $self;
    }

    /**
     * BillableBytes specifies external output bytes charged after the allowance.
     */
    public function withBillableBytes(int $billableBytes): self
    {
        $self = clone $this;
        $self['billableBytes'] = $billableBytes;

        return $self;
    }

    /**
     * Bytes specifies tariff-eligible output transfer bytes for captions.
     */
    public function withCaptionBytes(int $captionBytes): self
    {
        $self = clone $this;
        $self['captionBytes'] = $captionBytes;

        return $self;
    }

    /**
     * IncludedBytes specifies external output bytes covered by the allowance.
     */
    public function withIncludedBytes(int $includedBytes): self
    {
        $self = clone $this;
        $self['includedBytes'] = $includedBytes;

        return $self;
    }

    /**
     * Bytes specifies tariff-eligible output transfer bytes for static renditions.
     */
    public function withStaticRenditionBytes(int $staticRenditionBytes): self
    {
        $self = clone $this;
        $self['staticRenditionBytes'] = $staticRenditionBytes;

        return $self;
    }

    /**
     * Bytes specifies tariff-eligible output transfer bytes for Thumbnails.
     */
    public function withThumbnailBytes(int $thumbnailBytes): self
    {
        $self = clone $this;
        $self['thumbnailBytes'] = $thumbnailBytes;

        return $self;
    }

    /**
     * TotalBytes specifies the sum of tariff-eligible output transfers.
     */
    public function withTotalBytes(int $totalBytes): self
    {
        $self = clone $this;
        $self['totalBytes'] = $totalBytes;

        return $self;
    }

    /**
     * Bytes specifies tariff-eligible output transfer bytes for Transcodings.
     */
    public function withTranscodingBytes(int $transcodingBytes): self
    {
        $self = clone $this;
        $self['transcodingBytes'] = $transcodingBytes;

        return $self;
    }
}
