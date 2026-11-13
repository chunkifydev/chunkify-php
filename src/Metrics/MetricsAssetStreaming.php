<?php

declare(strict_types=1);

namespace Chunkify\Metrics;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Streaming output distribution on completed Assets.
 *
 * @phpstan-type MetricsAssetStreamingShape = array{
 *   assetCount: int,
 *   assetsByHighestResolution: array<string,int>,
 *   renditionCount: int,
 *   renditionsPerAsset: float|null,
 * }
 */
final class MetricsAssetStreaming implements BaseModel
{
    /** @use SdkModel<MetricsAssetStreamingShape> */
    use SdkModel;

    /**
     * AssetCount specifies completed Assets, including those with no streaming renditions.
     */
    #[Required('asset_count')]
    public int $assetCount;

    /**
     * AssetsByHighestResolution specifies counts by highest measured streaming resolution. Keys are up_to_576, 577_to_720, 721_to_1080, 1081_to_2159, 2160_plus and unknown, using the shorter pixel edge.
     *
     * @var array<string,int> $assetsByHighestResolution
     */
    #[Required('assets_by_highest_resolution', map: 'int')]
    public array $assetsByHighestResolution;

    /**
     * RenditionCount specifies streaming renditions on completed Assets.
     */
    #[Required('rendition_count')]
    public int $renditionCount;

    /**
     * RenditionsPerAsset specifies rendition_count divided by asset_count. Null when no completed Assets exist.
     */
    #[Required('renditions_per_asset')]
    public ?float $renditionsPerAsset;

    /**
     * `new MetricsAssetStreaming()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MetricsAssetStreaming::with(
     *   assetCount: ...,
     *   assetsByHighestResolution: ...,
     *   renditionCount: ...,
     *   renditionsPerAsset: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MetricsAssetStreaming)
     *   ->withAssetCount(...)
     *   ->withAssetsByHighestResolution(...)
     *   ->withRenditionCount(...)
     *   ->withRenditionsPerAsset(...)
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
     * @param array<string,int> $assetsByHighestResolution
     */
    public static function with(
        int $assetCount,
        array $assetsByHighestResolution,
        int $renditionCount,
        ?float $renditionsPerAsset,
    ): self {
        $self = new self;

        $self['assetCount'] = $assetCount;
        $self['assetsByHighestResolution'] = $assetsByHighestResolution;
        $self['renditionCount'] = $renditionCount;
        $self['renditionsPerAsset'] = $renditionsPerAsset;

        return $self;
    }

    /**
     * AssetCount specifies completed Assets, including those with no streaming renditions.
     */
    public function withAssetCount(int $assetCount): self
    {
        $self = clone $this;
        $self['assetCount'] = $assetCount;

        return $self;
    }

    /**
     * AssetsByHighestResolution specifies counts by highest measured streaming resolution. Keys are up_to_576, 577_to_720, 721_to_1080, 1081_to_2159, 2160_plus and unknown, using the shorter pixel edge.
     *
     * @param array<string,int> $assetsByHighestResolution
     */
    public function withAssetsByHighestResolution(
        array $assetsByHighestResolution
    ): self {
        $self = clone $this;
        $self['assetsByHighestResolution'] = $assetsByHighestResolution;

        return $self;
    }

    /**
     * RenditionCount specifies streaming renditions on completed Assets.
     */
    public function withRenditionCount(int $renditionCount): self
    {
        $self = clone $this;
        $self['renditionCount'] = $renditionCount;

        return $self;
    }

    /**
     * RenditionsPerAsset specifies rendition_count divided by asset_count. Null when no completed Assets exist.
     */
    public function withRenditionsPerAsset(?float $renditionsPerAsset): self
    {
        $self = clone $this;
        $self['renditionsPerAsset'] = $renditionsPerAsset;

        return $self;
    }
}
