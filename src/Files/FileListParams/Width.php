<?php

declare(strict_types=1);

namespace Chunkify\Files\FileListParams;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type WidthShape = array{
 *   eq?: int|null, gt?: int|null, gte?: int|null, lt?: int|null, lte?: int|null
 * }
 */
final class Width implements BaseModel
{
    /** @use SdkModel<WidthShape> */
    use SdkModel;

    /**
     * Filter by exact width.
     */
    #[Optional]
    public ?int $eq;

    /**
     * Filter by width greater than.
     */
    #[Optional]
    public ?int $gt;

    /**
     * Filter by width greater than or equal.
     */
    #[Optional]
    public ?int $gte;

    /**
     * Filter by width less than.
     */
    #[Optional]
    public ?int $lt;

    /**
     * Filter by width less than or equal.
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
     * Filter by exact width.
     */
    public function withEq(int $eq): self
    {
        $self = clone $this;
        $self['eq'] = $eq;

        return $self;
    }

    /**
     * Filter by width greater than.
     */
    public function withGt(int $gt): self
    {
        $self = clone $this;
        $self['gt'] = $gt;

        return $self;
    }

    /**
     * Filter by width greater than or equal.
     */
    public function withGte(int $gte): self
    {
        $self = clone $this;
        $self['gte'] = $gte;

        return $self;
    }

    /**
     * Filter by width less than.
     */
    public function withLt(int $lt): self
    {
        $self = clone $this;
        $self['lt'] = $lt;

        return $self;
    }

    /**
     * Filter by width less than or equal.
     */
    public function withLte(int $lte): self
    {
        $self = clone $this;
        $self['lte'] = $lte;

        return $self;
    }
}
