<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Assets\AssetListParams\Created;
use Chunkify\Assets\AssetListParams\Status;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * List Assets in the Project, with filtering and pagination.
 *
 * @see Chunkify\Services\AssetsService::list()
 *
 * @phpstan-import-type CreatedShape from \Chunkify\Assets\AssetListParams\Created
 *
 * @phpstan-type AssetListParamsShape = array{
 *   created?: null|Created|CreatedShape,
 *   limit?: int|null,
 *   metadata?: list<string>|null,
 *   offset?: int|null,
 *   search?: string|null,
 *   sourceID?: string|null,
 *   status?: null|Status|value-of<Status>,
 *   storageID?: string|null,
 * }
 */
final class AssetListParams implements BaseModel
{
    /** @use SdkModel<AssetListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?Created $created;

    /**
     * Maximum number of Assets to return.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Repeat key:value pairs to match all supplied metadata conditions.
     *
     * @var list<string>|null $metadata
     */
    #[Optional(list: 'string')]
    public ?array $metadata;

    /**
     * Number of Assets to skip.
     */
    #[Optional]
    public ?int $offset;

    /**
     * Case-insensitive search of Asset IDs and titles.
     */
    #[Optional]
    public ?string $search;

    /**
     * Filter Assets linked to this Source. Omit to include Assets from all Sources in the Project.
     */
    #[Optional]
    public ?string $sourceID;

    /**
     * Filter by Asset status.
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
     * @param list<string>|null $metadata
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        Created|array|null $created = null,
        ?int $limit = null,
        ?array $metadata = null,
        ?int $offset = null,
        ?string $search = null,
        ?string $sourceID = null,
        Status|string|null $status = null,
        ?string $storageID = null,
    ): self {
        $self = new self;

        null !== $created && $self['created'] = $created;
        null !== $limit && $self['limit'] = $limit;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $offset && $self['offset'] = $offset;
        null !== $search && $self['search'] = $search;
        null !== $sourceID && $self['sourceID'] = $sourceID;
        null !== $status && $self['status'] = $status;
        null !== $storageID && $self['storageID'] = $storageID;

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
     * Maximum number of Assets to return.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Repeat key:value pairs to match all supplied metadata conditions.
     *
     * @param list<string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Number of Assets to skip.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * Case-insensitive search of Asset IDs and titles.
     */
    public function withSearch(string $search): self
    {
        $self = clone $this;
        $self['search'] = $search;

        return $self;
    }

    /**
     * Filter Assets linked to this Source. Omit to include Assets from all Sources in the Project.
     */
    public function withSourceID(string $sourceID): self
    {
        $self = clone $this;
        $self['sourceID'] = $sourceID;

        return $self;
    }

    /**
     * Filter by Asset status.
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
