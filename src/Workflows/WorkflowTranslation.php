<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Parameters for translating one original caption into another language.
 *
 * @phpstan-type WorkflowTranslationShape = array{
 *   languageCode: WorkflowTranslationLanguageCode|value-of<WorkflowTranslationLanguageCode>,
 * }
 */
final class WorkflowTranslation implements BaseModel
{
    /** @use SdkModel<WorkflowTranslationShape> */
    use SdkModel;

    /**
     * LanguageCode specifies the target language for the translated subtitle track, such as en or fr. The same code appears in the caption and HLS manifest.
     *
     * @var value-of<WorkflowTranslationLanguageCode> $languageCode
     */
    #[Required('language_code', enum: WorkflowTranslationLanguageCode::class)]
    public string $languageCode;

    /**
     * `new WorkflowTranslation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkflowTranslation::with(languageCode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkflowTranslation)->withLanguageCode(...)
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
     * @param WorkflowTranslationLanguageCode|value-of<WorkflowTranslationLanguageCode> $languageCode
     */
    public static function with(
        WorkflowTranslationLanguageCode|string $languageCode
    ): self {
        $self = new self;

        $self['languageCode'] = $languageCode;

        return $self;
    }

    /**
     * LanguageCode specifies the target language for the translated subtitle track, such as en or fr. The same code appears in the caption and HLS manifest.
     *
     * @param WorkflowTranslationLanguageCode|value-of<WorkflowTranslationLanguageCode> $languageCode
     */
    public function withLanguageCode(
        WorkflowTranslationLanguageCode|string $languageCode
    ): self {
        $self = clone $this;
        $self['languageCode'] = $languageCode;

        return $self;
    }
}
