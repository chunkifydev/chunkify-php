<?php

declare(strict_types=1);

namespace Chunkify\Sources;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Core\Conversion\ListOf;
use Chunkify\Sources\SourceListParams\Created;
use Chunkify\Sources\SourceListParams\Device;
use Chunkify\Sources\SourceListParams\Duration;
use Chunkify\Sources\SourceListParams\Height;
use Chunkify\Sources\SourceListParams\Size;
use Chunkify\Sources\SourceListParams\Width;

/**
 * Retrieve a list of all sources with optional filtering and pagination. Supports filtering by various media properties like duration, dimensions, codecs, etc.
 *
 * @see Chunkify\Services\SourcesService::list()
 *
 * @phpstan-import-type CreatedShape from \Chunkify\Sources\SourceListParams\Created
 * @phpstan-import-type DurationShape from \Chunkify\Sources\SourceListParams\Duration
 * @phpstan-import-type HeightShape from \Chunkify\Sources\SourceListParams\Height
 * @phpstan-import-type SizeShape from \Chunkify\Sources\SourceListParams\Size
 * @phpstan-import-type WidthShape from \Chunkify\Sources\SourceListParams\Width
 *
 * @phpstan-type SourceListParamsShape = array{
 *   id?: string|null,
 *   audioCodec?: string|null,
 *   created?: null|Created|CreatedShape,
 *   device?: null|Device|value-of<Device>,
 *   duration?: null|Duration|DurationShape,
 *   height?: null|Height|HeightShape,
 *   limit?: int|null,
 *   metadata?: list<list<string>>|null,
 *   offset?: int|null,
 *   size?: null|Size|SizeShape,
 *   videoCodec?: string|null,
 *   width?: null|Width|WidthShape,
 * }
 */
final class SourceListParams implements BaseModel
{
    /** @use SdkModel<SourceListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by source ID.
     */
    #[Optional]
    public ?string $id;

    /**
     * Filter by audio codec.
     */
    #[Optional]
    public ?string $audioCodec;

    #[Optional]
    public ?Created $created;

    /**
     * Filter by device (apple/android).
     *
     * @var value-of<Device>|null $device
     */
    #[Optional(enum: Device::class)]
    public ?string $device;

    #[Optional]
    public ?Duration $duration;

    #[Optional]
    public ?Height $height;

    /**
     * Pagination limit (max 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter by metadata.
     *
     * @var list<list<string>>|null $metadata
     */
    #[Optional(list: new ListOf('string'))]
    public ?array $metadata;

    /**
     * Pagination offset.
     */
    #[Optional]
    public ?int $offset;

    #[Optional]
    public ?Size $size;

    /**
     * Filter by video codec.
     */
    #[Optional]
    public ?string $videoCodec;

    #[Optional]
    public ?Width $width;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Created|CreatedShape|null $created
     * @param Device|value-of<Device>|null $device
     * @param Duration|DurationShape|null $duration
     * @param Height|HeightShape|null $height
     * @param list<list<string>>|null $metadata
     * @param Size|SizeShape|null $size
     * @param Width|WidthShape|null $width
     */
    public static function with(
        ?string $id = null,
        ?string $audioCodec = null,
        Created|array|null $created = null,
        Device|string|null $device = null,
        Duration|array|null $duration = null,
        Height|array|null $height = null,
        ?int $limit = null,
        ?array $metadata = null,
        ?int $offset = null,
        Size|array|null $size = null,
        ?string $videoCodec = null,
        Width|array|null $width = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $audioCodec && $self['audioCodec'] = $audioCodec;
        null !== $created && $self['created'] = $created;
        null !== $device && $self['device'] = $device;
        null !== $duration && $self['duration'] = $duration;
        null !== $height && $self['height'] = $height;
        null !== $limit && $self['limit'] = $limit;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $offset && $self['offset'] = $offset;
        null !== $size && $self['size'] = $size;
        null !== $videoCodec && $self['videoCodec'] = $videoCodec;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Filter by source ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Filter by audio codec.
     */
    public function withAudioCodec(string $audioCodec): self
    {
        $self = clone $this;
        $self['audioCodec'] = $audioCodec;

        return $self;
    }

    /**
     * @param Created|CreatedShape $created
     */
    public function withCreated(Created|array $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    /**
     * Filter by device (apple/android).
     *
     * @param Device|value-of<Device> $device
     */
    public function withDevice(Device|string $device): self
    {
        $self = clone $this;
        $self['device'] = $device;

        return $self;
    }

    /**
     * @param Duration|DurationShape $duration
     */
    public function withDuration(Duration|array $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * @param Height|HeightShape $height
     */
    public function withHeight(Height|array $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Pagination limit (max 100).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter by metadata.
     *
     * @param list<list<string>> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Pagination offset.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * @param Size|SizeShape $size
     */
    public function withSize(Size|array $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * Filter by video codec.
     */
    public function withVideoCodec(string $videoCodec): self
    {
        $self = clone $this;
        $self['videoCodec'] = $videoCodec;

        return $self;
    }

    /**
     * @param Width|WidthShape $width
     */
    public function withWidth(Width|array $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
