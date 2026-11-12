<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricsUsage\Summary;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Caption processing usage.
 *
 * @phpstan-type CaptionsShape = array{
 *   transcriptionSeconds: int, translationSeconds: int
 * }
 */
final class Captions implements BaseModel
{
    /** @use SdkModel<CaptionsShape> */
    use SdkModel;

    /**
     * TranscriptionSeconds specifies audio duration transcribed.
     */
    #[Required('transcription_seconds')]
    public int $transcriptionSeconds;

    /**
     * TranslationSeconds specifies caption duration translated, counted once per target language.
     */
    #[Required('translation_seconds')]
    public int $translationSeconds;

    /**
     * `new Captions()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Captions::with(transcriptionSeconds: ..., translationSeconds: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Captions)->withTranscriptionSeconds(...)->withTranslationSeconds(...)
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
    public static function with(
        int $transcriptionSeconds,
        int $translationSeconds
    ): self {
        $self = new self;

        $self['transcriptionSeconds'] = $transcriptionSeconds;
        $self['translationSeconds'] = $translationSeconds;

        return $self;
    }

    /**
     * TranscriptionSeconds specifies audio duration transcribed.
     */
    public function withTranscriptionSeconds(int $transcriptionSeconds): self
    {
        $self = clone $this;
        $self['transcriptionSeconds'] = $transcriptionSeconds;

        return $self;
    }

    /**
     * TranslationSeconds specifies caption duration translated, counted once per target language.
     */
    public function withTranslationSeconds(int $translationSeconds): self
    {
        $self = clone $this;
        $self['translationSeconds'] = $translationSeconds;

        return $self;
    }
}
