<?php

declare(strict_types=1);

namespace Chunkify\Workflows\Revisions\WorkflowRevision\Rule;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Origin specifies the action whose ready output starts this rule. Required for asset.output.ready; omit it for asset.ready. Translation steps must connect to a create_caption action.
 * References must point to a compatible action in this definition and must not form a cycle.
 *
 * @phpstan-type OriginShape = array{actionID: string, ruleID: string}
 */
final class Origin implements BaseModel
{
    /** @use SdkModel<OriginShape> */
    use SdkModel;

    /**
     * ActionId specifies the ID of the producing action within that rule.
     * Use 1 to 64 characters, starting with a letter and containing only letters, digits, or underscores.
     */
    #[Required('action_id')]
    public string $actionID;

    /**
     * RuleId specifies the ID of the rule containing the producing action.
     * Use 1 to 64 characters, starting with a letter and containing only letters, digits, or underscores.
     */
    #[Required('rule_id')]
    public string $ruleID;

    /**
     * `new Origin()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Origin::with(actionID: ..., ruleID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Origin)->withActionID(...)->withRuleID(...)
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
    public static function with(string $actionID, string $ruleID): self
    {
        $self = new self;

        $self['actionID'] = $actionID;
        $self['ruleID'] = $ruleID;

        return $self;
    }

    /**
     * ActionId specifies the ID of the producing action within that rule.
     * Use 1 to 64 characters, starting with a letter and containing only letters, digits, or underscores.
     */
    public function withActionID(string $actionID): self
    {
        $self = clone $this;
        $self['actionID'] = $actionID;

        return $self;
    }

    /**
     * RuleId specifies the ID of the rule containing the producing action.
     * Use 1 to 64 characters, starting with a letter and containing only letters, digits, or underscores.
     */
    public function withRuleID(string $ruleID): self
    {
        $self = clone $this;
        $self['ruleID'] = $ruleID;

        return $self;
    }
}
