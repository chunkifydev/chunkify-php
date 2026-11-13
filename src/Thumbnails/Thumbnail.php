<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\CreatedVia;

/**
 * One thumbnail generation request. At least one sample and its companion files must be published before the resource is ready.
 *
 * @phpstan-import-type ThumbnailFileShape from \Chunkify\Thumbnails\ThumbnailFile
 * @phpstan-import-type ThumbnailSampleShape from \Chunkify\Thumbnails\ThumbnailSample
 * @phpstan-import-type ThumbnailSettingsShape from \Chunkify\Thumbnails\ThumbnailSettings
 * @phpstan-import-type ThumbnailErrorShape from \Chunkify\Thumbnails\ThumbnailError
 *
 * @phpstan-type ThumbnailShape = array{
 *   id: string,
 *   assetID: string|null,
 *   createdAt: \DateTimeInterface,
 *   files: list<ThumbnailFile|ThumbnailFileShape>,
 *   metadata: array<string,string>,
 *   samples: list<ThumbnailSample|ThumbnailSampleShape>,
 *   settings: ThumbnailSettings|ThumbnailSettingsShape,
 *   sourceID: string|null,
 *   status: ThumbnailStatus|value-of<ThumbnailStatus>,
 *   storageID: string,
 *   storagePath: string|null,
 *   storagePrefix: string,
 *   updatedAt: \DateTimeInterface,
 *   createdByTokenID?: string|null,
 *   createdByUserID?: string|null,
 *   createdVia?: null|CreatedVia|value-of<CreatedVia>,
 *   deleteAt?: \DateTimeInterface|null,
 *   error?: null|ThumbnailError|ThumbnailErrorShape,
 *   expiresAt?: \DateTimeInterface|null,
 *   readyAt?: \DateTimeInterface|null,
 * }
 */
final class Thumbnail implements BaseModel
{
    /** @use SdkModel<ThumbnailShape> */
    use SdkModel;

    /**
     * Id identifies this thumbnail request. Standalone requests use thm_ IDs; Asset-owned outputs use aop_ IDs.
     */
    #[Required]
    public string $id;

    /**
     * AssetId identifies the owning Asset for Workflow outputs, or null for standalone requests.
     */
    #[Required('asset_id')]
    public ?string $assetID;

    /**
     * CreatedAt records when the request was accepted.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Files contains all published images or sheets and the WebVTT index. Empty while preparing.
     *
     * @var list<ThumbnailFile> $files
     */
    #[Required(list: ThumbnailFile::class)]
    public array $files;

    /**
     * Metadata contains the accepted string metadata.
     *
     * @var array<string,string> $metadata
     */
    #[Required(map: 'string')]
    public array $metadata;

    /**
     * Samples contains published thumbnails ordered by timestamp. Empty while preparing. A ready resource may contain fewer samples than requested.
     *
     * @var list<ThumbnailSample> $samples
     */
    #[Required(list: ThumbnailSample::class)]
    public array $samples;

    /**
     * Settings contains the accepted sampling and output settings.
     */
    #[Required]
    public ThumbnailSettings $settings;

    /**
     * SourceId identifies the input Source, or null if it has been deleted.
     */
    #[Required('source_id')]
    public ?string $sourceID;

    /**
     * Status reports processing or output expiry.
     *
     * @var value-of<ThumbnailStatus> $status
     */
    #[Required(enum: ThumbnailStatus::class)]
    public string $status;

    /**
     * StorageId identifies the accepted output Storage.
     */
    #[Required('storage_id')]
    public string $storageID;

    /**
     * StoragePath specifies the accepted filename template relative to the Storage base_prefix, or null when Chunkify generated the file names.
     */
    #[Required('storage_path')]
    public ?string $storagePath;

    /**
     * StoragePrefix specifies the complete output folder saved at creation. File and sample paths are relative to this folder.
     */
    #[Required('storage_prefix')]
    public string $storagePrefix;

    /**
     * UpdatedAt records the last lifecycle update.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * CreatedByTokenId specifies the Project token used to create the resource. It remains set after the token is revoked.
     * Omitted for dashboard requests, MCP OAuth connections, Workflow actions, and unknown creators.
     */
    #[Optional('created_by_token_id')]
    public ?string $createdByTokenID;

    /**
     * CreatedByUserId specifies the team member who created the resource.
     * Omitted for Workflow actions, unknown creators, and deleted accounts.
     */
    #[Optional('created_by_user_id')]
    public ?string $createdByUserID;

    /**
     * CreatedVia specifies how the resource was created: api for API requests, dashboard for the Chunkify dashboard, mcp for MCP clients, and workflow for Workflow actions.
     * Omitted when the creator is unknown.
     *
     * @var value-of<CreatedVia>|null $createdVia
     */
    #[Optional('created_via', enum: CreatedVia::class)]
    public ?string $createdVia;

    /**
     * DeleteAt specifies when this standalone request is deleted: three days after its temporary output expires, otherwise when the team's data retention period ends, counted from when the request was accepted, and no sooner than three days after it finished. It does not delete files in customer-owned Storage. Omitted while preparing and for Asset-owned thumbnails, which follow their Asset.
     */
    #[Optional('delete_at')]
    public ?\DateTimeInterface $deleteAt;

    /**
     * Error explains a failed request. Omitted otherwise.
     */
    #[Optional]
    public ?ThumbnailError $error;

    /**
     * ExpiresAt specifies when temporary output files expire. Omitted for customer output Storage.
     */
    #[Optional('expires_at')]
    public ?\DateTimeInterface $expiresAt;

    /**
     * ReadyAt records when the complete available set was published. Omitted before publication.
     */
    #[Optional('ready_at')]
    public ?\DateTimeInterface $readyAt;

    /**
     * `new Thumbnail()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Thumbnail::with(
     *   id: ...,
     *   assetID: ...,
     *   createdAt: ...,
     *   files: ...,
     *   metadata: ...,
     *   samples: ...,
     *   settings: ...,
     *   sourceID: ...,
     *   status: ...,
     *   storageID: ...,
     *   storagePath: ...,
     *   storagePrefix: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Thumbnail)
     *   ->withID(...)
     *   ->withAssetID(...)
     *   ->withCreatedAt(...)
     *   ->withFiles(...)
     *   ->withMetadata(...)
     *   ->withSamples(...)
     *   ->withSettings(...)
     *   ->withSourceID(...)
     *   ->withStatus(...)
     *   ->withStorageID(...)
     *   ->withStoragePath(...)
     *   ->withStoragePrefix(...)
     *   ->withUpdatedAt(...)
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
     * @param list<ThumbnailFile|ThumbnailFileShape> $files
     * @param array<string,string> $metadata
     * @param list<ThumbnailSample|ThumbnailSampleShape> $samples
     * @param ThumbnailSettings|ThumbnailSettingsShape $settings
     * @param ThumbnailStatus|value-of<ThumbnailStatus> $status
     * @param CreatedVia|value-of<CreatedVia>|null $createdVia
     * @param ThumbnailError|ThumbnailErrorShape|null $error
     */
    public static function with(
        string $id,
        ?string $assetID,
        \DateTimeInterface $createdAt,
        array $files,
        array $metadata,
        array $samples,
        ThumbnailSettings|array $settings,
        ?string $sourceID,
        ThumbnailStatus|string $status,
        string $storageID,
        ?string $storagePath,
        string $storagePrefix,
        \DateTimeInterface $updatedAt,
        ?string $createdByTokenID = null,
        ?string $createdByUserID = null,
        CreatedVia|string|null $createdVia = null,
        ?\DateTimeInterface $deleteAt = null,
        ThumbnailError|array|null $error = null,
        ?\DateTimeInterface $expiresAt = null,
        ?\DateTimeInterface $readyAt = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['assetID'] = $assetID;
        $self['createdAt'] = $createdAt;
        $self['files'] = $files;
        $self['metadata'] = $metadata;
        $self['samples'] = $samples;
        $self['settings'] = $settings;
        $self['sourceID'] = $sourceID;
        $self['status'] = $status;
        $self['storageID'] = $storageID;
        $self['storagePath'] = $storagePath;
        $self['storagePrefix'] = $storagePrefix;
        $self['updatedAt'] = $updatedAt;

        null !== $createdByTokenID && $self['createdByTokenID'] = $createdByTokenID;
        null !== $createdByUserID && $self['createdByUserID'] = $createdByUserID;
        null !== $createdVia && $self['createdVia'] = $createdVia;
        null !== $deleteAt && $self['deleteAt'] = $deleteAt;
        null !== $error && $self['error'] = $error;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $readyAt && $self['readyAt'] = $readyAt;

        return $self;
    }

    /**
     * Id identifies this thumbnail request. Standalone requests use thm_ IDs; Asset-owned outputs use aop_ IDs.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * AssetId identifies the owning Asset for Workflow outputs, or null for standalone requests.
     */
    public function withAssetID(?string $assetID): self
    {
        $self = clone $this;
        $self['assetID'] = $assetID;

        return $self;
    }

    /**
     * CreatedAt records when the request was accepted.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Files contains all published images or sheets and the WebVTT index. Empty while preparing.
     *
     * @param list<ThumbnailFile|ThumbnailFileShape> $files
     */
    public function withFiles(array $files): self
    {
        $self = clone $this;
        $self['files'] = $files;

        return $self;
    }

    /**
     * Metadata contains the accepted string metadata.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Samples contains published thumbnails ordered by timestamp. Empty while preparing. A ready resource may contain fewer samples than requested.
     *
     * @param list<ThumbnailSample|ThumbnailSampleShape> $samples
     */
    public function withSamples(array $samples): self
    {
        $self = clone $this;
        $self['samples'] = $samples;

        return $self;
    }

    /**
     * Settings contains the accepted sampling and output settings.
     *
     * @param ThumbnailSettings|ThumbnailSettingsShape $settings
     */
    public function withSettings(ThumbnailSettings|array $settings): self
    {
        $self = clone $this;
        $self['settings'] = $settings;

        return $self;
    }

    /**
     * SourceId identifies the input Source, or null if it has been deleted.
     */
    public function withSourceID(?string $sourceID): self
    {
        $self = clone $this;
        $self['sourceID'] = $sourceID;

        return $self;
    }

    /**
     * Status reports processing or output expiry.
     *
     * @param ThumbnailStatus|value-of<ThumbnailStatus> $status
     */
    public function withStatus(ThumbnailStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * StorageId identifies the accepted output Storage.
     */
    public function withStorageID(string $storageID): self
    {
        $self = clone $this;
        $self['storageID'] = $storageID;

        return $self;
    }

    /**
     * StoragePath specifies the accepted filename template relative to the Storage base_prefix, or null when Chunkify generated the file names.
     */
    public function withStoragePath(?string $storagePath): self
    {
        $self = clone $this;
        $self['storagePath'] = $storagePath;

        return $self;
    }

    /**
     * StoragePrefix specifies the complete output folder saved at creation. File and sample paths are relative to this folder.
     */
    public function withStoragePrefix(string $storagePrefix): self
    {
        $self = clone $this;
        $self['storagePrefix'] = $storagePrefix;

        return $self;
    }

    /**
     * UpdatedAt records the last lifecycle update.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * CreatedByTokenId specifies the Project token used to create the resource. It remains set after the token is revoked.
     * Omitted for dashboard requests, MCP OAuth connections, Workflow actions, and unknown creators.
     */
    public function withCreatedByTokenID(string $createdByTokenID): self
    {
        $self = clone $this;
        $self['createdByTokenID'] = $createdByTokenID;

        return $self;
    }

    /**
     * CreatedByUserId specifies the team member who created the resource.
     * Omitted for Workflow actions, unknown creators, and deleted accounts.
     */
    public function withCreatedByUserID(string $createdByUserID): self
    {
        $self = clone $this;
        $self['createdByUserID'] = $createdByUserID;

        return $self;
    }

    /**
     * CreatedVia specifies how the resource was created: api for API requests, dashboard for the Chunkify dashboard, mcp for MCP clients, and workflow for Workflow actions.
     * Omitted when the creator is unknown.
     *
     * @param CreatedVia|value-of<CreatedVia> $createdVia
     */
    public function withCreatedVia(CreatedVia|string $createdVia): self
    {
        $self = clone $this;
        $self['createdVia'] = $createdVia;

        return $self;
    }

    /**
     * DeleteAt specifies when this standalone request is deleted: three days after its temporary output expires, otherwise when the team's data retention period ends, counted from when the request was accepted, and no sooner than three days after it finished. It does not delete files in customer-owned Storage. Omitted while preparing and for Asset-owned thumbnails, which follow their Asset.
     */
    public function withDeleteAt(\DateTimeInterface $deleteAt): self
    {
        $self = clone $this;
        $self['deleteAt'] = $deleteAt;

        return $self;
    }

    /**
     * Error explains a failed request. Omitted otherwise.
     *
     * @param ThumbnailError|ThumbnailErrorShape $error
     */
    public function withError(ThumbnailError|array $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * ExpiresAt specifies when temporary output files expire. Omitted for customer output Storage.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * ReadyAt records when the complete available set was published. Omitted before publication.
     */
    public function withReadyAt(\DateTimeInterface $readyAt): self
    {
        $self = clone $this;
        $self['readyAt'] = $readyAt;

        return $self;
    }
}
