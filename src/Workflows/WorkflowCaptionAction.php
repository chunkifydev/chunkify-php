<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\WorkflowCaptionAction\TranscriptID;

/**
 * Generates or reuses original captions and their transcript from the Asset's speech.
 *
 * @phpstan-import-type TranscriptIDShape from \Chunkify\Workflows\WorkflowCaptionAction\TranscriptID
 *
 * @phpstan-type WorkflowCaptionActionShape = array{
 *   id: string,
 *   params: mixed,
 *   type: 'create_caption',
 *   transcriptID?: null|TranscriptID|TranscriptIDShape,
 * }
 */
final class WorkflowCaptionAction implements BaseModel
{
    /** @use SdkModel<WorkflowCaptionActionShape> */
    use SdkModel;

    /**
     * Type specifies the action to perform. Must be create_caption.
     *
     * @var 'create_caption' $type
     */
    #[Required]
    public string $type = 'create_caption';

    /**
     * Id specifies a stable action key, unique within its rule.
     * Use 1 to 64 characters, starting with a letter and containing only letters, digits, or underscores.
     */
    #[Required]
    public string $id;

    /**
     * Params specifies caption generation settings. Pass an empty object.
     */
    #[Required]
    public mixed $params;

    /**
     * TranscriptId binds caption publication to the transcript in the triggering event. Use it only when connected to create_transcript. When omitted, creates or reuses the Asset’s original transcript.
     */
    #[Optional('transcript_id')]
    public ?TranscriptID $transcriptID;

    /**
     * `new WorkflowCaptionAction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkflowCaptionAction::with(id: ..., params: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkflowCaptionAction)->withID(...)->withParams(...)
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
     * @param TranscriptID|TranscriptIDShape|null $transcriptID
     */
    public static function with(
        string $id,
        mixed $params,
        TranscriptID|array|null $transcriptID = null
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['params'] = $params;

        null !== $transcriptID && $self['transcriptID'] = $transcriptID;

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
     * Params specifies caption generation settings. Pass an empty object.
     */
    public function withParams(mixed $params): self
    {
        $self = clone $this;
        $self['params'] = $params;

        return $self;
    }

    /**
     * Type specifies the action to perform. Must be create_caption.
     *
     * @param 'create_caption' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * TranscriptId binds caption publication to the transcript in the triggering event. Use it only when connected to create_transcript. When omitted, creates or reuses the Asset’s original transcript.
     *
     * @param TranscriptID|TranscriptIDShape $transcriptID
     */
    public function withTranscriptID(TranscriptID|array $transcriptID): self
    {
        $self = clone $this;
        $self['transcriptID'] = $transcriptID;

        return $self;
    }
}
