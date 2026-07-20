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
 *   uploadURL: string,
 *   error?: null|ChunkifyError|ChunkifyErrorShape,
 *   metadata?: array<string,string>|null,
 *   sourceID?: string|null,
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
     * Pre-signed URL where the file should be uploaded to.
     */
    #[Required('upload_url')]
    public string $uploadURL;

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
     * `new Upload()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Upload::with(
     *   id: ...,
     *   createdAt: ...,
     *   expiresAt: ...,
     *   status: ...,
     *   updatedAt: ...,
     *   uploadURL: ...,
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
     *   ->withUploadURL(...)
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
        string $uploadURL,
        ChunkifyError|array|null $error = null,
        ?array $metadata = null,
        ?string $sourceID = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['expiresAt'] = $expiresAt;
        $self['status'] = $status;
        $self['updatedAt'] = $updatedAt;
        $self['uploadURL'] = $uploadURL;

        null !== $error && $self['error'] = $error;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $sourceID && $self['sourceID'] = $sourceID;

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
     * Pre-signed URL where the file should be uploaded to.
     */
    public function withUploadURL(string $uploadURL): self
    {
        $self = clone $this;
        $self['uploadURL'] = $uploadURL;

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
}
