<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs\OutputCreateParams\Output\AssetCaptionOutputCreateParams;

use Chunkify\Assets\Outputs\OutputCreateParams\Output\AssetCaptionOutputCreateParams\Params\LanguageCode;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Params specifies the settings for this output type.
 *
 * @phpstan-type ParamsShape = array{
 *   languageCode?: null|LanguageCode|value-of<LanguageCode>,
 *   sourceCaptionID?: string|null,
 * }
 */
final class Params implements BaseModel
{
    /** @use SdkModel<ParamsShape> */
    use SdkModel;

    /**
     * LanguageCode specifies the target language for a translated caption. Supply source_caption_id with this field. Omit both fields to transcribe the Asset audio with automatic language detection.
     *
     * @var value-of<LanguageCode>|null $languageCode
     */
    #[Optional('language_code', enum: LanguageCode::class)]
    public ?string $languageCode;

    /**
     * SourceCaptionId specifies the caption on this Asset to translate. Supply language_code with this field. Omit both fields to generate original captions.
     */
    #[Optional('source_caption_id')]
    public ?string $sourceCaptionID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param LanguageCode|value-of<LanguageCode>|null $languageCode
     */
    public static function with(
        LanguageCode|string|null $languageCode = null,
        ?string $sourceCaptionID = null
    ): self {
        $self = new self;

        null !== $languageCode && $self['languageCode'] = $languageCode;
        null !== $sourceCaptionID && $self['sourceCaptionID'] = $sourceCaptionID;

        return $self;
    }

    /**
     * LanguageCode specifies the target language for a translated caption. Supply source_caption_id with this field. Omit both fields to transcribe the Asset audio with automatic language detection.
     *
     * @param LanguageCode|value-of<LanguageCode> $languageCode
     */
    public function withLanguageCode(LanguageCode|string $languageCode): self
    {
        $self = clone $this;
        $self['languageCode'] = $languageCode;

        return $self;
    }

    /**
     * SourceCaptionId specifies the caption on this Asset to translate. Supply language_code with this field. Omit both fields to generate original captions.
     */
    public function withSourceCaptionID(string $sourceCaptionID): self
    {
        $self = clone $this;
        $self['sourceCaptionID'] = $sourceCaptionID;

        return $self;
    }
}
