<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails\ThumbnailCreateParams;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Range limits sampling to part of the Source. Defaults to the whole Source duration.
 *
 * @phpstan-type RangeShape = array{end?: float|null, start?: float|null}
 */
final class Range implements BaseModel
{
    /** @use SdkModel<RangeShape> */
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
