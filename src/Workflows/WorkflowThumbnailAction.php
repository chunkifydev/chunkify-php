<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Creates an independent thumbnail request after asset.ready. Replaying this action uses its accepted request; separate actions create separate requests.
 *
 * @phpstan-import-type WorkflowThumbnailParamsShape from \Chunkify\Workflows\WorkflowThumbnailParams
 *
 * @phpstan-type WorkflowThumbnailActionShape = array{
 *   id: string,
 *   params: WorkflowThumbnailParams|WorkflowThumbnailParamsShape,
 *   type: 'create_thumbnails',
 * }
 */
final class WorkflowThumbnailAction implements BaseModel
{
    /** @use SdkModel<WorkflowThumbnailActionShape> */
    use SdkModel;

    /**
     * Type specifies the action to perform. Must be create_thumbnails.
     *
     * @var 'create_thumbnails' $type
     */
    #[Required]
    public string $type = 'create_thumbnails';

    /**
     * Id specifies a stable action key, unique within its rule.
     */
    #[Required]
    public string $id;

    /**
     * Params specifies sampling and image settings. Outputs use the Asset folder and Storage.
     */
    #[Required]
    public WorkflowThumbnailParams $params;

    /**
     * `new WorkflowThumbnailAction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkflowThumbnailAction::with(id: ..., params: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkflowThumbnailAction)->withID(...)->withParams(...)
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
     * @param WorkflowThumbnailParams|WorkflowThumbnailParamsShape $params
     */
    public static function with(
        string $id,
        WorkflowThumbnailParams|array $params
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['params'] = $params;

        return $self;
    }

    /**
     * Id specifies a stable action key, unique within its rule.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Params specifies sampling and image settings. Outputs use the Asset folder and Storage.
     *
     * @param WorkflowThumbnailParams|WorkflowThumbnailParamsShape $params
     */
    public function withParams(WorkflowThumbnailParams|array $params): self
    {
        $self = clone $this;
        $self['params'] = $params;

        return $self;
    }

    /**
     * Type specifies the action to perform. Must be create_thumbnails.
     *
     * @param 'create_thumbnails' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
