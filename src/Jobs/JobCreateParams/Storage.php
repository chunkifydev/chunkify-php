<?php

declare(strict_types=1);

namespace Chunkify\Jobs\JobCreateParams;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Optional storage configuration.
 *
 * @phpstan-type StorageShape = array{id?: string|null, path?: string|null}
 */
final class Storage implements BaseModel
{
    /** @use SdkModel<StorageShape> */
    use SdkModel;

    /**
     * Storage Id specifies the storage configuration to use from pre-configured storage options.
     * Must be 4-64 characters long and contain only alphanumeric characters, underscores and hyphens.
     * Optional if Storage Path is provided.
     */
    #[Optional]
    public ?string $id;

    /**
     * Storage Path specifies a custom storage path where processed files will be stored.
     * Must be a valid file path with max length of 1024 characters.
     * Optional if Storage Id is provided.
     */
    #[Optional]
    public ?string $path;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $id = null, ?string $path = null): self
    {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $path && $self['path'] = $path;

        return $self;
    }

    /**
     * Storage Id specifies the storage configuration to use from pre-configured storage options.
     * Must be 4-64 characters long and contain only alphanumeric characters, underscores and hyphens.
     * Optional if Storage Path is provided.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Storage Path specifies a custom storage path where processed files will be stored.
     * Must be a valid file path with max length of 1024 characters.
     * Optional if Storage Id is provided.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }
}
