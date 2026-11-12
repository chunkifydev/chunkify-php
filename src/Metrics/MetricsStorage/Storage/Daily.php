<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricsStorage\Storage;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Recorded storage activity grouped by event day.
 *
 * @phpstan-type DailyShape = array{
 *   assetBytesAdded: int,
 *   bytesRemoved: int,
 *   date: string,
 *   netBytesChange: int,
 *   sourceBytesAdded: int,
 *   staticRenditionBytesAdded: int,
 * }
 */
final class Daily implements BaseModel
{
    /** @use SdkModel<DailyShape> */
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
     * Date specifies the UTC event day.
     */
    #[Required]
    public string $date;

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
     * `new Daily()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Daily::with(
     *   assetBytesAdded: ...,
     *   bytesRemoved: ...,
     *   date: ...,
     *   netBytesChange: ...,
     *   sourceBytesAdded: ...,
     *   staticRenditionBytesAdded: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Daily)
     *   ->withAssetBytesAdded(...)
     *   ->withBytesRemoved(...)
     *   ->withDate(...)
     *   ->withNetBytesChange(...)
     *   ->withSourceBytesAdded(...)
     *   ->withStaticRenditionBytesAdded(...)
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
        string $date,
        int $netBytesChange,
        int $sourceBytesAdded,
        int $staticRenditionBytesAdded,
    ): self {
        $self = new self;

        $self['assetBytesAdded'] = $assetBytesAdded;
        $self['bytesRemoved'] = $bytesRemoved;
        $self['date'] = $date;
        $self['netBytesChange'] = $netBytesChange;
        $self['sourceBytesAdded'] = $sourceBytesAdded;
        $self['staticRenditionBytesAdded'] = $staticRenditionBytesAdded;

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
     * Date specifies the UTC event day.
     */
    public function withDate(string $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

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
}
