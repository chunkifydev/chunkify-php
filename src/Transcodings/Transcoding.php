<?php

declare(strict_types=1);

namespace Chunkify\Transcodings;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\CreatedVia;

/**
 * A standalone file-encoding request with its accepted settings and published files.
 *
 * @phpstan-import-type TranscodingFileShape from \Chunkify\Transcodings\TranscodingFile
 * @phpstan-import-type TranscodingFormatShape from \Chunkify\Transcodings\TranscodingFormat
 * @phpstan-import-type TranscodingStorageShape from \Chunkify\Transcodings\TranscodingStorage
 * @phpstan-import-type TranscodingErrorShape from \Chunkify\Transcodings\TranscodingError
 *
 * @phpstan-type TranscodingShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   files: list<TranscodingFile|TranscodingFileShape>,
 *   format: TranscodingFormat|TranscodingFormatShape,
 *   metadata: array<string,string>,
 *   status: TranscodingStatus|value-of<TranscodingStatus>,
 *   storage: TranscodingStorage|TranscodingStorageShape,
 *   updatedAt: \DateTimeInterface,
 *   createdByTokenID?: string|null,
 *   createdByUserID?: string|null,
 *   createdVia?: null|CreatedVia|value-of<CreatedVia>,
 *   deleteAt?: \DateTimeInterface|null,
 *   error?: null|TranscodingError|TranscodingErrorShape,
 *   expiresAt?: \DateTimeInterface|null,
 *   processingStage?: null|TranscodingProcessingStage|value-of<TranscodingProcessingStage>,
 *   progress?: float|null,
 *   readyAt?: \DateTimeInterface|null,
 *   sourceID?: string|null,
 * }
 */
final class Transcoding implements BaseModel
{
    /** @use SdkModel<TranscodingShape> */
    use SdkModel;

    /**
     * Id uniquely identifies the Transcoding.
     */
    #[Required]
    public string $id;

    /**
     * CreatedAt specifies when the request was accepted.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Files contains the published output files and their measured properties, ordered by creation time. Empty until publication. Presigned URLs are refreshed on each read and included in lifecycle webhooks when available.
     *
     * @var list<TranscodingFile> $files
     */
    #[Required(list: TranscodingFile::class)]
    public array $files;

    /**
     * Format contains the resolved encoding settings accepted at creation, including defaults, dimensions, frame rate and normalized seek and duration. Per-title rate control is resolved during processing. Measured media properties are available in Files.
     */
    #[Required]
    public TranscodingFormat $format;

    /**
     * Metadata contains the string values attached to the Transcoding.
     *
     * @var array<string,string> $metadata
     */
    #[Required(map: 'string')]
    public array $metadata;

    /**
     * Status reports processing or output expiry.
     *
     * @var value-of<TranscodingStatus> $status
     */
    #[Required(enum: TranscodingStatus::class)]
    public string $status;

    /**
     * Storage contains the resolved output destination.
     */
    #[Required]
    public TranscodingStorage $storage;

    /**
     * UpdatedAt specifies when the request was last updated.
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
     * DeleteAt specifies when this record is deleted: three days after its temporary output expires, otherwise when the team's data retention period ends, counted from when the request was accepted, and no sooner than three days after it finished. It does not delete files in customer-owned Storage. Omitted while the Transcoding is preparing.
     */
    #[Optional('delete_at')]
    public ?\DateTimeInterface $deleteAt;

    /**
     * Error describes why processing failed. Omitted when no processing error exists.
     */
    #[Optional]
    public ?TranscodingError $error;

    /**
     * ExpiresAt specifies when temporary output files expire. Omitted for customer output Storage and before the Transcoding is ready.
     */
    #[Optional('expires_at')]
    public ?\DateTimeInterface $expiresAt;

    /**
     * ProcessingStage specifies the current activity while the status is preparing. Omitted otherwise.
     *
     * @var value-of<TranscodingProcessingStage>|null $processingStage
     */
    #[Optional('processing_stage', enum: TranscodingProcessingStage::class)]
    public ?string $processingStage;

    /**
     * Progress specifies the video encoding percentage. Available once processing starts and after the output is ready. Omitted for audio-only output; 100 requires published output.
     */
    #[Optional]
    public ?float $progress;

    /**
     * ReadyAt specifies when the output was published. Omitted before the Transcoding is ready.
     */
    #[Optional('ready_at')]
    public ?\DateTimeInterface $readyAt;

    /**
     * SourceId identifies the original Source. Omitted after Source deletion.
     */
    #[Optional('source_id')]
    public ?string $sourceID;

    /**
     * `new Transcoding()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Transcoding::with(
     *   id: ...,
     *   createdAt: ...,
     *   files: ...,
     *   format: ...,
     *   metadata: ...,
     *   status: ...,
     *   storage: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Transcoding)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withFiles(...)
     *   ->withFormat(...)
     *   ->withMetadata(...)
     *   ->withStatus(...)
     *   ->withStorage(...)
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
     * @param list<TranscodingFile|TranscodingFileShape> $files
     * @param TranscodingFormat|TranscodingFormatShape $format
     * @param array<string,string> $metadata
     * @param TranscodingStatus|value-of<TranscodingStatus> $status
     * @param TranscodingStorage|TranscodingStorageShape $storage
     * @param CreatedVia|value-of<CreatedVia>|null $createdVia
     * @param TranscodingError|TranscodingErrorShape|null $error
     * @param TranscodingProcessingStage|value-of<TranscodingProcessingStage>|null $processingStage
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        array $files,
        TranscodingFormat|array $format,
        array $metadata,
        TranscodingStatus|string $status,
        TranscodingStorage|array $storage,
        \DateTimeInterface $updatedAt,
        ?string $createdByTokenID = null,
        ?string $createdByUserID = null,
        CreatedVia|string|null $createdVia = null,
        ?\DateTimeInterface $deleteAt = null,
        TranscodingError|array|null $error = null,
        ?\DateTimeInterface $expiresAt = null,
        TranscodingProcessingStage|string|null $processingStage = null,
        ?float $progress = null,
        ?\DateTimeInterface $readyAt = null,
        ?string $sourceID = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['files'] = $files;
        $self['format'] = $format;
        $self['metadata'] = $metadata;
        $self['status'] = $status;
        $self['storage'] = $storage;
        $self['updatedAt'] = $updatedAt;

        null !== $createdByTokenID && $self['createdByTokenID'] = $createdByTokenID;
        null !== $createdByUserID && $self['createdByUserID'] = $createdByUserID;
        null !== $createdVia && $self['createdVia'] = $createdVia;
        null !== $deleteAt && $self['deleteAt'] = $deleteAt;
        null !== $error && $self['error'] = $error;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $processingStage && $self['processingStage'] = $processingStage;
        null !== $progress && $self['progress'] = $progress;
        null !== $readyAt && $self['readyAt'] = $readyAt;
        null !== $sourceID && $self['sourceID'] = $sourceID;

        return $self;
    }

    /**
     * Id uniquely identifies the Transcoding.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * CreatedAt specifies when the request was accepted.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Files contains the published output files and their measured properties, ordered by creation time. Empty until publication. Presigned URLs are refreshed on each read and included in lifecycle webhooks when available.
     *
     * @param list<TranscodingFile|TranscodingFileShape> $files
     */
    public function withFiles(array $files): self
    {
        $self = clone $this;
        $self['files'] = $files;

        return $self;
    }

    /**
     * Format contains the resolved encoding settings accepted at creation, including defaults, dimensions, frame rate and normalized seek and duration. Per-title rate control is resolved during processing. Measured media properties are available in Files.
     *
     * @param TranscodingFormat|TranscodingFormatShape $format
     */
    public function withFormat(TranscodingFormat|array $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Metadata contains the string values attached to the Transcoding.
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
     * Status reports processing or output expiry.
     *
     * @param TranscodingStatus|value-of<TranscodingStatus> $status
     */
    public function withStatus(TranscodingStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Storage contains the resolved output destination.
     *
     * @param TranscodingStorage|TranscodingStorageShape $storage
     */
    public function withStorage(TranscodingStorage|array $storage): self
    {
        $self = clone $this;
        $self['storage'] = $storage;

        return $self;
    }

    /**
     * UpdatedAt specifies when the request was last updated.
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
     * DeleteAt specifies when this record is deleted: three days after its temporary output expires, otherwise when the team's data retention period ends, counted from when the request was accepted, and no sooner than three days after it finished. It does not delete files in customer-owned Storage. Omitted while the Transcoding is preparing.
     */
    public function withDeleteAt(\DateTimeInterface $deleteAt): self
    {
        $self = clone $this;
        $self['deleteAt'] = $deleteAt;

        return $self;
    }

    /**
     * Error describes why processing failed. Omitted when no processing error exists.
     *
     * @param TranscodingError|TranscodingErrorShape $error
     */
    public function withError(TranscodingError|array $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * ExpiresAt specifies when temporary output files expire. Omitted for customer output Storage and before the Transcoding is ready.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * ProcessingStage specifies the current activity while the status is preparing. Omitted otherwise.
     *
     * @param TranscodingProcessingStage|value-of<TranscodingProcessingStage> $processingStage
     */
    public function withProcessingStage(
        TranscodingProcessingStage|string $processingStage
    ): self {
        $self = clone $this;
        $self['processingStage'] = $processingStage;

        return $self;
    }

    /**
     * Progress specifies the video encoding percentage. Available once processing starts and after the output is ready. Omitted for audio-only output; 100 requires published output.
     */
    public function withProgress(float $progress): self
    {
        $self = clone $this;
        $self['progress'] = $progress;

        return $self;
    }

    /**
     * ReadyAt specifies when the output was published. Omitted before the Transcoding is ready.
     */
    public function withReadyAt(\DateTimeInterface $readyAt): self
    {
        $self = clone $this;
        $self['readyAt'] = $readyAt;

        return $self;
    }

    /**
     * SourceId identifies the original Source. Omitted after Source deletion.
     */
    public function withSourceID(string $sourceID): self
    {
        $self = clone $this;
        $self['sourceID'] = $sourceID;

        return $self;
    }
}
