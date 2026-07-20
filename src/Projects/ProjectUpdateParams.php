<?php

declare(strict_types=1);

namespace Chunkify\Projects;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Update a project's name or storage settings. Only team owners can update projects.
 *
 * @see Chunkify\Services\ProjectsService::update()
 *
 * @phpstan-type ProjectUpdateParamsShape = array{
 *   name?: string|null, storageID?: string|null
 * }
 */
final class ProjectUpdateParams implements BaseModel
{
    /** @use SdkModel<ProjectUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Name is the name of the project. Required when storage_id is not provided.
     */
    #[Optional]
    public ?string $name;

    /**
     * StorageId is the storage id of the project. Required when name is not provided.
     */
    #[Optional('storage_id')]
    public ?string $storageID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $name = null,
        ?string $storageID = null
    ): self {
        $self = new self;

        null !== $name && $self['name'] = $name;
        null !== $storageID && $self['storageID'] = $storageID;

        return $self;
    }

    /**
     * Name is the name of the project. Required when storage_id is not provided.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * StorageId is the storage id of the project. Required when name is not provided.
     */
    public function withStorageID(string $storageID): self
    {
        $self = clone $this;
        $self['storageID'] = $storageID;

        return $self;
    }
}
