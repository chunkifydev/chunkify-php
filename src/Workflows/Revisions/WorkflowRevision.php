<?php

declare(strict_types=1);

namespace Chunkify\Workflows\Revisions;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\Revisions\WorkflowRevision\Rule;

/**
 * An immutable Workflow definition pinned to Assets and Uploads at creation.
 *
 * @phpstan-import-type RuleShape from \Chunkify\Workflows\Revisions\WorkflowRevision\Rule
 *
 * @phpstan-type WorkflowRevisionShape = array{
 *   createdAt: \DateTimeInterface,
 *   revision: int,
 *   rules: list<Rule|RuleShape>,
 *   schemaVersion: int,
 *   workflowID: string,
 * }
 */
final class WorkflowRevision implements BaseModel
{
    /** @use SdkModel<WorkflowRevisionShape> */
    use SdkModel;

    /**
     * When this Workflow revision was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Definition revision number, starting at 1.
     */
    #[Required]
    public int $revision;

    /**
     * Rules specifies the event subscriptions and actions in this definition.
     * Provide exactly one asset.ready rule and up to 15 connected rules, with at most 32 actions and 65536 encoded bytes across all rules. Array order affects display only.
     *
     * @var list<Rule> $rules
     */
    #[Required(list: Rule::class)]
    public array $rules;

    /**
     * SchemaVersion specifies the Workflow definition format. The supported version is 1.
     */
    #[Required('schema_version')]
    public int $schemaVersion;

    /**
     * ID of the Workflow that owns this revision.
     */
    #[Required('workflow_id')]
    public string $workflowID;

    /**
     * `new WorkflowRevision()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkflowRevision::with(
     *   createdAt: ..., revision: ..., rules: ..., schemaVersion: ..., workflowID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkflowRevision)
     *   ->withCreatedAt(...)
     *   ->withRevision(...)
     *   ->withRules(...)
     *   ->withSchemaVersion(...)
     *   ->withWorkflowID(...)
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
     * @param list<Rule|RuleShape> $rules
     */
    public static function with(
        \DateTimeInterface $createdAt,
        int $revision,
        array $rules,
        int $schemaVersion,
        string $workflowID,
    ): self {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['revision'] = $revision;
        $self['rules'] = $rules;
        $self['schemaVersion'] = $schemaVersion;
        $self['workflowID'] = $workflowID;

        return $self;
    }

    /**
     * When this Workflow revision was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Definition revision number, starting at 1.
     */
    public function withRevision(int $revision): self
    {
        $self = clone $this;
        $self['revision'] = $revision;

        return $self;
    }

    /**
     * Rules specifies the event subscriptions and actions in this definition.
     * Provide exactly one asset.ready rule and up to 15 connected rules, with at most 32 actions and 65536 encoded bytes across all rules. Array order affects display only.
     *
     * @param list<Rule|RuleShape> $rules
     */
    public function withRules(array $rules): self
    {
        $self = clone $this;
        $self['rules'] = $rules;

        return $self;
    }

    /**
     * SchemaVersion specifies the Workflow definition format. The supported version is 1.
     */
    public function withSchemaVersion(int $schemaVersion): self
    {
        $self = clone $this;
        $self['schemaVersion'] = $schemaVersion;

        return $self;
    }

    /**
     * ID of the Workflow that owns this revision.
     */
    public function withWorkflowID(string $workflowID): self
    {
        $self = clone $this;
        $self['workflowID'] = $workflowID;

        return $self;
    }
}
