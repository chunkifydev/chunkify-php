<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails\Thumbnail\Settings;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Range contains the accepted sampling boundaries.
 *
 * @phpstan-type RangeShape = array{end: float, start: float}
 */
final class Range implements BaseModel
{
    /** @use SdkModel<RangeShape> */
    use SdkModel;

    /**
     * End specifies the exclusive upper bound in seconds.
     */
    #[Required]
    public float $end;

    /**
     * Start specifies the inclusive lower bound in seconds.
     */
    #[Required]
    public float $start;

    /**
     * `new Range()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Range::with(end: ..., start: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Range)->withEnd(...)->withStart(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(float $end, float $start): self
    {
        $self = new self;

        $self['end'] = $end;
        $self['start'] = $start;

        return $self;
    }

    /**
     * End specifies the exclusive upper bound in seconds.
     */
    public function withEnd(float $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    /**
     * Start specifies the inclusive lower bound in seconds.
     */
    public function withStart(float $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
