<?php

declare(strict_types=1);

namespace Chunkify\Transcodings;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Transcodings\TranscodingListParams\Created;

/**
 * List Transcodings in the authenticated Project, newest first by default.
 *
 * @see Chunkify\Services\TranscodingsService::list()
 *
 * @phpstan-import-type CreatedShape from \Chunkify\Transcodings\TranscodingListParams\Created
 *
 * @phpstan-type TranscodingListParamsShape = array{
 *   id?: string|null,
 *   created?: null|Created|CreatedShape,
 *   limit?: int|null,
 *   offset?: int|null,
 *   sourceID?: string|null,
 *   status?: null|TranscodingStatus|value-of<TranscodingStatus>,
 *   storageID?: string|null,
 * }
 */
final class TranscodingListParams implements BaseModel
{
    /** @use SdkModel<TranscodingListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Id filters by an exact Transcoding ID. Omit to include all matching resources.
     */
    #[Optional]
    public ?string $id;

    #[Optional]
    public ?Created $created;

    /**
     * Maximum number of Transcodings to return.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Number of Transcodings to skip.
     */
    #[Optional]
    public ?int $offset;

    /**
     * Filter Transcodings linked to this Source. Omit to include Transcodings from all Sources in the Project.
     */
    #[Optional]
    public ?string $sourceID;

    /**
     * Filter by Transcoding status.
     *
     * @var value-of<TranscodingStatus>|null $status
     */
    #[Optional(enum: TranscodingStatus::class)]
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
     * @param TranscodingStatus|value-of<TranscodingStatus>|null $status
     */
    public static function with(
        ?string $id = null,
        Created|array|null $created = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $sourceID = null,
        TranscodingStatus|string|null $status = null,
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
     * Id filters by an exact Transcoding ID. Omit to include all matching resources.
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
     * Maximum number of Transcodings to return.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Number of Transcodings to skip.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * Filter Transcodings linked to this Source. Omit to include Transcodings from all Sources in the Project.
     */
    public function withSourceID(string $sourceID): self
    {
        $self = clone $this;
        $self['sourceID'] = $sourceID;

        return $self;
    }

    /**
     * Filter by Transcoding status.
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
     * Filter by output Storage ID.
     */
    public function withStorageID(string $storageID): self
    {
        $self = clone $this;
        $self['storageID'] = $storageID;

        return $self;
    }
}
