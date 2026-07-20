<?php

declare(strict_types=1);

namespace Chunkify\Projects;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Response containing the list of projects for a team.
 *
 * @phpstan-import-type ProjectShape from \Chunkify\Projects\Project
 *
 * @phpstan-type ProjectListResponseShape = array{
 *   data: list<Project|ProjectShape>, status: 'success'
 * }
 */
final class ProjectListResponse implements BaseModel
{
    /** @use SdkModel<ProjectListResponseShape> */
    use SdkModel;

    /**
     * Status indicates the response status "success".
     *
     * @var 'success' $status
     */
    #[Required]
    public string $status = 'success';

    /**
     * Data contains the project items.
     *
     * @var list<Project> $data
     */
    #[Required(list: Project::class)]
    public array $data;

    /**
     * `new ProjectListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectListResponse::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectListResponse)->withData(...)
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
     *
     * @param list<Project|ProjectShape> $data
     */
    public static function with(array $data): self
    {
        $self = new self;

        $self['data'] = $data;

        return $self;
    }

    /**
     * Data contains the project items.
     *
     * @param list<Project|ProjectShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Status indicates the response status "success".
     *
     * @param 'success' $status
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
