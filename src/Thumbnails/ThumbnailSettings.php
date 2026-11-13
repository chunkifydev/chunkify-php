<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Accepted sampling and output settings, with defaults resolved.
 *
 * @phpstan-import-type ThumbnailRangeShape from \Chunkify\Thumbnails\ThumbnailRange
 *
 * @phpstan-type ThumbnailSettingsShape = array{
 *   format: ThumbnailFormat|value-of<ThumbnailFormat>,
 *   output: ThumbnailOutput|value-of<ThumbnailOutput>,
 *   range: ThumbnailRange|ThumbnailRangeShape,
 *   size: int,
 *   count?: int|null,
 *   timestamps?: list<float>|null,
 * }
 */
final class ThumbnailSettings implements BaseModel
{
    /** @use SdkModel<ThumbnailSettingsShape> */
    use SdkModel;

    /**
     * Format specifies the accepted image encoding.
     *
     * @var value-of<ThumbnailFormat> $format
     */
    #[Required(enum: ThumbnailFormat::class)]
    public string $format;

    /**
     * Output specifies the accepted output mode.
     *
     * @var value-of<ThumbnailOutput> $output
     */
    #[Required(enum: ThumbnailOutput::class)]
    public string $output;

    /**
     * Range contains the accepted sampling boundaries.
     */
    #[Required]
    public ThumbnailRange $range;

    /**
     * Size specifies the accepted maximum image or tile edge in pixels.
     */
    #[Required]
    public int $size;

    /**
     * Count specifies 1 to 100 thumbnails at the middle of equal sections of the selected range.
     */
    #[Optional]
    public ?int $count;

    /**
     * Timestamps specifies 1 to 100 Source-relative target times in seconds. Every time must be within the selected range. Repeated targets produce separate outputs.
     *
     * @var list<float>|null $timestamps
     */
    #[Optional(list: 'float')]
    public ?array $timestamps;

    /**
     * `new ThumbnailSettings()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ThumbnailSettings::with(format: ..., output: ..., range: ..., size: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ThumbnailSettings)
     *   ->withFormat(...)
     *   ->withOutput(...)
     *   ->withRange(...)
     *   ->withSize(...)
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
     * @param ThumbnailFormat|value-of<ThumbnailFormat> $format
     * @param ThumbnailOutput|value-of<ThumbnailOutput> $output
     * @param ThumbnailRange|ThumbnailRangeShape $range
     * @param list<float>|null $timestamps
     */
    public static function with(
        ThumbnailFormat|string $format,
        ThumbnailOutput|string $output,
        ThumbnailRange|array $range,
        int $size,
        ?int $count = null,
        ?array $timestamps = null,
    ): self {
        $self = new self;

        $self['format'] = $format;
        $self['output'] = $output;
        $self['range'] = $range;
        $self['size'] = $size;

        null !== $count && $self['count'] = $count;
        null !== $timestamps && $self['timestamps'] = $timestamps;

        return $self;
    }

    /**
     * Format specifies the accepted image encoding.
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
     * Output specifies the accepted output mode.
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
     * Range contains the accepted sampling boundaries.
     *
     * @param ThumbnailRange|ThumbnailRangeShape $range
     */
    public function withRange(ThumbnailRange|array $range): self
    {
        $self = clone $this;
        $self['range'] = $range;

        return $self;
    }

    /**
     * Size specifies the accepted maximum image or tile edge in pixels.
     */
    public function withSize(int $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

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
     * Timestamps specifies 1 to 100 Source-relative target times in seconds. Every time must be within the selected range. Repeated targets produce separate outputs.
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
