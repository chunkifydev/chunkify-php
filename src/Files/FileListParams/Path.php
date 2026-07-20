<?php

declare(strict_types=1);

namespace Chunkify\Files\FileListParams;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type PathShape = array{eq?: string|null, ilike?: string|null}
 */
final class Path implements BaseModel
{
    /** @use SdkModel<PathShape> */
    use SdkModel;

    /**
     * Filter by path.
     */
    #[Optional]
    public ?string $eq;

    /**
     * Filter by path (case insensitive).
     */
    #[Optional]
    public ?string $ilike;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $eq = null, ?string $ilike = null): self
    {
        $self = new self;

        null !== $eq && $self['eq'] = $eq;
        null !== $ilike && $self['ilike'] = $ilike;

        return $self;
    }

    /**
     * Filter by path.
     */
    public function withEq(string $eq): self
    {
        $self = clone $this;
        $self['eq'] = $eq;

        return $self;
    }

    /**
     * Filter by path (case insensitive).
     */
    public function withIlike(string $ilike): self
    {
        $self = clone $this;
        $self['ilike'] = $ilike;

        return $self;
    }
}
