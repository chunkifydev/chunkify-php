<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadAsset;

use Chunkify\Assets\Asset;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Payload for the event named in event. Replays preserve the original data; retrieve the resource for current state and fresh signed URLs.
 *
 * @phpstan-import-type AssetShape from \Chunkify\Assets\Asset
 *
 * @phpstan-type DataShape = array{asset: Asset|AssetShape}
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    #[Required]
    public Asset $asset;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(asset: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withAsset(...)
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
