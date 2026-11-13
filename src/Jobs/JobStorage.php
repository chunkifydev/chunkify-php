<?php

declare(strict_types=1);

namespace Chunkify\Jobs;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Storage settings for where the job output will be saved.
 *
 * @phpstan-type JobStorageShape = array{id: string, path: string}
 */
final class JobStorage implements BaseModel
{
    /** @use SdkModel<JobStorageShape> */
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
     * `new JobStorage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JobStorage::with(id: ..., path: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JobStorage)->withID(...)->withPath(...)
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
