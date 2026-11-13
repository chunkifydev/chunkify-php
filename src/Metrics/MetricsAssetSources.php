<?php

declare(strict_types=1);

namespace Chunkify\Metrics;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Source profiles count Assets, not unique Sources.
 *
 * @phpstan-type MetricsAssetSourcesShape = array{
 *   assetsByCodec: array<string,int>,
 *   assetsByDuration: array<string,int>,
 *   assetsByResolution: array<string,int>,
 * }
 */
final class MetricsAssetSources implements BaseModel
{
    /** @use SdkModel<MetricsAssetSourcesShape> */
    use SdkModel;

    /**
     * AssetsByCodec specifies Asset counts by normalized source video codec, including unknown. All recorded codecs are returned.
     *
     * @var array<string,int> $assetsByCodec
     */
    #[Required('assets_by_codec', map: 'int')]
    public array $assetsByCodec;

    /**
     * AssetsByDuration specifies Asset counts by source duration. Keys are under_1m, 1_to_5m, 5_to_10m, 10_to_30m, 30_to_60m, over_60m and unknown. Boundaries are 60, 300, 600, 1800 and 3600 seconds; exactly 3600 belongs to 30_to_60m.
     *
     * @var array<string,int> $assetsByDuration
     */
    #[Required('assets_by_duration', map: 'int')]
    public array $assetsByDuration;

    /**
     * AssetsByResolution specifies Asset counts by source resolution. Keys are up_to_576, 577_to_720, 721_to_1080, 1081_to_2159, 2160_plus and unknown, using the shorter pixel edge.
     *
     * @var array<string,int> $assetsByResolution
     */
    #[Required('assets_by_resolution', map: 'int')]
    public array $assetsByResolution;

    /**
     * `new MetricsAssetSources()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MetricsAssetSources::with(
     *   assetsByCodec: ..., assetsByDuration: ..., assetsByResolution: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MetricsAssetSources)
     *   ->withAssetsByCodec(...)
     *   ->withAssetsByDuration(...)
     *   ->withAssetsByResolution(...)
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
     * @param array<string,int> $assetsByCodec
     * @param array<string,int> $assetsByDuration
     * @param array<string,int> $assetsByResolution
     */
    public static function with(
        array $assetsByCodec,
        array $assetsByDuration,
        array $assetsByResolution
    ): self {
        $self = new self;

        $self['assetsByCodec'] = $assetsByCodec;
        $self['assetsByDuration'] = $assetsByDuration;
        $self['assetsByResolution'] = $assetsByResolution;

        return $self;
    }

    /**
     * AssetsByCodec specifies Asset counts by normalized source video codec, including unknown. All recorded codecs are returned.
     *
     * @param array<string,int> $assetsByCodec
     */
    public function withAssetsByCodec(array $assetsByCodec): self
    {
        $self = clone $this;
        $self['assetsByCodec'] = $assetsByCodec;

        return $self;
    }

    /**
     * AssetsByDuration specifies Asset counts by source duration. Keys are under_1m, 1_to_5m, 5_to_10m, 10_to_30m, 30_to_60m, over_60m and unknown. Boundaries are 60, 300, 600, 1800 and 3600 seconds; exactly 3600 belongs to 30_to_60m.
     *
     * @param array<string,int> $assetsByDuration
     */
    public function withAssetsByDuration(array $assetsByDuration): self
    {
        $self = clone $this;
        $self['assetsByDuration'] = $assetsByDuration;

        return $self;
    }

    /**
     * AssetsByResolution specifies Asset counts by source resolution. Keys are up_to_576, 577_to_720, 721_to_1080, 1081_to_2159, 2160_plus and unknown, using the shorter pixel edge.
     *
     * @param array<string,int> $assetsByResolution
     */
    public function withAssetsByResolution(array $assetsByResolution): self
    {
        $self = clone $this;
        $self['assetsByResolution'] = $assetsByResolution;

        return $self;
    }
}
