<?php

declare(strict_types=1);

namespace Chunkify\Sources\SourceListParams;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Sources\SourceListParams\Created\Sort;

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
     * Filter by creation date greater than or equal (UNIX epoch time).
     */
    #[Optional]
    public ?int $gte;

    /**
     * Filter by creation date less than or equal (UNIX epoch time).
     */
    #[Optional]
    public ?int $lte;

    /**
     * Sort by creation date (asc/desc).
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
     * Filter by creation date greater than or equal (UNIX epoch time).
     */
    public function withGte(int $gte): self
    {
        $self = clone $this;
        $self['gte'] = $gte;

        return $self;
    }

    /**
     * Filter by creation date less than or equal (UNIX epoch time).
     */
    public function withLte(int $lte): self
    {
        $self = clone $this;
        $self['lte'] = $lte;

        return $self;
    }

    /**
     * Sort by creation date (asc/desc).
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
