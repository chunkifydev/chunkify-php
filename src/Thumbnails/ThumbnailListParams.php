<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Thumbnails\ThumbnailListParams\Created;
use Chunkify\Thumbnails\ThumbnailListParams\Status;

/**
 * List Thumbnails in the authenticated Project, newest first by default.
 *
 * @see Chunkify\Services\ThumbnailsService::list()
 *
 * @phpstan-import-type CreatedShape from \Chunkify\Thumbnails\ThumbnailListParams\Created
 *
 * @phpstan-type ThumbnailListParamsShape = array{
 *   id?: string|null,
 *   created?: null|Created|CreatedShape,
 *   limit?: int|null,
 *   offset?: int|null,
 *   sourceID?: string|null,
 *   status?: null|Status|value-of<Status>,
 *   storageID?: string|null,
 * }
 */
final class ThumbnailListParams implements BaseModel
{
    /** @use SdkModel<ThumbnailListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Id filters by an exact Thumbnail ID. Omit to include all matching resources.
     */
    #[Optional]
    public ?string $id;

    #[Optional]
    public ?Created $created;

    /**
     * Maximum number of Thumbnails to return.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Number of Thumbnails to skip.
     */
    #[Optional]
    public ?int $offset;

    /**
     * Filter Thumbnails linked to this Source. Omit to include Thumbnails from all Sources in the Project.
     */
    #[Optional]
    public ?string $sourceID;

    /**
     * Filter by Thumbnail status.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Filter by output Storage ID.
     */
    #[Optional]
    public ?string $storageID;

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
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $id = null,
        Created|array|null $created = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $sourceID = null,
        Status|string|null $status = null,
        ?string $storageID = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $created && $self['created'] = $created;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $sourceID && $self['sourceID'] = $sourceID;
        null !== $status && $self['status'] = $status;
        null !== $storageID && $self['storageID'] = $storageID;

        return $self;
    }

    /**
     * Id filters by an exact Thumbnail ID. Omit to include all matching resources.
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
     * Maximum number of Thumbnails to return.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Number of Thumbnails to skip.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * Filter Thumbnails linked to this Source. Omit to include Thumbnails from all Sources in the Project.
     */
    public function withSourceID(string $sourceID): self
    {
        $self = clone $this;
        $self['sourceID'] = $sourceID;

        return $self;
    }

    /**
     * Filter by Thumbnail status.
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
     * Filter by output Storage ID.
     */
    public function withStorageID(string $storageID): self
    {
        $self = clone $this;
        $self['storageID'] = $storageID;

        return $self;
    }
}
