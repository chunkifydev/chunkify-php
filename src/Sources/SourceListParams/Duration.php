<?php

declare(strict_types=1);

namespace Chunkify\Sources\SourceListParams;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type DurationShape = array{
 *   eq?: float|null,
 *   gt?: float|null,
 *   gte?: float|null,
 *   lt?: float|null,
 *   lte?: float|null,
 * }
 */
final class Duration implements BaseModel
{
    /** @use SdkModel<DurationShape> */
    use SdkModel;

    /**
     * Filter by exact duration.
     */
    #[Optional]
    public ?float $eq;

    /**
     * Filter by duration greater than.
     */
    #[Optional]
    public ?float $gt;

    /**
     * Filter by duration greater than or equal.
     */
    #[Optional]
    public ?float $gte;

    /**
     * Filter by duration less than.
     */
    #[Optional]
    public ?float $lt;

    /**
     * Filter by duration less than or equal.
     */
    #[Optional]
    public ?float $lte;

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
        ?float $eq = null,
        ?float $gt = null,
        ?float $gte = null,
        ?float $lt = null,
        ?float $lte = null,
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
     * Filter by exact duration.
     */
    public function withEq(float $eq): self
    {
        $self = clone $this;
        $self['eq'] = $eq;

        return $self;
    }

    /**
     * Filter by duration greater than.
     */
    public function withGt(float $gt): self
    {
        $self = clone $this;
        $self['gt'] = $gt;

        return $self;
    }

    /**
     * Filter by duration greater than or equal.
     */
    public function withGte(float $gte): self
    {
        $self = clone $this;
        $self['gte'] = $gte;

        return $self;
    }

    /**
     * Filter by duration less than.
     */
    public function withLt(float $lt): self
    {
        $self = clone $this;
        $self['lt'] = $lt;

        return $self;
    }

    /**
     * Filter by duration less than or equal.
     */
    public function withLte(float $lte): self
    {
        $self = clone $this;
        $self['lte'] = $lte;

        return $self;
    }
}
