<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Create or reuse the original-language transcript for an Asset. Caption generation shares this transcript and its speech-recognition charge.
 *
 * @phpstan-import-type AssetTranscriptOutputParamsShape from \Chunkify\Assets\AssetTranscriptOutputParams
 *
 * @phpstan-type AssetTranscriptOutputCreateParamsShape = array{
 *   params: AssetTranscriptOutputParams|AssetTranscriptOutputParamsShape,
 *   type: 'transcript',
 * }
 */
final class AssetTranscriptOutputCreateParams implements BaseModel
{
    /** @use SdkModel<AssetTranscriptOutputCreateParamsShape> */
    use SdkModel;

    /**
     * Type specifies the output kind.
     *
     * @var 'transcript' $type
     */
    #[Required]
    public string $type = 'transcript';

    /**
     * Parameters for an original-language transcript. Pass an empty object; the spoken language is detected automatically.
     */
    #[Required]
    public AssetTranscriptOutputParams $params;

    /**
     * `new AssetTranscriptOutputCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetTranscriptOutputCreateParams::with(params: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetTranscriptOutputCreateParams)->withParams(...)
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
     * @param AssetTranscriptOutputParams|AssetTranscriptOutputParamsShape $params
     */
    public static function with(AssetTranscriptOutputParams|array $params): self
    {
        $self = new self;

        $self['params'] = $params;

        return $self;
    }

    /**
     * Parameters for an original-language transcript. Pass an empty object; the spoken language is detected automatically.
     *
     * @param AssetTranscriptOutputParams|AssetTranscriptOutputParamsShape $params
     */
    public function withParams(AssetTranscriptOutputParams|array $params): self
    {
        $self = clone $this;
        $self['params'] = $params;

        return $self;
    }

    /**
     * Type specifies the output kind.
     *
     * @param 'transcript' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
