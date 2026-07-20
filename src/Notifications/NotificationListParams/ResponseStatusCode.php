<?php

declare(strict_types=1);

namespace Chunkify\Notifications\NotificationListParams;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type ResponseStatusCodeShape = array{
 *   eq?: int|null, gte?: int|null, lte?: int|null
 * }
 */
final class ResponseStatusCode implements BaseModel
{
    /** @use SdkModel<ResponseStatusCodeShape> */
    use SdkModel;

    /**
     * Filter by exact response status code.
     */
    #[Optional]
    public ?int $eq;

    /**
     * Filter by response status code greater than or equal.
     */
    #[Optional]
    public ?int $gte;

    /**
     * Filter by response status code less than or equal.
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
        ?int $gte = null,
        ?int $lte = null
    ): self {
        $self = new self;

        null !== $eq && $self['eq'] = $eq;
        null !== $gte && $self['gte'] = $gte;
        null !== $lte && $self['lte'] = $lte;

        return $self;
    }

    /**
     * Filter by exact response status code.
     */
    public function withEq(int $eq): self
    {
        $self = clone $this;
        $self['eq'] = $eq;

        return $self;
    }

    /**
     * Filter by response status code greater than or equal.
     */
    public function withGte(int $gte): self
    {
        $self = clone $this;
        $self['gte'] = $gte;

        return $self;
    }

    /**
     * Filter by response status code less than or equal.
     */
    public function withLte(int $lte): self
    {
        $self = clone $this;
        $self['lte'] = $lte;

        return $self;
    }
}
