<?php

declare(strict_types=1);

namespace Chunkify\Uploads\UploadCreateParams;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Optional Storage override. Omit id to use the Project default. Customer-connected Storage requires path; Chunkify Storage generates its own path.
 *
 * @phpstan-type StorageShape = array{id?: string|null, path?: string|null}
 */
final class Storage implements BaseModel
{
    /** @use SdkModel<StorageShape> */
    use SdkModel;

    /**
     * Storage belonging to this Project. Omit to use the Project default.
     */
    #[Optional]
    public ?string $id;

    /**
     * Exact object key including filename, required for customer Storage and forbidden for Chunkify Storage. The output base_prefix is not added. Existing keys may be overwritten.
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
     * Storage belonging to this Project. Omit to use the Project default.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Exact object key including filename, required for customer Storage and forbidden for Chunkify Storage. The output base_prefix is not added. Existing keys may be overwritten.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }
}
