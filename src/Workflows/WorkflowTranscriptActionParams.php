<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Creates or reuses the original-language transcript. Can run alongside caption generation in the same asset.ready rule.
 *
 * @phpstan-type WorkflowTranscriptActionParamsShape = array{
 *   id: string, params: mixed, type: 'create_transcript'
 * }
 */
final class WorkflowTranscriptActionParams implements BaseModel
{
    /** @use SdkModel<WorkflowTranscriptActionParamsShape> */
    use SdkModel;

    /**
     * Type specifies the action to perform. Must be create_transcript.
     *
     * @var 'create_transcript' $type
     */
    #[Required]
    public string $type = 'create_transcript';

    /**
     * Id specifies a stable action key, unique within its rule.
     * Use 1 to 64 characters, starting with a letter and containing only letters, digits, or underscores.
     */
    #[Required]
    public string $id;

    /**
     * Params specifies transcript settings. Pass an empty object.
     */
    #[Required]
    public mixed $params;

    /**
     * `new WorkflowTranscriptActionParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkflowTranscriptActionParams::with(id: ..., params: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkflowTranscriptActionParams)->withID(...)->withParams(...)
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
    public static function with(string $id, mixed $params): self
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
     * Params specifies transcript settings. Pass an empty object.
     */
    public function withParams(mixed $params): self
    {
        $self = clone $this;
        $self['params'] = $params;

        return $self;
    }

    /**
     * Type specifies the action to perform. Must be create_transcript.
     *
     * @param 'create_transcript' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
