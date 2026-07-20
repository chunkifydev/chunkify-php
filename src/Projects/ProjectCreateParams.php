<?php

declare(strict_types=1);

namespace Chunkify\Projects;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Create a new project with the specified name. The project will be created with default Chunkify storage settings.
 *
 * @see Chunkify\Services\ProjectsService::create()
 *
 * @phpstan-type ProjectCreateParamsShape = array{name: string}
 */
final class ProjectCreateParams implements BaseModel
{
    /** @use SdkModel<ProjectCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Name is the name of the project, which must be between 4 and 32 characters.
     */
    #[Required]
    public string $name;

    /**
     * `new ProjectCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectCreateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectCreateParams)->withName(...)
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
    public static function with(string $name): self
    {
        $self = new self;

        $self['name'] = $name;

        return $self;
    }

    /**
     * Name is the name of the project, which must be between 4 and 32 characters.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
