<?php

declare(strict_types=1);

namespace Chunkify\Assets\Workflow\AssetActionRun;

use Chunkify\Assets\Workflow\AssetActionRun\Input\LanguageCode;
use Chunkify\Assets\Workflow\AssetActionRun\Input\Resolution;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\WorkflowThumbnailParams;

/**
 * Resolved parameters and input references for this execution.
 *
 * @phpstan-import-type WorkflowThumbnailParamsShape from \Chunkify\Workflows\WorkflowThumbnailParams
 *
 * @phpstan-type InputShape = array{
 *   languageCode?: null|LanguageCode|value-of<LanguageCode>,
 *   resolution?: null|Resolution|value-of<Resolution>,
 *   sourceCaptionID?: string|null,
 *   thumbnails?: null|WorkflowThumbnailParams|WorkflowThumbnailParamsShape,
 *   transcriptID?: string|null,
 * }
 */
final class Input implements BaseModel
{
    /** @use SdkModel<InputShape> */
    use SdkModel;

    /**
     * LanguageCode specifies the target language for the translated subtitle track, such as en or fr. The same code appears in the caption and HLS manifest.
     *
     * @var value-of<LanguageCode>|null $languageCode
     */
    #[Optional('language_code', enum: LanguageCode::class)]
    public ?string $languageCode;

    /**
     * Resolution specifies the H.264 MP4 output resolution. highest selects the largest supported output without upscaling.
     * Hobby supports up to 1080p; other plans support up to 2160p. Streaming resolution limits do not apply.
     *
     * @var value-of<Resolution>|null $resolution
     */
    #[Optional(enum: Resolution::class)]
    public ?string $resolution;

    /**
     * ID of the original caption to translate. Included only for translation actions.
     */
    #[Optional('source_caption_id')]
    public ?string $sourceCaptionID;

    /**
     * Thumbnail settings. Included only for create_thumbnails actions.
     */
    #[Optional]
    public ?WorkflowThumbnailParams $thumbnails;

    /**
     * TranscriptId specifies the original transcript consumed by caption publication. Omitted for actions without a transcript input.
     */
    #[Optional('transcript_id')]
    public ?string $transcriptID;

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
     * @param Resolution|value-of<Resolution>|null $resolution
     * @param WorkflowThumbnailParams|WorkflowThumbnailParamsShape|null $thumbnails
     */
    public static function with(
        LanguageCode|string|null $languageCode = null,
        Resolution|string|null $resolution = null,
        ?string $sourceCaptionID = null,
        WorkflowThumbnailParams|array|null $thumbnails = null,
        ?string $transcriptID = null,
    ): self {
        $self = new self;

        null !== $languageCode && $self['languageCode'] = $languageCode;
        null !== $resolution && $self['resolution'] = $resolution;
        null !== $sourceCaptionID && $self['sourceCaptionID'] = $sourceCaptionID;
        null !== $thumbnails && $self['thumbnails'] = $thumbnails;
        null !== $transcriptID && $self['transcriptID'] = $transcriptID;

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

    /**
     * Resolution specifies the H.264 MP4 output resolution. highest selects the largest supported output without upscaling.
     * Hobby supports up to 1080p; other plans support up to 2160p. Streaming resolution limits do not apply.
     *
     * @param Resolution|value-of<Resolution> $resolution
     */
    public function withResolution(Resolution|string $resolution): self
    {
        $self = clone $this;
        $self['resolution'] = $resolution;

        return $self;
    }

    /**
     * ID of the original caption to translate. Included only for translation actions.
     */
    public function withSourceCaptionID(string $sourceCaptionID): self
    {
        $self = clone $this;
        $self['sourceCaptionID'] = $sourceCaptionID;

        return $self;
    }

    /**
     * Thumbnail settings. Included only for create_thumbnails actions.
     *
     * @param WorkflowThumbnailParams|WorkflowThumbnailParamsShape $thumbnails
     */
    public function withThumbnails(
        WorkflowThumbnailParams|array $thumbnails
    ): self {
        $self = clone $this;
        $self['thumbnails'] = $thumbnails;

        return $self;
    }

    /**
     * TranscriptId specifies the original transcript consumed by caption publication. Omitted for actions without a transcript input.
     */
    public function withTranscriptID(string $transcriptID): self
    {
        $self = clone $this;
        $self['transcriptID'] = $transcriptID;

        return $self;
    }
}
