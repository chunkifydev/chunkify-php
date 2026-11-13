<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Selects the output referenced by the triggering event.
 *
 * @phpstan-type WorkflowOutputBindingShape = array{
 *   from: WorkflowOutputBindingFrom|value-of<WorkflowOutputBindingFrom>
 * }
 */
final class WorkflowOutputBinding implements BaseModel
{
    /** @use SdkModel<WorkflowOutputBindingShape> */
    use SdkModel;

    /**
     * From specifies where to read the input output ID. Use event.output.id to consume the output in the triggering asset.output.ready event.
     *
     * @var value-of<WorkflowOutputBindingFrom> $from
     */
    #[Required(enum: WorkflowOutputBindingFrom::class)]
    public string $from;

    /**
     * `new WorkflowOutputBinding()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkflowOutputBinding::with(from: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkflowOutputBinding)->withFrom(...)
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
     * @param WorkflowOutputBindingFrom|value-of<WorkflowOutputBindingFrom> $from
     */
    public static function with(WorkflowOutputBindingFrom|string $from): self
    {
        $self = new self;

        $self['from'] = $from;

        return $self;
    }

    /**
     * From specifies where to read the input output ID. Use event.output.id to consume the output in the triggering asset.output.ready event.
     *
     * @param WorkflowOutputBindingFrom|value-of<WorkflowOutputBindingFrom> $from
     */
    public function withFrom(WorkflowOutputBindingFrom|string $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }
}
