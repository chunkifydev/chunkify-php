<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * The complete transcript and its timed passages. An audio track without speech produces empty text and an empty segments array.
 *
 * @phpstan-import-type AssetTranscriptSegmentShape from \Chunkify\Assets\AssetTranscriptSegment
 *
 * @phpstan-type AssetTranscriptContentShape = array{
 *   segments: list<AssetTranscriptSegment|AssetTranscriptSegmentShape>,
 *   text: string,
 * }
 */
final class AssetTranscriptContent implements BaseModel
{
    /** @use SdkModel<AssetTranscriptContentShape> */
    use SdkModel;

    /**
     * Segments contains timed passages in chronological order. Individual word timestamps are not included.
     *
     * @var list<AssetTranscriptSegment> $segments
     */
    #[Required(list: AssetTranscriptSegment::class)]
    public array $segments;

    /**
     * Text contains the complete recognized speech in the original language.
     */
    #[Required]
    public string $text;

    /**
     * `new AssetTranscriptContent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetTranscriptContent::with(segments: ..., text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetTranscriptContent)->withSegments(...)->withText(...)
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
     * @param list<AssetTranscriptSegment|AssetTranscriptSegmentShape> $segments
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
     * @param list<AssetTranscriptSegment|AssetTranscriptSegmentShape> $segments
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
