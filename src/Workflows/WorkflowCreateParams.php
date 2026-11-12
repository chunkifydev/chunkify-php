<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\WorkflowCreateParams\Rule;
use Chunkify\Workflows\WorkflowCreateParams\SchemaVersion;

/**
 * Create a Workflow with its first definition revision. Select it when creating an Asset or Upload, or set it as the Project default.
 *
 * @see Chunkify\Services\WorkflowsService::create()
 *
 * @phpstan-import-type RuleShape from \Chunkify\Workflows\WorkflowCreateParams\Rule
 *
 * @phpstan-type WorkflowCreateParamsShape = array{
 *   name: string,
 *   rules: list<Rule|RuleShape>,
 *   schemaVersion: SchemaVersion|value-of<SchemaVersion>,
 * }
 */
final class WorkflowCreateParams implements BaseModel
{
    /** @use SdkModel<WorkflowCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Name specifies the Workflow name.
     * Use 1 to 128 characters.
     */
    #[Required]
    public string $name;

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
     *
     * @var value-of<SchemaVersion> $schemaVersion
     */
    #[Required('schema_version', enum: SchemaVersion::class)]
    public int $schemaVersion;

    /**
     * `new WorkflowCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkflowCreateParams::with(name: ..., rules: ..., schemaVersion: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkflowCreateParams)
     *   ->withName(...)
     *   ->withRules(...)
     *   ->withSchemaVersion(...)
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
     * @param SchemaVersion|value-of<SchemaVersion> $schemaVersion
     */
    public static function with(
        string $name,
        array $rules,
        SchemaVersion|int $schemaVersion
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['rules'] = $rules;
        $self['schemaVersion'] = $schemaVersion;

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
