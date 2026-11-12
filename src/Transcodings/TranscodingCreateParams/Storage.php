<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingCreateParams;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Storage overrides the Project output destination. Source storage remains independent.
 *
 * @phpstan-type StorageShape = array{id?: string|null, path?: string|null}
 */
final class Storage implements BaseModel
{
    /** @use SdkModel<StorageShape> */
    use SdkModel;

    /**
     * Id specifies a Storage in this Project. Defaults to the Project output storage.
     */
    #[Optional]
    public ?string $id;

    /**
     * Path specifies the output object path relative to the selected Storage base_prefix. Required for customer storage; generated for Chunkify temporary storage. The extension must match the resolved output format. The combined path may contain at most 1024 bytes.
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
     * Id specifies a Storage in this Project. Defaults to the Project output storage.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Path specifies the output object path relative to the selected Storage base_prefix. Required for customer storage; generated for Chunkify temporary storage. The extension must match the resolved output format. The combined path may contain at most 1024 bytes.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }
}
