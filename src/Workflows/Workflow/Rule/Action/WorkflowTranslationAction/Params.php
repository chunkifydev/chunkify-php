<?php

declare(strict_types=1);

namespace Chunkify\Workflows\Workflow\Rule\Action\WorkflowTranslationAction;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\Workflow\Rule\Action\WorkflowTranslationAction\Params\LanguageCode;

/**
 * Params specifies the target language.
 *
 * @phpstan-type ParamsShape = array{
 *   languageCode: LanguageCode|value-of<LanguageCode>
 * }
 */
final class Params implements BaseModel
{
    /** @use SdkModel<ParamsShape> */
    use SdkModel;

    /**
     * LanguageCode specifies the target language for the translated subtitle track, such as en or fr. The same code appears in the caption and HLS manifest.
     *
     * @var value-of<LanguageCode> $languageCode
     */
    #[Required('language_code', enum: LanguageCode::class)]
    public string $languageCode;

    /**
     * `new Params()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Params::with(languageCode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Params)->withLanguageCode(...)
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
     * @param LanguageCode|value-of<LanguageCode> $languageCode
     */
    public static function with(LanguageCode|string $languageCode): self
    {
        $self = new self;

        $self['languageCode'] = $languageCode;

        return $self;
    }

    /**
     * LanguageCode specifies the target language for the translated subtitle track, such as en or fr. The same code appears in the caption and HLS manifest.
     *
     * @param LanguageCode|value-of<LanguageCode> $languageCode
     */
    public function withLanguageCode(LanguageCode|string $languageCode): self
    {
        $self = clone $this;
        $self['languageCode'] = $languageCode;

        return $self;
    }
}
