<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NewEventWebhookEvent\Data;

use Chunkify\Assets\Asset;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Payload for asset.deleted. The Asset snapshot is preserved after record deletion.
 *
 * @phpstan-import-type AssetShape from \Chunkify\Assets\Asset
 *
 * @phpstan-type NotificationPayloadAssetDeletedShape = array{
 *   asset: Asset|AssetShape, filesDeleted: bool, deletedSize?: int|null
 * }
 */
final class NotificationPayloadAssetDeleted implements BaseModel
{
    /** @use SdkModel<NotificationPayloadAssetDeletedShape> */
    use SdkModel;

    #[Required]
    public Asset $asset;

    /**
     * FilesDeleted indicates whether the requested cleanup of the Asset's generated files completed without error. Missing files count as successful cleanup. False means these files were not removed at event time. Private transcript text and saved subtitle copies are always scheduled for asynchronous cleanup.
     */
    #[Required('files_deleted')]
    public bool $filesDeleted;

    /**
     * DeletedSize specifies the recorded generated-file bytes removed with the Asset, including attached outputs. Omitted when cleanup was not requested or the total is unavailable. Missing storage objects still contribute their recorded sizes.
     */
    #[Optional('deleted_size')]
    public ?int $deletedSize;

    /**
     * `new NotificationPayloadAssetDeleted()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPayloadAssetDeleted::with(asset: ..., filesDeleted: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPayloadAssetDeleted)->withAsset(...)->withFilesDeleted(...)
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
    public static function with(
        Asset|array $asset,
        bool $filesDeleted,
        ?int $deletedSize = null
    ): self {
        $self = new self;

        $self['asset'] = $asset;
        $self['filesDeleted'] = $filesDeleted;

        null !== $deletedSize && $self['deletedSize'] = $deletedSize;

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

    /**
     * FilesDeleted indicates whether the requested cleanup of the Asset's generated files completed without error. Missing files count as successful cleanup. False means these files were not removed at event time. Private transcript text and saved subtitle copies are always scheduled for asynchronous cleanup.
     */
    public function withFilesDeleted(bool $filesDeleted): self
    {
        $self = clone $this;
        $self['filesDeleted'] = $filesDeleted;

        return $self;
    }

    /**
     * DeletedSize specifies the recorded generated-file bytes removed with the Asset, including attached outputs. Omitted when cleanup was not requested or the total is unavailable. Missing storage objects still contribute their recorded sizes.
     */
    public function withDeletedSize(int $deletedSize): self
    {
        $self = clone $this;
        $self['deletedSize'] = $deletedSize;

        return $self;
    }
}
