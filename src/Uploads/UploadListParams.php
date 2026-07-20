<?php

declare(strict_types=1);

namespace Chunkify\Uploads;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Core\Conversion\ListOf;
use Chunkify\Uploads\UploadListParams\Created;
use Chunkify\Uploads\UploadListParams\Status;

/**
 * Retrieve a list of all uploads with optional filtering and pagination.
 *
 * @see Chunkify\Services\UploadsService::list()
 *
 * @phpstan-import-type CreatedShape from \Chunkify\Uploads\UploadListParams\Created
 *
 * @phpstan-type UploadListParamsShape = array{
 *   id?: string|null,
 *   created?: null|Created|CreatedShape,
 *   limit?: int|null,
 *   metadata?: list<list<string>>|null,
 *   offset?: int|null,
 *   sourceID?: string|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class UploadListParams implements BaseModel
{
    /** @use SdkModel<UploadListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by upload ID.
     */
    #[Optional]
    public ?string $id;

    #[Optional]
    public ?Created $created;

    /**
     * Pagination limit (max 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter by metadata.
     *
     * @var list<list<string>>|null $metadata
     */
    #[Optional(list: new ListOf('string'))]
    public ?array $metadata;

    /**
     * Pagination offset.
     */
    #[Optional]
    public ?int $offset;

    /**
     * Filter by source ID.
     */
    #[Optional]
    public ?string $sourceID;

    /**
     * Filter by status (pending, completed, error).
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Created|CreatedShape|null $created
     * @param list<list<string>>|null $metadata
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $id = null,
        Created|array|null $created = null,
        ?int $limit = null,
        ?array $metadata = null,
        ?int $offset = null,
        ?string $sourceID = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $created && $self['created'] = $created;
        null !== $limit && $self['limit'] = $limit;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $offset && $self['offset'] = $offset;
        null !== $sourceID && $self['sourceID'] = $sourceID;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Filter by upload ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * @param Created|CreatedShape $created
     */
    public function withCreated(Created|array $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    /**
     * Pagination limit (max 100).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter by metadata.
     *
     * @param list<list<string>> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Pagination offset.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * Filter by source ID.
     */
    public function withSourceID(string $sourceID): self
    {
        $self = clone $this;
        $self['sourceID'] = $sourceID;

        return $self;
    }

    /**
     * Filter by status (pending, completed, error).
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
