<?php

declare(strict_types=1);

namespace Chunkify\Metrics;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Recorded storage activity grouped by event day.
 *
 * @phpstan-type MetricsStorageDayShape = array{
 *   assetBytesAdded: int,
 *   bytesRemoved: int,
 *   netBytesChange: int,
 *   sourceBytesAdded: int,
 *   staticRenditionBytesAdded: int,
 *   date: string,
 * }
 */
final class MetricsStorageDay implements BaseModel
{
    /** @use SdkModel<MetricsStorageDayShape> */
    use SdkModel;

    /**
     * AssetBytesAdded specifies recorded Asset package additions.
     */
    #[Required('asset_bytes_added')]
    public int $assetBytesAdded;

    /**
     * BytesRemoved specifies recorded successful file removals as a positive amount.
     */
    #[Required('bytes_removed')]
    public int $bytesRemoved;

    /**
     * NetBytesChange specifies additions minus successful removals. This may be negative and is not bucket occupancy.
     */
    #[Required('net_bytes_change')]
    public int $netBytesChange;

    /**
     * SourceBytesAdded specifies recorded Source additions.
     */
    #[Required('source_bytes_added')]
    public int $sourceBytesAdded;

    /**
     * StaticRenditionBytesAdded specifies recorded static rendition additions.
     */
    #[Required('static_rendition_bytes_added')]
    public int $staticRenditionBytesAdded;

    /**
     * Date specifies the UTC event day.
     */
    #[Required]
    public string $date;

    /**
     * `new MetricsStorageDay()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MetricsStorageDay::with(
     *   assetBytesAdded: ...,
     *   bytesRemoved: ...,
     *   netBytesChange: ...,
     *   sourceBytesAdded: ...,
     *   staticRenditionBytesAdded: ...,
     *   date: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MetricsStorageDay)
     *   ->withAssetBytesAdded(...)
     *   ->withBytesRemoved(...)
     *   ->withNetBytesChange(...)
     *   ->withSourceBytesAdded(...)
     *   ->withStaticRenditionBytesAdded(...)
     *   ->withDate(...)
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
        int $assetBytesAdded,
        int $bytesRemoved,
        int $netBytesChange,
        int $sourceBytesAdded,
        int $staticRenditionBytesAdded,
        string $date,
    ): self {
        $self = new self;

        $self['assetBytesAdded'] = $assetBytesAdded;
        $self['bytesRemoved'] = $bytesRemoved;
        $self['netBytesChange'] = $netBytesChange;
        $self['sourceBytesAdded'] = $sourceBytesAdded;
        $self['staticRenditionBytesAdded'] = $staticRenditionBytesAdded;
        $self['date'] = $date;

        return $self;
    }

    /**
     * AssetBytesAdded specifies recorded Asset package additions.
     */
    public function withAssetBytesAdded(int $assetBytesAdded): self
    {
        $self = clone $this;
        $self['assetBytesAdded'] = $assetBytesAdded;

        return $self;
    }

    /**
     * BytesRemoved specifies recorded successful file removals as a positive amount.
     */
    public function withBytesRemoved(int $bytesRemoved): self
    {
        $self = clone $this;
        $self['bytesRemoved'] = $bytesRemoved;

        return $self;
    }

    /**
     * NetBytesChange specifies additions minus successful removals. This may be negative and is not bucket occupancy.
     */
    public function withNetBytesChange(int $netBytesChange): self
    {
        $self = clone $this;
        $self['netBytesChange'] = $netBytesChange;

        return $self;
    }

    /**
     * SourceBytesAdded specifies recorded Source additions.
     */
    public function withSourceBytesAdded(int $sourceBytesAdded): self
    {
        $self = clone $this;
        $self['sourceBytesAdded'] = $sourceBytesAdded;

        return $self;
    }

    /**
     * StaticRenditionBytesAdded specifies recorded static rendition additions.
     */
    public function withStaticRenditionBytesAdded(
        int $staticRenditionBytesAdded
    ): self {
        $self = clone $this;
        $self['staticRenditionBytesAdded'] = $staticRenditionBytesAdded;

        return $self;
    }

    /**
     * Date specifies the UTC event day.
     */
    public function withDate(string $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }
}
