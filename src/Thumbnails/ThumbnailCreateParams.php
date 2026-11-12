<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Thumbnails\ThumbnailCreateParams\Format;
use Chunkify\Thumbnails\ThumbnailCreateParams\Output;
use Chunkify\Thumbnails\ThumbnailCreateParams\Range;

/**
 * Generate individual images or sprite sheets from a Source. Each accepted request creates a new resource. Processing continues after the response.
 *
 * @see Chunkify\Services\ThumbnailsService::create()
 *
 * @phpstan-import-type RangeShape from \Chunkify\Thumbnails\ThumbnailCreateParams\Range
 * @phpstan-import-type ThumbnailCreateStorageParamsShape from \Chunkify\Thumbnails\ThumbnailCreateStorageParams
 *
 * @phpstan-type ThumbnailCreateParamsShape = array{
 *   sourceID: string,
 *   count?: int|null,
 *   format?: null|Format|value-of<Format>,
 *   metadata?: array<string,string>|null,
 *   output?: null|Output|value-of<Output>,
 *   range?: null|Range|RangeShape,
 *   size?: int|null,
 *   storage?: null|ThumbnailCreateStorageParams|ThumbnailCreateStorageParamsShape,
 *   timestamps?: list<float>|null,
 * }
 */
final class ThumbnailCreateParams implements BaseModel
{
    /** @use SdkModel<ThumbnailCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * SourceId identifies a video Source in this Project.
     */
    #[Required('source_id')]
    public string $sourceID;

    /**
     * Count specifies 1 to 100 thumbnails at the middle of equal sections of the selected range.
     */
    #[Optional]
    public ?int $count;

    /**
     * Format selects JPEG or WebP. Defaults to JPEG.
     *
     * @var value-of<Format>|null $format
     */
    #[Optional(enum: Format::class)]
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
     * @var value-of<Output>|null $output
     */
    #[Optional(enum: Output::class)]
    public ?string $output;

    /**
     * Range limits sampling to part of the Source. Defaults to the whole Source duration.
     */
    #[Optional]
    public ?Range $range;

    /**
     * Size specifies the maximum image or tile edge in pixels, from 64 to 1920. Defaults to 320. Odd sizes are supported. Preserves display aspect ratio without cropping or upscaling.
     */
    #[Optional]
    public ?int $size;

    /**
     * Storage overrides the Project output destination and names the output files. Source storage remains independent.
     */
    #[Optional]
    public ?ThumbnailCreateStorageParams $storage;

    /**
     * Timestamps specifies 1 to 100 Source-relative target times in seconds. Every time must be within the selected range. Repeated targets produce separate outputs.
     *
     * @var list<float>|null $timestamps
     */
    #[Optional(list: 'float')]
    public ?array $timestamps;

    /**
     * `new ThumbnailCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ThumbnailCreateParams::with(sourceID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ThumbnailCreateParams)->withSourceID(...)
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
     * @param Format|value-of<Format>|null $format
     * @param array<string,string>|null $metadata
     * @param Output|value-of<Output>|null $output
     * @param Range|RangeShape|null $range
     * @param ThumbnailCreateStorageParams|ThumbnailCreateStorageParamsShape|null $storage
     * @param list<float>|null $timestamps
     */
    public static function with(
        string $sourceID,
        ?int $count = null,
        Format|string|null $format = null,
        ?array $metadata = null,
        Output|string|null $output = null,
        Range|array|null $range = null,
        ?int $size = null,
        ThumbnailCreateStorageParams|array|null $storage = null,
        ?array $timestamps = null,
    ): self {
        $self = new self;

        $self['sourceID'] = $sourceID;

        null !== $count && $self['count'] = $count;
        null !== $format && $self['format'] = $format;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $output && $self['output'] = $output;
        null !== $range && $self['range'] = $range;
        null !== $size && $self['size'] = $size;
        null !== $storage && $self['storage'] = $storage;
        null !== $timestamps && $self['timestamps'] = $timestamps;

        return $self;
    }

    /**
     * SourceId identifies a video Source in this Project.
     */
    public function withSourceID(string $sourceID): self
    {
        $self = clone $this;
        $self['sourceID'] = $sourceID;

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
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
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
     * @param Output|value-of<Output> $output
     */
    public function withOutput(Output|string $output): self
    {
        $self = clone $this;
        $self['output'] = $output;

        return $self;
    }

    /**
     * Range limits sampling to part of the Source. Defaults to the whole Source duration.
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
     * Size specifies the maximum image or tile edge in pixels, from 64 to 1920. Defaults to 320. Odd sizes are supported. Preserves display aspect ratio without cropping or upscaling.
     */
    public function withSize(int $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * Storage overrides the Project output destination and names the output files. Source storage remains independent.
     *
     * @param ThumbnailCreateStorageParams|ThumbnailCreateStorageParamsShape $storage
     */
    public function withStorage(
        ThumbnailCreateStorageParams|array $storage
    ): self {
        $self = clone $this;
        $self['storage'] = $storage;

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
