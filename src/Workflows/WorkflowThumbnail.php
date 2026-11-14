<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Thumbnails\ThumbnailFormat;
use Chunkify\Thumbnails\ThumbnailOutput;

/**
 * Generate additional thumbnails in the Asset folder and Storage. Each layout, format and size combination can be requested once. Specify exactly one of timestamps or count.
 *
 * @phpstan-import-type WorkflowThumbnailRangeShape from \Chunkify\Workflows\WorkflowThumbnailRange
 *
 * @phpstan-type WorkflowThumbnailShape = array{
 *   count?: int|null,
 *   format?: null|ThumbnailFormat|value-of<ThumbnailFormat>,
 *   metadata?: array<string,string>|null,
 *   output?: null|ThumbnailOutput|value-of<ThumbnailOutput>,
 *   range?: null|WorkflowThumbnailRange|WorkflowThumbnailRangeShape,
 *   size?: int|null,
 *   timestamps?: list<float>|null,
 * }
 */
final class WorkflowThumbnail implements BaseModel
{
    /** @use SdkModel<WorkflowThumbnailShape> */
    use SdkModel;

    /**
     * Count specifies 1 to 100 thumbnails at the middle of equal sections of the selected range.
     */
    #[Optional]
    public ?int $count;

    /**
     * Format selects JPEG or WebP. Defaults to JPEG.
     *
     * @var value-of<ThumbnailFormat>|null $format
     */
    #[Optional(enum: ThumbnailFormat::class)]
    public ?string $format;

    /**
     * Metadata attaches string values to this request. The serialized object may contain at most 2048 bytes.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * Output selects images or sprites. Defaults to images.
     *
     * @var value-of<ThumbnailOutput>|null $output
     */
    #[Optional(enum: ThumbnailOutput::class)]
    public ?string $output;

    /**
     * Range limits sampling to part of the Source. Defaults to the whole Source duration.
     */
    #[Optional]
    public ?WorkflowThumbnailRange $range;

    /**
     * Size specifies the maximum image or tile edge in pixels, from 64 to 1920. Defaults to 320. Odd sizes are supported. Preserves display aspect ratio without cropping or upscaling.
     */
    #[Optional]
    public ?int $size;

    /**
     * Timestamps specifies 1 to 100 Source-relative target times in seconds. Times outside the selected range are skipped when the action runs. If none remain, the action is skipped without a charge. Repeated targets produce separate outputs.
     *
     * @var list<float>|null $timestamps
     */
    #[Optional(list: 'float')]
    public ?array $timestamps;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ThumbnailFormat|value-of<ThumbnailFormat>|null $format
     * @param array<string,string>|null $metadata
     * @param ThumbnailOutput|value-of<ThumbnailOutput>|null $output
     * @param WorkflowThumbnailRange|WorkflowThumbnailRangeShape|null $range
     * @param list<float>|null $timestamps
     */
    public static function with(
        ?int $count = null,
        ThumbnailFormat|string|null $format = null,
        ?array $metadata = null,
        ThumbnailOutput|string|null $output = null,
        WorkflowThumbnailRange|array|null $range = null,
        ?int $size = null,
        ?array $timestamps = null,
    ): self {
        $self = new self;

        null !== $count && $self['count'] = $count;
        null !== $format && $self['format'] = $format;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $output && $self['output'] = $output;
        null !== $range && $self['range'] = $range;
        null !== $size && $self['size'] = $size;
        null !== $timestamps && $self['timestamps'] = $timestamps;

        return $self;
    }

    /**
     * Count specifies 1 to 100 thumbnails at the middle of equal sections of the selected range.
     */
    public function withCount(int $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }

    /**
     * Format selects JPEG or WebP. Defaults to JPEG.
     *
     * @param ThumbnailFormat|value-of<ThumbnailFormat> $format
     */
    public function withFormat(ThumbnailFormat|string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Metadata attaches string values to this request. The serialized object may contain at most 2048 bytes.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Output selects images or sprites. Defaults to images.
     *
     * @param ThumbnailOutput|value-of<ThumbnailOutput> $output
     */
    public function withOutput(ThumbnailOutput|string $output): self
    {
        $self = clone $this;
        $self['output'] = $output;

        return $self;
    }

    /**
     * Range limits sampling to part of the Source. Defaults to the whole Source duration.
     *
     * @param WorkflowThumbnailRange|WorkflowThumbnailRangeShape $range
     */
    public function withRange(WorkflowThumbnailRange|array $range): self
    {
        $self = clone $this;
        $self['range'] = $range;

        return $self;
    }

    /**
     * Size specifies the maximum image or tile edge in pixels, from 64 to 1920. Defaults to 320. Odd sizes are supported. Preserves display aspect ratio without cropping or upscaling.
     */
    public function withSize(int $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * Timestamps specifies 1 to 100 Source-relative target times in seconds. Times outside the selected range are skipped when the action runs. If none remain, the action is skipped without a charge. Repeated targets produce separate outputs.
     *
     * @param list<float> $timestamps
     */
    public function withTimestamps(array $timestamps): self
    {
        $self = clone $this;
        $self['timestamps'] = $timestamps;

        return $self;
    }
}
