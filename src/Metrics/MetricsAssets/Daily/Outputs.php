<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricsAssets\Daily;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Measured output sizes for completed Assets. Sample counts describe measurement coverage.
 *
 * @phpstan-type OutputsShape = array{
 *   measuredAssetCount: int,
 *   staticBytes: int|null,
 *   staticSampleCount: int,
 *   streamingBytes: int|null,
 *   streamingSampleCount: int,
 * }
 */
final class Outputs implements BaseModel
{
    /** @use SdkModel<OutputsShape> */
    use SdkModel;

    /**
     * MeasuredAssetCount specifies completed Assets with at least one measured rendition.
     */
    #[Required('measured_asset_count')]
    public int $measuredAssetCount;

    /**
     * StaticBytes specifies the sum of measured ready static rendition sizes. Null when no measurements exist.
     */
    #[Required('static_bytes')]
    public ?int $staticBytes;

    /**
     * StaticSampleCount specifies ready static renditions with measured sizes.
     */
    #[Required('static_sample_count')]
    public int $staticSampleCount;

    /**
     * StreamingBytes specifies the sum of measured streaming rendition sizes. Null when no measurements exist.
     */
    #[Required('streaming_bytes')]
    public ?int $streamingBytes;

    /**
     * StreamingSampleCount specifies streaming renditions with measured sizes.
     */
    #[Required('streaming_sample_count')]
    public int $streamingSampleCount;

    /**
     * `new Outputs()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Outputs::with(
     *   measuredAssetCount: ...,
     *   staticBytes: ...,
     *   staticSampleCount: ...,
     *   streamingBytes: ...,
     *   streamingSampleCount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Outputs)
     *   ->withMeasuredAssetCount(...)
     *   ->withStaticBytes(...)
     *   ->withStaticSampleCount(...)
     *   ->withStreamingBytes(...)
     *   ->withStreamingSampleCount(...)
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
        int $measuredAssetCount,
        ?int $staticBytes,
        int $staticSampleCount,
        ?int $streamingBytes,
        int $streamingSampleCount,
    ): self {
        $self = new self;

        $self['measuredAssetCount'] = $measuredAssetCount;
        $self['staticBytes'] = $staticBytes;
        $self['staticSampleCount'] = $staticSampleCount;
        $self['streamingBytes'] = $streamingBytes;
        $self['streamingSampleCount'] = $streamingSampleCount;

        return $self;
    }

    /**
     * MeasuredAssetCount specifies completed Assets with at least one measured rendition.
     */
    public function withMeasuredAssetCount(int $measuredAssetCount): self
    {
        $self = clone $this;
        $self['measuredAssetCount'] = $measuredAssetCount;

        return $self;
    }

    /**
     * StaticBytes specifies the sum of measured ready static rendition sizes. Null when no measurements exist.
     */
    public function withStaticBytes(?int $staticBytes): self
    {
        $self = clone $this;
        $self['staticBytes'] = $staticBytes;

        return $self;
    }

    /**
     * StaticSampleCount specifies ready static renditions with measured sizes.
     */
    public function withStaticSampleCount(int $staticSampleCount): self
    {
        $self = clone $this;
        $self['staticSampleCount'] = $staticSampleCount;

        return $self;
    }

    /**
     * StreamingBytes specifies the sum of measured streaming rendition sizes. Null when no measurements exist.
     */
    public function withStreamingBytes(?int $streamingBytes): self
    {
        $self = clone $this;
        $self['streamingBytes'] = $streamingBytes;

        return $self;
    }

    /**
     * StreamingSampleCount specifies streaming renditions with measured sizes.
     */
    public function withStreamingSampleCount(int $streamingSampleCount): self
    {
        $self = clone $this;
        $self['streamingSampleCount'] = $streamingSampleCount;

        return $self;
    }
}
