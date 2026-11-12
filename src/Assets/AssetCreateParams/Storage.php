<?php

declare(strict_types=1);

namespace Chunkify\Assets\AssetCreateParams;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Output Storage. Omit to use the Project default. The path_template controls the folder for generated output paths.
 *
 * @phpstan-type StorageShape = array{id?: string|null}
 */
final class Storage implements BaseModel
{
    /** @use SdkModel<StorageShape> */
    use SdkModel;

    /**
     * ID of output Storage in this Project. Omit to use the Project default. Applies to all outputs, including static renditions added later.
     */
    #[Optional]
    public ?string $id;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $id = null): self
    {
        $self = new self;

        null !== $id && $self['id'] = $id;

        return $self;
    }

    /**
     * ID of output Storage in this Project. Omit to use the Project default. Applies to all outputs, including static renditions added later.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
