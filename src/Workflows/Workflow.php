<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\Workflow\Rule;

/**
 * A reusable definition of actions triggered by Asset events.
 *
 * @phpstan-import-type RuleShape from \Chunkify\Workflows\Workflow\Rule
 *
 * @phpstan-type WorkflowShape = array{
 *   id: string,
 *   archivedAt: \DateTimeInterface|null,
 *   createdAt: \DateTimeInterface,
 *   name: string,
 *   revision: int,
 *   rules: list<Rule|RuleShape>,
 *   schemaVersion: int,
 *   updatedAt: \DateTimeInterface,
 * }
 */
final class Workflow implements BaseModel
{
    /** @use SdkModel<WorkflowShape> */
    use SdkModel;

    /**
     * Unique Workflow ID.
     */
    #[Required]
    public string $id;

    /**
     * When the Workflow was archived, or null if it is available for selection. Archiving stops new runs; accepted actions finish.
     */
    #[Required('archived_at')]
    public ?\DateTimeInterface $archivedAt;

    /**
     * When the Workflow was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Name specifies the Workflow name.
     * Use 1 to 128 characters.
     */
    #[Required]
    public string $name;

    /**
     * Current definition revision. Starts at 1 and increases when rules are replaced.
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
     * When the Workflow was last updated.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * `new Workflow()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Workflow::with(
     *   id: ...,
     *   archivedAt: ...,
     *   createdAt: ...,
     *   name: ...,
     *   revision: ...,
     *   rules: ...,
     *   schemaVersion: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Workflow)
     *   ->withID(...)
     *   ->withArchivedAt(...)
     *   ->withCreatedAt(...)
     *   ->withName(...)
     *   ->withRevision(...)
     *   ->withRules(...)
     *   ->withSchemaVersion(...)
     *   ->withUpdatedAt(...)
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
        string $id,
        ?\DateTimeInterface $archivedAt,
        \DateTimeInterface $createdAt,
        string $name,
        int $revision,
        array $rules,
        int $schemaVersion,
        \DateTimeInterface $updatedAt,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['archivedAt'] = $archivedAt;
        $self['createdAt'] = $createdAt;
        $self['name'] = $name;
        $self['revision'] = $revision;
        $self['rules'] = $rules;
        $self['schemaVersion'] = $schemaVersion;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Unique Workflow ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * When the Workflow was archived, or null if it is available for selection. Archiving stops new runs; accepted actions finish.
     */
    public function withArchivedAt(?\DateTimeInterface $archivedAt): self
    {
        $self = clone $this;
        $self['archivedAt'] = $archivedAt;

        return $self;
    }

    /**
     * When the Workflow was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Name specifies the Workflow name.
     * Use 1 to 128 characters.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Current definition revision. Starts at 1 and increases when rules are replaced.
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
     * When the Workflow was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
