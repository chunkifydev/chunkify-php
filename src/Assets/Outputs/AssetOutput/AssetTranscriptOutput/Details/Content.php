<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs\AssetOutput\AssetTranscriptOutput\Details;

use Chunkify\Assets\Outputs\AssetOutput\AssetTranscriptOutput\Details\Content\Segment;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Content contains the complete text and timed segments. Included when ready; omitted while preparing, failed or expired.
 *
 * @phpstan-import-type SegmentShape from \Chunkify\Assets\Outputs\AssetOutput\AssetTranscriptOutput\Details\Content\Segment
 *
 * @phpstan-type ContentShape = array{
 *   segments: list<Segment|SegmentShape>, text: string
 * }
 */
final class Content implements BaseModel
{
    /** @use SdkModel<ContentShape> */
    use SdkModel;

    /**
     * Segments contains timed passages in chronological order. Individual word timestamps are not included.
     *
     * @var list<Segment> $segments
     */
    #[Required(list: Segment::class)]
    public array $segments;

    /**
     * Text contains the complete recognized speech in the original language.
     */
    #[Required]
    public string $text;

    /**
     * `new Content()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Content::with(segments: ..., text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Content)->withSegments(...)->withText(...)
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
     *
     * @param list<Segment|SegmentShape> $segments
     */
    public static function with(array $segments, string $text): self
    {
        $self = new self;

        $self['segments'] = $segments;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Segments contains timed passages in chronological order. Individual word timestamps are not included.
     *
     * @param list<Segment|SegmentShape> $segments
     */
    public function withSegments(array $segments): self
    {
        $self = clone $this;
        $self['segments'] = $segments;

        return $self;
    }

    /**
     * Text contains the complete recognized speech in the original language.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
