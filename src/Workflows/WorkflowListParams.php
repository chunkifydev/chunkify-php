<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * List Workflows in the Project, newest first. Archived Workflows are excluded unless archived is true.
 *
 * @see Chunkify\Services\WorkflowsService::list()
 *
 * @phpstan-type WorkflowListParamsShape = array{
 *   archived?: bool|null, limit?: int|null, offset?: int|null
 * }
 */
final class WorkflowListParams implements BaseModel
{
    /** @use SdkModel<WorkflowListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Archived specifies whether to include archived Workflows. Defaults to false.
     */
    #[Optional]
    public ?bool $archived;

    /**
     * Limit specifies the maximum number of results to return.
     * Accepts 1 to 100. Defaults to 100.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Offset specifies the number of matching results to skip.
     * Must be at least 0. Defaults to 0.
     */
    #[Optional]
    public ?int $offset;

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
        ?bool $archived = null,
        ?int $limit = null,
        ?int $offset = null
    ): self {
        $self = new self;

        null !== $archived && $self['archived'] = $archived;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;

        return $self;
    }

    /**
     * Archived specifies whether to include archived Workflows. Defaults to false.
     */
    public function withArchived(bool $archived): self
    {
        $self = clone $this;
        $self['archived'] = $archived;

        return $self;
    }

    /**
     * Limit specifies the maximum number of results to return.
     * Accepts 1 to 100. Defaults to 100.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Offset specifies the number of matching results to skip.
     * Must be at least 0. Defaults to 0.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }
}
