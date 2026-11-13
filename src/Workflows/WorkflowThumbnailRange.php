<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Optional Source-relative sampling boundaries.
 *
 * @phpstan-type WorkflowThumbnailRangeShape = array{
 *   end?: float|null, start?: float|null
 * }
 */
final class WorkflowThumbnailRange implements BaseModel
{
    /** @use SdkModel<WorkflowThumbnailRangeShape> */
    use SdkModel;

    /**
     * End specifies the exclusive upper bound in seconds. Defaults to the Source duration.
     */
    #[Optional]
    public ?float $end;

    /**
     * Start specifies the inclusive lower bound in seconds. Defaults to zero.
     */
    #[Optional]
    public ?float $start;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?float $end = null, ?float $start = null): self
    {
        $self = new self;

        null !== $end && $self['end'] = $end;
        null !== $start && $self['start'] = $start;

        return $self;
    }

    /**
     * End specifies the exclusive upper bound in seconds. Defaults to the Source duration.
     */
    public function withEnd(float $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    /**
     * Start specifies the inclusive lower bound in seconds. Defaults to zero.
     */
    public function withStart(float $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
