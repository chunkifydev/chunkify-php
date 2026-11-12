<?php

declare(strict_types=1);

namespace Chunkify\Assets\AssetListParams;

use Chunkify\Assets\AssetListParams\Created\Sort;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type CreatedShape = array{
 *   gte?: int|null, lte?: int|null, sort?: null|Sort|value-of<Sort>
 * }
 */
final class Created implements BaseModel
{
    /** @use SdkModel<CreatedShape> */
    use SdkModel;

    /**
     * Created at or after this Unix timestamp in seconds.
     */
    #[Optional]
    public ?int $gte;

    /**
     * Created at or before this Unix timestamp in seconds.
     */
    #[Optional]
    public ?int $lte;

    /**
     * Creation-time ordering. Defaults to newest first.
     *
     * @var value-of<Sort>|null $sort
     */
    #[Optional(enum: Sort::class)]
    public ?string $sort;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Sort|value-of<Sort>|null $sort
     */
    public static function with(
        ?int $gte = null,
        ?int $lte = null,
        Sort|string|null $sort = null
    ): self {
        $self = new self;

        null !== $gte && $self['gte'] = $gte;
        null !== $lte && $self['lte'] = $lte;
        null !== $sort && $self['sort'] = $sort;

        return $self;
    }

    /**
     * Created at or after this Unix timestamp in seconds.
     */
    public function withGte(int $gte): self
    {
        $self = clone $this;
        $self['gte'] = $gte;

        return $self;
    }

    /**
     * Created at or before this Unix timestamp in seconds.
     */
    public function withLte(int $lte): self
    {
        $self = clone $this;
        $self['lte'] = $lte;

        return $self;
    }

    /**
     * Creation-time ordering. Defaults to newest first.
     *
     * @param Sort|value-of<Sort> $sort
     */
    public function withSort(Sort|string $sort): self
    {
        $self = clone $this;
        $self['sort'] = $sort;

        return $self;
    }
}
