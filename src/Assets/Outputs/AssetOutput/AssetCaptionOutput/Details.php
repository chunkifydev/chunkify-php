<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs\AssetOutput\AssetCaptionOutput;

use Chunkify\Assets\Outputs\AssetOutput\AssetCaptionOutput\Details\Error;
use Chunkify\Assets\Outputs\AssetOutput\AssetCaptionOutput\Details\Status;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Details contains the canonical typed output resource, including its available delivery fields.
 *
 * @phpstan-import-type ErrorShape from \Chunkify\Assets\Outputs\AssetOutput\AssetCaptionOutput\Details\Error
 *
 * @phpstan-type DetailsShape = array{
 *   id: string,
 *   status: \Chunkify\Assets\Outputs\AssetOutput\AssetCaptionOutput\Details\Status|value-of<\Chunkify\Assets\Outputs\AssetOutput\AssetCaptionOutput\Details\Status>,
 *   createdAt?: \DateTimeInterface|null,
 *   error?: null|Error|ErrorShape,
 *   languageCode?: string|null,
 *   playlistPath?: string|null,
 *   size?: int|null,
 *   sourceCaptionID?: string|null,
 *   transcriptID?: string|null,
 *   vttPath?: string|null,
 * }
 */
final class Details implements BaseModel
{
    /** @use SdkModel<DetailsShape> */
    use SdkModel;

    /**
     * Unique Asset output ID, prefixed with aop_.
     */
    #[Required]
    public string $id;

    /**
     * Caption processing status.
     *
     * @var value-of<Status> $status
     */
    #[Required(
        enum: Status::class,
    )]
    public string $status;

    /**
     * Time this caption output was requested.
     */
    #[Optional('created_at')]
    public ?\DateTimeInterface $createdAt;

    /**
     * Reason caption processing failed.
     */
    #[Optional]
    public ?Error $error;

    /**
     * Primary language of this subtitle track, such as en or fr. Omitted when no speech was detected or processing has not finished.
     */
    #[Optional('language_code')]
    public ?string $languageCode;

    /**
     * Subtitle media playlist path in Storage. Available when speech was detected.
     */
    #[Optional('playlist_path')]
    public ?string $playlistPath;

    /**
     * Combined subtitle playlist and WebVTT size in bytes. Available when ready.
     */
    #[Optional]
    public ?int $size;

    /**
     * ID of the caption track translated to create this track. Omitted for speech transcription.
     */
    #[Optional('source_caption_id')]
    public ?string $sourceCaptionID;

    /**
     * TranscriptId identifies the original-language transcript used to generate this caption. Omitted for translated captions.
     */
    #[Optional('transcript_id')]
    public ?string $transcriptID;

    /**
     * WebVTT subtitle segment path in Storage. Available when speech was detected.
     */
    #[Optional('vtt_path')]
    public ?string $vttPath;

    /**
     * `new Details()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Details::with(id: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Details)->withID(...)->withStatus(...)
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
     * @param Status|value-of<Status> $status
     * @param Error|ErrorShape|null $error
     */
    public static function with(
        string $id,
        Status|string $status,
        ?\DateTimeInterface $createdAt = null,
        Error|array|null $error = null,
        ?string $languageCode = null,
        ?string $playlistPath = null,
        ?int $size = null,
        ?string $sourceCaptionID = null,
        ?string $transcriptID = null,
        ?string $vttPath = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['status'] = $status;

        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $error && $self['error'] = $error;
        null !== $languageCode && $self['languageCode'] = $languageCode;
        null !== $playlistPath && $self['playlistPath'] = $playlistPath;
        null !== $size && $self['size'] = $size;
        null !== $sourceCaptionID && $self['sourceCaptionID'] = $sourceCaptionID;
        null !== $transcriptID && $self['transcriptID'] = $transcriptID;
        null !== $vttPath && $self['vttPath'] = $vttPath;

        return $self;
    }

    /**
     * Unique Asset output ID, prefixed with aop_.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Caption processing status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(
        Status|string $status,
    ): self {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Time this caption output was requested.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Reason caption processing failed.
     *
     * @param Error|ErrorShape $error
     */
    public function withError(Error|array $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Primary language of this subtitle track, such as en or fr. Omitted when no speech was detected or processing has not finished.
     */
    public function withLanguageCode(string $languageCode): self
    {
        $self = clone $this;
        $self['languageCode'] = $languageCode;

        return $self;
    }

    /**
     * Subtitle media playlist path in Storage. Available when speech was detected.
     */
    public function withPlaylistPath(string $playlistPath): self
    {
        $self = clone $this;
        $self['playlistPath'] = $playlistPath;

        return $self;
    }

    /**
     * Combined subtitle playlist and WebVTT size in bytes. Available when ready.
     */
    public function withSize(int $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * ID of the caption track translated to create this track. Omitted for speech transcription.
     */
    public function withSourceCaptionID(string $sourceCaptionID): self
    {
        $self = clone $this;
        $self['sourceCaptionID'] = $sourceCaptionID;

        return $self;
    }

    /**
     * TranscriptId identifies the original-language transcript used to generate this caption. Omitted for translated captions.
     */
    public function withTranscriptID(string $transcriptID): self
    {
        $self = clone $this;
        $self['transcriptID'] = $transcriptID;

        return $self;
    }

    /**
     * WebVTT subtitle segment path in Storage. Available when speech was detected.
     */
    public function withVttPath(string $vttPath): self
    {
        $self = clone $this;
        $self['vttPath'] = $vttPath;

        return $self;
    }
}
