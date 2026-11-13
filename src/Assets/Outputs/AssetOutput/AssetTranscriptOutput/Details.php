<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs\AssetOutput\AssetTranscriptOutput;

use Chunkify\AssetOutputError;
use Chunkify\Assets\Outputs\AssetOutput\AssetTranscriptOutput\Details\Content;
use Chunkify\Assets\Outputs\AssetOutput\AssetTranscriptOutput\Details\Status;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * An original-language transcript. Content is included in ready output responses and lifecycle event snapshots. Transcripts have no download or CDN URL.
 *
 * @phpstan-import-type ContentShape from \Chunkify\Assets\Outputs\AssetOutput\AssetTranscriptOutput\Details\Content
 * @phpstan-import-type AssetOutputErrorShape from \Chunkify\AssetOutputError
 *
 * @phpstan-type DetailsShape = array{
 *   id: string,
 *   status: \Chunkify\Assets\Outputs\AssetOutput\AssetTranscriptOutput\Details\Status|value-of<\Chunkify\Assets\Outputs\AssetOutput\AssetTranscriptOutput\Details\Status>,
 *   content?: null|Content|ContentShape,
 *   error?: null|AssetOutputError|AssetOutputErrorShape,
 *   languageCode?: string|null,
 * }
 */
final class Details implements BaseModel
{
    /** @use SdkModel<DetailsShape> */
    use SdkModel;

    /**
     * Id identifies the Asset output, prefixed with aop_.
     */
    #[Required]
    public string $id;

    /**
     * Status specifies the output processing state. Expired means temporary output files are no longer available.
     *
     * @var value-of<Status> $status
     */
    #[Required(
        enum: Status::class,
    )]
    public string $status;

    /**
     * Content contains the complete text and timed segments. Included when ready; omitted while preparing, failed or expired.
     */
    #[Optional]
    public ?Content $content;

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
     * @param Content|ContentShape|null $content
     * @param AssetOutputError|AssetOutputErrorShape|null $error
     */
    public static function with(
        string $id,
        Status|string $status,
        Content|array|null $content = null,
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
     * Content contains the complete text and timed segments. Included when ready; omitted while preparing, failed or expired.
     *
     * @param Content|ContentShape $content
     */
    public function withContent(Content|array $content): self
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
