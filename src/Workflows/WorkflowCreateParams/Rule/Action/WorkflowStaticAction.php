<?php

declare(strict_types=1);

namespace Chunkify\Workflows\WorkflowCreateParams\Rule\Action;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowStaticAction\Params;

/**
 * Creates or reuses one static rendition for the Asset.
 *
 * @phpstan-import-type ParamsShape from \Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowStaticAction\Params
 *
 * @phpstan-type WorkflowStaticActionShape = array{
 *   id: string, params: Params|ParamsShape, type: 'create_static_rendition'
 * }
 */
final class WorkflowStaticAction implements BaseModel
{
    /** @use SdkModel<WorkflowStaticActionShape> */
    use SdkModel;

    /**
     * Type specifies the action to perform. Must be create_static_rendition.
     *
     * @var 'create_static_rendition' $type
     */
    #[Required]
    public string $type = 'create_static_rendition';

    /**
     * Id specifies a stable action key, unique within its rule.
     * Use 1 to 64 characters, starting with a letter and containing only letters, digits, or underscores.
     */
    #[Required]
    public string $id;

    /**
     * Params specifies the static rendition resolution.
     */
    #[Required]
    public Params $params;

    /**
     * `new WorkflowStaticAction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkflowStaticAction::with(id: ..., params: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkflowStaticAction)->withID(...)->withParams(...)
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
     * @param Params|ParamsShape $params
     */
    public static function with(string $id, Params|array $params): self
    {
        $self = new self;

        $self['id'] = $id;
        $self['params'] = $params;

        return $self;
    }

    /**
     * Id specifies a stable action key, unique within its rule.
     * Use 1 to 64 characters, starting with a letter and containing only letters, digits, or underscores.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Params specifies the static rendition resolution.
     *
     * @param Params|ParamsShape $params
     */
    public function withParams(Params|array $params): self
    {
        $self = clone $this;
        $self['params'] = $params;

        return $self;
    }

    /**
     * Type specifies the action to perform. Must be create_static_rendition.
     *
     * @param 'create_static_rendition' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
