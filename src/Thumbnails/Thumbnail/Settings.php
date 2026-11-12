<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails\Thumbnail;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Thumbnails\Thumbnail\Settings\Format;
use Chunkify\Thumbnails\Thumbnail\Settings\Output;
use Chunkify\Thumbnails\Thumbnail\Settings\Range;

/**
 * Settings contains the accepted sampling and output settings.
 *
 * @phpstan-import-type RangeShape from \Chunkify\Thumbnails\Thumbnail\Settings\Range
 *
 * @phpstan-type SettingsShape = array{
 *   format: Format|value-of<Format>,
 *   output: Output|value-of<Output>,
 *   range: Range|RangeShape,
 *   size: int,
 *   count?: int|null,
 *   timestamps?: list<float>|null,
 * }
 */
final class Settings implements BaseModel
{
    /** @use SdkModel<SettingsShape> */
    use SdkModel;

    /**
     * Format specifies the accepted image encoding.
     *
     * @var value-of<Format> $format
     */
    #[Required(enum: Format::class)]
    public string $format;

    /**
     * Output specifies the accepted output mode.
     *
     * @var value-of<Output> $output
     */
    #[Required(enum: Output::class)]
    public string $output;

    /**
     * Range contains the accepted sampling boundaries.
     */
    #[Required]
    public Range $range;

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
     * `new Settings()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Settings::with(format: ..., output: ..., range: ..., size: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Settings)->withFormat(...)->withOutput(...)->withRange(...)->withSize(...)
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
     * @param Format|value-of<Format> $format
     * @param Output|value-of<Output> $output
     * @param Range|RangeShape $range
     * @param list<float>|null $timestamps
     */
    public static function with(
        Format|string $format,
        Output|string $output,
        Range|array $range,
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
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Output specifies the accepted output mode.
     *
     * @param Output|value-of<Output> $output
     */
    public function withOutput(Output|string $output): self
    {
        $self = clone $this;
        $self['output'] = $output;

        return $self;
    }

    /**
     * Range contains the accepted sampling boundaries.
     *
     * @param Range|RangeShape $range
     */
    public function withRange(Range|array $range): self
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
