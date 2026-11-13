<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Assets\Asset;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AssetShape from \Chunkify\Assets\Asset
 *
 * @phpstan-type NotificationPayloadAssetDataShape = array{asset: Asset|AssetShape}
 */
final class NotificationPayloadAssetData implements BaseModel
{
    /** @use SdkModel<NotificationPayloadAssetDataShape> */
    use SdkModel;

    #[Required]
    public Asset $asset;

    /**
     * `new NotificationPayloadAssetData()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPayloadAssetData::with(asset: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPayloadAssetData)->withAsset(...)
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
     * @param Asset|AssetShape $asset
     */
    public static function with(Asset|array $asset): self
    {
        $self = new self;

        $self['asset'] = $asset;

        return $self;
    }

    /**
     * @param Asset|AssetShape $asset
     */
    public function withAsset(Asset|array $asset): self
    {
        $self = clone $this;
        $self['asset'] = $asset;

        return $self;
    }
}
