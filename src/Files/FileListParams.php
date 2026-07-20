<?php

declare(strict_types=1);

namespace Chunkify\Files;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Files\FileListParams\Created;
use Chunkify\Files\FileListParams\Duration;
use Chunkify\Files\FileListParams\Height;
use Chunkify\Files\FileListParams\Path;
use Chunkify\Files\FileListParams\Size;
use Chunkify\Files\FileListParams\Width;

/**
 * Retrieve a list of files with optional filtering and pagination.
 *
 * @see Chunkify\Services\FilesService::list()
 *
 * @phpstan-import-type CreatedShape from \Chunkify\Files\FileListParams\Created
 * @phpstan-import-type DurationShape from \Chunkify\Files\FileListParams\Duration
 * @phpstan-import-type HeightShape from \Chunkify\Files\FileListParams\Height
 * @phpstan-import-type PathShape from \Chunkify\Files\FileListParams\Path
 * @phpstan-import-type SizeShape from \Chunkify\Files\FileListParams\Size
 * @phpstan-import-type WidthShape from \Chunkify\Files\FileListParams\Width
 *
 * @phpstan-type FileListParamsShape = array{
 *   id?: string|null,
 *   audioCodec?: string|null,
 *   created?: null|Created|CreatedShape,
 *   duration?: null|Duration|DurationShape,
 *   height?: null|Height|HeightShape,
 *   jobID?: string|null,
 *   limit?: int|null,
 *   mimeType?: string|null,
 *   offset?: int|null,
 *   path?: null|Path|PathShape,
 *   size?: null|Size|SizeShape,
 *   storageID?: string|null,
 *   videoCodec?: string|null,
 *   width?: null|Width|WidthShape,
 * }
 */
final class FileListParams implements BaseModel
{
    /** @use SdkModel<FileListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by file ID.
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

    #[Optional]
    public ?Duration $duration;

    #[Optional]
    public ?Height $height;

    /**
     * Filter by job ID.
     */
    #[Optional]
    public ?string $jobID;

    /**
     * Pagination limit (max 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter by mime type.
     */
    #[Optional]
    public ?string $mimeType;

    /**
     * Pagination offset.
     */
    #[Optional]
    public ?int $offset;

    #[Optional]
    public ?Path $path;

    #[Optional]
    public ?Size $size;

    /**
     * Filter by storage ID.
     */
    #[Optional]
    public ?string $storageID;

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
     * @param Duration|DurationShape|null $duration
     * @param Height|HeightShape|null $height
     * @param Path|PathShape|null $path
     * @param Size|SizeShape|null $size
     * @param Width|WidthShape|null $width
     */
    public static function with(
        ?string $id = null,
        ?string $audioCodec = null,
        Created|array|null $created = null,
        Duration|array|null $duration = null,
        Height|array|null $height = null,
        ?string $jobID = null,
        ?int $limit = null,
        ?string $mimeType = null,
        ?int $offset = null,
        Path|array|null $path = null,
        Size|array|null $size = null,
        ?string $storageID = null,
        ?string $videoCodec = null,
        Width|array|null $width = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $audioCodec && $self['audioCodec'] = $audioCodec;
        null !== $created && $self['created'] = $created;
        null !== $duration && $self['duration'] = $duration;
        null !== $height && $self['height'] = $height;
        null !== $jobID && $self['jobID'] = $jobID;
        null !== $limit && $self['limit'] = $limit;
        null !== $mimeType && $self['mimeType'] = $mimeType;
        null !== $offset && $self['offset'] = $offset;
        null !== $path && $self['path'] = $path;
        null !== $size && $self['size'] = $size;
        null !== $storageID && $self['storageID'] = $storageID;
        null !== $videoCodec && $self['videoCodec'] = $videoCodec;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Filter by file ID.
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
     * Filter by job ID.
     */
    public function withJobID(string $jobID): self
    {
        $self = clone $this;
        $self['jobID'] = $jobID;

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
     * Filter by mime type.
     */
    public function withMimeType(string $mimeType): self
    {
        $self = clone $this;
        $self['mimeType'] = $mimeType;

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
     * @param Path|PathShape $path
     */
    public function withPath(Path|array $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

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
     * Filter by storage ID.
     */
    public function withStorageID(string $storageID): self
    {
        $self = clone $this;
        $self['storageID'] = $storageID;

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
