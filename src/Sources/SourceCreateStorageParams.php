<?php

declare(strict_types=1);

namespace Chunkify\Sources;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type SourceCreateStorageParamsShape = array{
 *   path: string, id?: string|null
 * }
 */
final class SourceCreateStorageParams implements BaseModel
{
    /** @use SdkModel<SourceCreateStorageParamsShape> */
    use SdkModel;

    /**
     * Exact object key in the configured bucket, 1 to 1024 UTF-8 bytes. The output base_prefix is not added.
     */
    #[Required]
    public string $path;

    /**
     * Connected external storage belonging to this project. If omitted, uses the project default storage, which must be external. The resolved storage ID is saved on the source.
     */
    #[Optional]
    public ?string $id;

    /**
     * `new SourceCreateStorageParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SourceCreateStorageParams::with(path: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SourceCreateStorageParams)->withPath(...)
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
    public static function with(string $path, ?string $id = null): self
    {
        $self = new self;

        $self['path'] = $path;

        null !== $id && $self['id'] = $id;

        return $self;
    }

    /**
     * Exact object key in the configured bucket, 1 to 1024 UTF-8 bytes. The output base_prefix is not added.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * Connected external storage belonging to this project. If omitted, uses the project default storage, which must be external. The resolved storage ID is saved on the source.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
