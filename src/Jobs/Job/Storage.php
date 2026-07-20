<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Job;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Storage settings for where the job output will be saved.
 *
 * @phpstan-type StorageShape = array{id: string, path: string}
 */
final class Storage implements BaseModel
{
    /** @use SdkModel<StorageShape> */
    use SdkModel;

    /**
     * ID of the storage.
     */
    #[Required]
    public string $id;

    /**
     * Path where the output will be stored.
     */
    #[Required]
    public string $path;

    /**
     * `new Storage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Storage::with(id: ..., path: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Storage)->withID(...)->withPath(...)
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
    public static function with(string $id, string $path): self
    {
        $self = new self;

        $self['id'] = $id;
        $self['path'] = $path;

        return $self;
    }

    /**
     * ID of the storage.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Path where the output will be stored.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }
}
