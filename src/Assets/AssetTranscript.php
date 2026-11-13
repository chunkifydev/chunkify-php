<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\AssetOutputError;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * An original-language transcript. Content is included in ready output responses and lifecycle event snapshots. Transcripts have no download or CDN URL.
 *
 * @phpstan-import-type AssetTranscriptContentShape from \Chunkify\Assets\AssetTranscriptContent
 * @phpstan-import-type AssetOutputErrorShape from \Chunkify\AssetOutputError
 *
 * @phpstan-type AssetTranscriptShape = array{
 *   id: string,
 *   status: AssetOutputStatus|value-of<AssetOutputStatus>,
 *   content?: null|AssetTranscriptContent|AssetTranscriptContentShape,
 *   error?: null|AssetOutputError|AssetOutputErrorShape,
 *   languageCode?: string|null,
 * }
 */
final class AssetTranscript implements BaseModel
{
    /** @use SdkModel<AssetTranscriptShape> */
    use SdkModel;

    /**
     * Id identifies the Asset output, prefixed with aop_.
     */
    #[Required]
    public string $id;

    /**
     * Status specifies the output processing state. Expired means temporary output files are no longer available.
     *
     * @var value-of<AssetOutputStatus> $status
     */
    #[Required(enum: AssetOutputStatus::class)]
    public string $status;

    /**
     * Content contains the complete text and timed segments. Included when ready; omitted while preparing, failed or expired.
     */
    #[Optional]
    public ?AssetTranscriptContent $content;

    /**
     * A customer-facing Asset output processing failure.
     */
    #[Optional]
    public ?AssetOutputError $error;

    /**
     * LanguageCode identifies the detected primary language, such as en. Omitted before recognition or when no speech is detected.
     */
    #[Optional('language_code')]
    public ?string $languageCode;

    /**
     * `new AssetTranscript()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetTranscript::with(id: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetTranscript)->withID(...)->withStatus(...)
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
     * @param AssetOutputStatus|value-of<AssetOutputStatus> $status
     * @param AssetTranscriptContent|AssetTranscriptContentShape|null $content
     * @param AssetOutputError|AssetOutputErrorShape|null $error
     */
    public static function with(
        string $id,
        AssetOutputStatus|string $status,
        AssetTranscriptContent|array|null $content = null,
        AssetOutputError|array|null $error = null,
        ?string $languageCode = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['status'] = $status;

        null !== $content && $self['content'] = $content;
        null !== $error && $self['error'] = $error;
        null !== $languageCode && $self['languageCode'] = $languageCode;

        return $self;
    }

    /**
     * Id identifies the Asset output, prefixed with aop_.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Status specifies the output processing state. Expired means temporary output files are no longer available.
     *
     * @param AssetOutputStatus|value-of<AssetOutputStatus> $status
     */
    public function withStatus(AssetOutputStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Content contains the complete text and timed segments. Included when ready; omitted while preparing, failed or expired.
     *
     * @param AssetTranscriptContent|AssetTranscriptContentShape $content
     */
    public function withContent(AssetTranscriptContent|array $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * A customer-facing Asset output processing failure.
     *
     * @param AssetOutputError|AssetOutputErrorShape $error
     */
    public function withError(AssetOutputError|array $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * LanguageCode identifies the detected primary language, such as en. Omitted before recognition or when no speech is detected.
     */
    public function withLanguageCode(string $languageCode): self
    {
        $self = clone $this;
        $self['languageCode'] = $languageCode;

        return $self;
    }
}
