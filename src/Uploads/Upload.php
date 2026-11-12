<?php

declare(strict_types=1);

namespace Chunkify\Uploads;

use Chunkify\ChunkifyError;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Uploads\Upload\CreatedVia;
use Chunkify\Uploads\Upload\Multipart;
use Chunkify\Uploads\Upload\Status;
use Chunkify\Uploads\Upload\UploadMode;

/**
 * @phpstan-import-type ChunkifyErrorShape from \Chunkify\ChunkifyError
 * @phpstan-import-type MultipartShape from \Chunkify\Uploads\Upload\Multipart
 *
 * @phpstan-type UploadShape = array{
 *   id: string,
 *   createAsset: bool,
 *   createdAt: \DateTimeInterface,
 *   expiresAt: \DateTimeInterface,
 *   status: Status|value-of<Status>,
 *   updatedAt: \DateTimeInterface,
 *   uploadMode: UploadMode|value-of<UploadMode>,
 *   workflowID: string|null,
 *   workflowRevision: int|null,
 *   assetID?: string|null,
 *   completionURL?: string|null,
 *   createdByTokenID?: string|null,
 *   createdByUserID?: string|null,
 *   createdVia?: null|CreatedVia|value-of<CreatedVia>,
 *   error?: null|ChunkifyError|ChunkifyErrorShape,
 *   fileSizeBytes?: int|null,
 *   metadata?: array<string,string>|null,
 *   multipart?: null|Multipart|MultipartShape,
 *   sourceID?: string|null,
 *   storageID?: string|null,
 *   uploadURL?: string|null,
 * }
 */
final class Upload implements BaseModel
{
    /** @use SdkModel<UploadShape> */
    use SdkModel;

    /**
     * Unique identifier of the upload.
     */
    #[Required]
    public string $id;

    /**
     * Whether this Upload creates an Asset on completion.
     */
    #[Required('create_asset')]
    public bool $createAsset;

    /**
     * Timestamp when the upload was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Timestamp when the upload will expire.
     */
    #[Required('expires_at')]
    public \DateTimeInterface $expiresAt;

    /**
     * Current status of the upload.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Timestamp when the upload was updated.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Resolved transfer mode for this Upload.
     *
     * @var value-of<UploadMode> $uploadMode
     */
    #[Required('upload_mode', enum: UploadMode::class)]
    public string $uploadMode;

    /**
     * Selected Workflow ID, or null.
     */
    #[Required('workflow_id')]
    public ?string $workflowID;

    /**
     * Pinned Workflow revision, or null.
     */
    #[Required('workflow_revision')]
    public ?int $workflowRevision;

    /**
     * Automatically created Asset. May be absent before completion or after record deletion.
     */
    #[Optional('asset_id')]
    public ?string $assetID;

    /**
     * Completion capability, returned only on creation. POST after a successful single PUT or with all multipart ETags before expires_at. Requires no API key. Repeated valid calls are idempotent.
     */
    #[Optional('completion_url')]
    public ?string $completionURL;

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
     * Error message of the upload.
     */
    #[Optional]
    public ?ChunkifyError $error;

    /**
     * Declared file size in bytes, when supplied at creation.
     */
    #[Optional('file_size_bytes')]
    public ?int $fileSizeBytes;

    /**
     * Additional metadata for the upload.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * Multipart transfer details, returned only on creation for multipart Uploads.
     */
    #[Optional]
    public ?Multipart $multipart;

    /**
     * SourceId is the id of the source that was created from the upload.
     */
    #[Optional('source_id')]
    public ?string $sourceID;

    /**
     * Resolved Storage selected when the Upload was created. Absent for historical uploads.
     */
    #[Optional('storage_id')]
    public ?string $storageID;

    /**
     * Presigned PUT URL, returned only when creating a single-PUT Upload session. Call completion_url after the PUT succeeds.
     */
    #[Optional('upload_url')]
    public ?string $uploadURL;

    /**
     * `new Upload()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Upload::with(
     *   id: ...,
     *   createAsset: ...,
     *   createdAt: ...,
     *   expiresAt: ...,
     *   status: ...,
     *   updatedAt: ...,
     *   uploadMode: ...,
     *   workflowID: ...,
     *   workflowRevision: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Upload)
     *   ->withID(...)
     *   ->withCreateAsset(...)
     *   ->withCreatedAt(...)
     *   ->withExpiresAt(...)
     *   ->withStatus(...)
     *   ->withUpdatedAt(...)
     *   ->withUploadMode(...)
     *   ->withWorkflowID(...)
     *   ->withWorkflowRevision(...)
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
     * @param Status|value-of<Status> $status
     * @param UploadMode|value-of<UploadMode> $uploadMode
     * @param CreatedVia|value-of<CreatedVia>|null $createdVia
     * @param ChunkifyError|ChunkifyErrorShape|null $error
     * @param array<string,string>|null $metadata
     * @param Multipart|MultipartShape|null $multipart
     */
    public static function with(
        string $id,
        bool $createAsset,
        \DateTimeInterface $createdAt,
        \DateTimeInterface $expiresAt,
        Status|string $status,
        \DateTimeInterface $updatedAt,
        UploadMode|string $uploadMode,
        ?string $workflowID,
        ?int $workflowRevision,
        ?string $assetID = null,
        ?string $completionURL = null,
        ?string $createdByTokenID = null,
        ?string $createdByUserID = null,
        CreatedVia|string|null $createdVia = null,
        ChunkifyError|array|null $error = null,
        ?int $fileSizeBytes = null,
        ?array $metadata = null,
        Multipart|array|null $multipart = null,
        ?string $sourceID = null,
        ?string $storageID = null,
        ?string $uploadURL = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createAsset'] = $createAsset;
        $self['createdAt'] = $createdAt;
        $self['expiresAt'] = $expiresAt;
        $self['status'] = $status;
        $self['updatedAt'] = $updatedAt;
        $self['uploadMode'] = $uploadMode;
        $self['workflowID'] = $workflowID;
        $self['workflowRevision'] = $workflowRevision;

        null !== $assetID && $self['assetID'] = $assetID;
        null !== $completionURL && $self['completionURL'] = $completionURL;
        null !== $createdByTokenID && $self['createdByTokenID'] = $createdByTokenID;
        null !== $createdByUserID && $self['createdByUserID'] = $createdByUserID;
        null !== $createdVia && $self['createdVia'] = $createdVia;
        null !== $error && $self['error'] = $error;
        null !== $fileSizeBytes && $self['fileSizeBytes'] = $fileSizeBytes;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $multipart && $self['multipart'] = $multipart;
        null !== $sourceID && $self['sourceID'] = $sourceID;
        null !== $storageID && $self['storageID'] = $storageID;
        null !== $uploadURL && $self['uploadURL'] = $uploadURL;

        return $self;
    }

    /**
     * Unique identifier of the upload.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Whether this Upload creates an Asset on completion.
     */
    public function withCreateAsset(bool $createAsset): self
    {
        $self = clone $this;
        $self['createAsset'] = $createAsset;

        return $self;
    }

    /**
     * Timestamp when the upload was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Timestamp when the upload will expire.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Current status of the upload.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Timestamp when the upload was updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Resolved transfer mode for this Upload.
     *
     * @param UploadMode|value-of<UploadMode> $uploadMode
     */
    public function withUploadMode(UploadMode|string $uploadMode): self
    {
        $self = clone $this;
        $self['uploadMode'] = $uploadMode;

        return $self;
    }

    /**
     * Selected Workflow ID, or null.
     */
    public function withWorkflowID(?string $workflowID): self
    {
        $self = clone $this;
        $self['workflowID'] = $workflowID;

        return $self;
    }

    /**
     * Pinned Workflow revision, or null.
     */
    public function withWorkflowRevision(?int $workflowRevision): self
    {
        $self = clone $this;
        $self['workflowRevision'] = $workflowRevision;

        return $self;
    }

    /**
     * Automatically created Asset. May be absent before completion or after record deletion.
     */
    public function withAssetID(string $assetID): self
    {
        $self = clone $this;
        $self['assetID'] = $assetID;

        return $self;
    }

    /**
     * Completion capability, returned only on creation. POST after a successful single PUT or with all multipart ETags before expires_at. Requires no API key. Repeated valid calls are idempotent.
     */
    public function withCompletionURL(string $completionURL): self
    {
        $self = clone $this;
        $self['completionURL'] = $completionURL;

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
     * Error message of the upload.
     *
     * @param ChunkifyError|ChunkifyErrorShape $error
     */
    public function withError(ChunkifyError|array $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Declared file size in bytes, when supplied at creation.
     */
    public function withFileSizeBytes(int $fileSizeBytes): self
    {
        $self = clone $this;
        $self['fileSizeBytes'] = $fileSizeBytes;

        return $self;
    }

    /**
     * Additional metadata for the upload.
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
     * Multipart transfer details, returned only on creation for multipart Uploads.
     *
     * @param Multipart|MultipartShape $multipart
     */
    public function withMultipart(Multipart|array $multipart): self
    {
        $self = clone $this;
        $self['multipart'] = $multipart;

        return $self;
    }

    /**
     * SourceId is the id of the source that was created from the upload.
     */
    public function withSourceID(string $sourceID): self
    {
        $self = clone $this;
        $self['sourceID'] = $sourceID;

        return $self;
    }

    /**
     * Resolved Storage selected when the Upload was created. Absent for historical uploads.
     */
    public function withStorageID(string $storageID): self
    {
        $self = clone $this;
        $self['storageID'] = $storageID;

        return $self;
    }

    /**
     * Presigned PUT URL, returned only when creating a single-PUT Upload session. Call completion_url after the PUT succeeds.
     */
    public function withUploadURL(string $uploadURL): self
    {
        $self = clone $this;
        $self['uploadURL'] = $uploadURL;

        return $self;
    }
}
