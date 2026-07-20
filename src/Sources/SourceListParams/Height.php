<?php

declare(strict_types=1);

namespace Chunkify\Sources\SourceListParams;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type HeightShape = array{
 *   eq?: int|null, gt?: int|null, gte?: int|null, lt?: int|null, lte?: int|null
 * }
 */
final class Height implements BaseModel
{
    /** @use SdkModel<HeightShape> */
    use SdkModel;

    /**
     * Filter by exact height.
     */
    #[Optional]
    public ?int $eq;

    /**
     * Filter by height greater than.
     */
    #[Optional]
    public ?int $gt;

    /**
     * Filter by height greater than or equal.
     */
    #[Optional]
    public ?int $gte;

    /**
     * Filter by height less than.
     */
    #[Optional]
    public ?int $lt;

    /**
     * Filter by height less than or equal.
     */
    #[Optional]
    public ?int $lte;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?int $eq = null,
        ?int $gt = null,
        ?int $gte = null,
        ?int $lt = null,
        ?int $lte = null,
    ): self {
        $self = new self;

        null !== $eq && $self['eq'] = $eq;
        null !== $gt && $self['gt'] = $gt;
        null !== $gte && $self['gte'] = $gte;
        null !== $lt && $self['lt'] = $lt;
        null !== $lte && $self['lte'] = $lte;

        return $self;
    }

    /**
     * Filter by exact height.
     */
    public function withEq(int $eq): self
    {
        $self = clone $this;
        $self['eq'] = $eq;

        return $self;
    }

    /**
     * Filter by height greater than.
     */
    public function withGt(int $gt): self
    {
        $self = clone $this;
        $self['gt'] = $gt;

        return $self;
    }

    /**
     * Filter by height greater than or equal.
     */
    public function withGte(int $gte): self
    {
        $self = clone $this;
        $self['gte'] = $gte;

        return $self;
    }

    /**
     * Filter by height less than.
     */
    public function withLt(int $lt): self
    {
        $self = clone $this;
        $self['lt'] = $lt;

        return $self;
    }

    /**
     * Filter by height less than or equal.
     */
    public function withLte(int $lte): self
    {
        $self = clone $this;
        $self['lte'] = $lte;

        return $self;
    }
}
