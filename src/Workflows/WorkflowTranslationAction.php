<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Translates or reuses an original caption in one target language. Requires an asset.output.ready rule connected to an original caption creation action.
 *
 * @phpstan-import-type WorkflowOutputBindingShape from \Chunkify\Workflows\WorkflowOutputBinding
 * @phpstan-import-type WorkflowTranslationShape from \Chunkify\Workflows\WorkflowTranslation
 *
 * @phpstan-type WorkflowTranslationActionShape = array{
 *   id: string,
 *   captionID: WorkflowOutputBinding|WorkflowOutputBindingShape,
 *   params: WorkflowTranslation|WorkflowTranslationShape,
 *   type: 'translate_caption',
 * }
 */
final class WorkflowTranslationAction implements BaseModel
{
    /** @use SdkModel<WorkflowTranslationActionShape> */
    use SdkModel;

    /**
     * Type specifies the action to perform. Must be translate_caption.
     *
     * @var 'translate_caption' $type
     */
    #[Required]
    public string $type = 'translate_caption';

    /**
     * Id specifies a stable action key, unique within its rule.
     * Use 1 to 64 characters, starting with a letter and containing only letters, digits, or underscores.
     */
    #[Required]
    public string $id;

    /**
     * CaptionId specifies the binding to the original caption in the triggering event.
     */
    #[Required('caption_id')]
    public WorkflowOutputBinding $captionID;

    /**
     * Params specifies the target language.
     */
    #[Required]
    public WorkflowTranslation $params;

    /**
     * `new WorkflowTranslationAction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkflowTranslationAction::with(id: ..., captionID: ..., params: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkflowTranslationAction)
     *   ->withID(...)
     *   ->withCaptionID(...)
     *   ->withParams(...)
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
     * @param WorkflowOutputBinding|WorkflowOutputBindingShape $captionID
     * @param WorkflowTranslation|WorkflowTranslationShape $params
     */
    public static function with(
        string $id,
        WorkflowOutputBinding|array $captionID,
        WorkflowTranslation|array $params,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['captionID'] = $captionID;
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
     * CaptionId specifies the binding to the original caption in the triggering event.
     *
     * @param WorkflowOutputBinding|WorkflowOutputBindingShape $captionID
     */
    public function withCaptionID(WorkflowOutputBinding|array $captionID): self
    {
        $self = clone $this;
        $self['captionID'] = $captionID;

        return $self;
    }

    /**
     * Params specifies the target language.
     *
     * @param WorkflowTranslation|WorkflowTranslationShape $params
     */
    public function withParams(WorkflowTranslation|array $params): self
    {
        $self = clone $this;
        $self['params'] = $params;

        return $self;
    }

    /**
     * Type specifies the action to perform. Must be translate_caption.
     *
     * @param 'translate_caption' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
