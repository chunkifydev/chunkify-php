<?php

declare(strict_types=1);

namespace Chunkify\Uploads;

use Chunkify\ChunkifyError;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Uploads\Upload\Status;

/**
 * @phpstan-import-type ChunkifyErrorShape from \Chunkify\ChunkifyError
 *
 * @phpstan-type UploadShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   expiresAt: \DateTimeInterface,
 *   status: Status|value-of<Status>,
 *   updatedAt: \DateTimeInterface,
 *   completionURL?: string|null,
 *   error?: null|ChunkifyError|ChunkifyErrorShape,
 *   metadata?: array<string,string>|null,
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
     * Short-lived completion capability, returned only on creation. POST after a successful PUT before expires_at. Requires no API key. Repeated valid calls are idempotent.
     */
    #[Optional('completion_url')]
    public ?string $completionURL;

    /**
     * Error message of the upload.
     */
    #[Optional]
    public ?ChunkifyError $error;

    /**
     * Additional metadata for the upload.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

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
     * Presigned PUT URL, returned only when creating an Upload session. Call completion_url after the PUT succeeds.
     */
    #[Optional('upload_url')]
    public ?string $uploadURL;

    /**
     * `new Upload()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Upload::with(
     *   id: ..., createdAt: ..., expiresAt: ..., status: ..., updatedAt: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Upload)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withExpiresAt(...)
     *   ->withStatus(...)
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
     * @param Status|value-of<Status> $status
     * @param ChunkifyError|ChunkifyErrorShape|null $error
     * @param array<string,string>|null $metadata
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        \DateTimeInterface $expiresAt,
        Status|string $status,
        \DateTimeInterface $updatedAt,
        ?string $completionURL = null,
        ChunkifyError|array|null $error = null,
        ?array $metadata = null,
        ?string $sourceID = null,
        ?string $storageID = null,
        ?string $uploadURL = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['expiresAt'] = $expiresAt;
        $self['status'] = $status;
        $self['updatedAt'] = $updatedAt;

        null !== $completionURL && $self['completionURL'] = $completionURL;
        null !== $error && $self['error'] = $error;
        null !== $metadata && $self['metadata'] = $metadata;
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
     * Short-lived completion capability, returned only on creation. POST after a successful PUT before expires_at. Requires no API key. Repeated valid calls are idempotent.
     */
    public function withCompletionURL(string $completionURL): self
    {
        $self = clone $this;
        $self['completionURL'] = $completionURL;

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
     * Presigned PUT URL, returned only when creating an Upload session. Call completion_url after the PUT succeeds.
     */
    public function withUploadURL(string $uploadURL): self
    {
        $self = clone $this;
        $self['uploadURL'] = $uploadURL;

        return $self;
    }
}
