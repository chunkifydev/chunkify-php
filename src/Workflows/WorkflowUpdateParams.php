<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\WorkflowUpdateParams\SchemaVersion;

/**
 * Update the Workflow name or replace its rules. Replacing rules requires the current revision. A changed definition creates a new revision; unchanged rules and name-only edits preserve it. Existing Assets and Uploads keep their selected revision until a ready Asset explicitly updates to the latest revision. Archived Workflows cannot be updated.
 *
 * @see Chunkify\Services\WorkflowsService::update()
 *
 * @phpstan-import-type WorkflowRuleParamsShape from \Chunkify\Workflows\WorkflowRuleParams
 *
 * @phpstan-type WorkflowUpdateParamsShape = array{
 *   expectedRevision?: int|null,
 *   name?: string|null,
 *   rules?: list<WorkflowRuleParams|WorkflowRuleParamsShape>|null,
 *   schemaVersion?: null|SchemaVersion|value-of<SchemaVersion>,
 * }
 */
final class WorkflowUpdateParams implements BaseModel
{
    /** @use SdkModel<WorkflowUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * ExpectedRevision specifies the current Workflow revision when replacing rules. The update returns a conflict if it no longer matches.
     * Required when rules is provided. Must be at least 1.
     */
    #[Optional('expected_revision')]
    public ?int $expectedRevision;

    /**
     * Name specifies the Workflow name.
     * Use 1 to 128 characters.
     */
    #[Optional]
    public ?string $name;

    /**
     * Rules specifies the event subscriptions and actions in this definition.
     * Provide exactly one asset.ready rule and up to 15 connected rules, with at most 32 actions and 65536 encoded bytes across all rules. Array order affects display only.
     * Replaces the complete definition and requires schema_version and expected_revision. Existing Assets and Uploads keep their pinned revision.
     *
     * @var list<WorkflowRuleParams>|null $rules
     */
    #[Optional(list: WorkflowRuleParams::class)]
    public ?array $rules;

    /**
     * SchemaVersion specifies the Workflow definition format. The supported version is 1. Required when rules is provided.
     *
     * @var value-of<SchemaVersion>|null $schemaVersion
     */
    #[Optional('schema_version', enum: SchemaVersion::class)]
    public ?int $schemaVersion;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<WorkflowRuleParams|WorkflowRuleParamsShape>|null $rules
     * @param SchemaVersion|value-of<SchemaVersion>|null $schemaVersion
     */
    public static function with(
        ?int $expectedRevision = null,
        ?string $name = null,
        ?array $rules = null,
        SchemaVersion|int|null $schemaVersion = null,
    ): self {
        $self = new self;

        null !== $expectedRevision && $self['expectedRevision'] = $expectedRevision;
        null !== $name && $self['name'] = $name;
        null !== $rules && $self['rules'] = $rules;
        null !== $schemaVersion && $self['schemaVersion'] = $schemaVersion;

        return $self;
    }

    /**
     * ExpectedRevision specifies the current Workflow revision when replacing rules. The update returns a conflict if it no longer matches.
     * Required when rules is provided. Must be at least 1.
     */
    public function withExpectedRevision(int $expectedRevision): self
    {
        $self = clone $this;
        $self['expectedRevision'] = $expectedRevision;

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
     * Rules specifies the event subscriptions and actions in this definition.
     * Provide exactly one asset.ready rule and up to 15 connected rules, with at most 32 actions and 65536 encoded bytes across all rules. Array order affects display only.
     * Replaces the complete definition and requires schema_version and expected_revision. Existing Assets and Uploads keep their pinned revision.
     *
     * @param list<WorkflowRuleParams|WorkflowRuleParamsShape> $rules
     */
    public function withRules(array $rules): self
    {
        $self = clone $this;
        $self['rules'] = $rules;

        return $self;
    }

    /**
     * SchemaVersion specifies the Workflow definition format. The supported version is 1. Required when rules is provided.
     *
     * @param SchemaVersion|value-of<SchemaVersion> $schemaVersion
     */
    public function withSchemaVersion(SchemaVersion|int $schemaVersion): self
    {
        $self = clone $this;
        $self['schemaVersion'] = $schemaVersion;

        return $self;
    }
}
