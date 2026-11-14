<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * A timed passage of recognized speech. Times are seconds from the start of the Asset.
 *
 * @phpstan-type AssetTranscriptSegmentShape = array{
 *   end: float, start: float, text: string
 * }
 */
final class AssetTranscriptSegment implements BaseModel
{
    /** @use SdkModel<AssetTranscriptSegmentShape> */
    use SdkModel;

    /**
     * End specifies the passage end time in seconds.
     */
    #[Required]
    public float $end;

    /**
     * Start specifies the passage start time in seconds.
     */
    #[Required]
    public float $start;

    /**
     * Text contains the recognized passage, including punctuation.
     */
    #[Required]
    public string $text;

    /**
     * `new AssetTranscriptSegment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetTranscriptSegment::with(end: ..., start: ..., text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetTranscriptSegment)->withEnd(...)->withStart(...)->withText(...)
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
    public static function with(float $end, float $start, string $text): self
    {
        $self = new self;

        $self['end'] = $end;
        $self['start'] = $start;
        $self['text'] = $text;

        return $self;
    }

    /**
     * End specifies the passage end time in seconds.
     */
    public function withEnd(float $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    /**
     * Start specifies the passage start time in seconds.
     */
    public function withStart(float $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }

    /**
     * Text contains the recognized passage, including punctuation.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
