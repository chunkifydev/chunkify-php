<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\WorkflowRule\Event;
use Chunkify\Workflows\WorkflowRule\Origin;

/**
 * A starting or connected step with one or more independent actions.
 *
 * @phpstan-import-type WorkflowActionVariants from \Chunkify\Workflows\WorkflowAction
 * @phpstan-import-type WorkflowActionShape from \Chunkify\Workflows\WorkflowAction
 * @phpstan-import-type OriginShape from \Chunkify\Workflows\WorkflowRule\Origin
 *
 * @phpstan-type WorkflowRuleShape = array{
 *   id: string,
 *   actions: list<WorkflowActionShape>,
 *   event: Event|value-of<Event>,
 *   origin?: null|Origin|OriginShape,
 * }
 */
final class WorkflowRule implements BaseModel
{
    /** @use SdkModel<WorkflowRuleShape> */
    use SdkModel;

    /**
     * Id specifies a stable rule key, unique within this Workflow definition.
     * Use 1 to 64 characters, starting with a letter and containing only letters, digits, or underscores.
     */
    #[Required]
    public string $id;

    /**
     * Actions specifies the work to start when the rule matches. Actions can run concurrently; array order does not define execution order.
     * Provide 1 to 32 actions per rule, with at most 32 across the definition.
     *
     * @var list<WorkflowActionVariants> $actions
     */
    #[Required(list: WorkflowAction::class)]
    public array $actions;

    /**
     * Event specifies when this rule starts. Use asset.ready for the single starting rule. Output ready events require an origin caption or static rendition action in this Workflow.
     *
     * @var value-of<Event> $event
     */
    #[Required(enum: Event::class)]
    public string $event;

    /**
     * Origin specifies the action whose ready output starts this rule. Required for asset.output.ready; omit it for asset.ready. Translation steps must connect to a create_caption action.
     * References must point to a compatible action in this definition and must not form a cycle.
     */
    #[Optional]
    public ?Origin $origin;

    /**
     * `new WorkflowRule()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkflowRule::with(id: ..., actions: ..., event: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkflowRule)->withID(...)->withActions(...)->withEvent(...)
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
     * @param list<WorkflowActionShape> $actions
     * @param Event|value-of<Event> $event
     * @param Origin|OriginShape|null $origin
     */
    public static function with(
        string $id,
        array $actions,
        Event|string $event,
        Origin|array|null $origin = null
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['actions'] = $actions;
        $self['event'] = $event;

        null !== $origin && $self['origin'] = $origin;

        return $self;
    }

    /**
     * Id specifies a stable rule key, unique within this Workflow definition.
     * Use 1 to 64 characters, starting with a letter and containing only letters, digits, or underscores.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Actions specifies the work to start when the rule matches. Actions can run concurrently; array order does not define execution order.
     * Provide 1 to 32 actions per rule, with at most 32 across the definition.
     *
     * @param list<WorkflowActionShape> $actions
     */
    public function withActions(array $actions): self
    {
        $self = clone $this;
        $self['actions'] = $actions;

        return $self;
    }

    /**
     * Event specifies when this rule starts. Use asset.ready for the single starting rule. Output ready events require an origin caption or static rendition action in this Workflow.
     *
     * @param Event|value-of<Event> $event
     */
    public function withEvent(Event|string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }

    /**
     * Origin specifies the action whose ready output starts this rule. Required for asset.output.ready; omit it for asset.ready. Translation steps must connect to a create_caption action.
     * References must point to a compatible action in this definition and must not form a cycle.
     *
     * @param Origin|OriginShape $origin
     */
    public function withOrigin(Origin|array $origin): self
    {
        $self = clone $this;
        $self['origin'] = $origin;

        return $self;
    }
}
