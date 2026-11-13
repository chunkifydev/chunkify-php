<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs;

use Chunkify\Assets\AssetCaptionOutputCreateParams;
use Chunkify\Assets\AssetStaticRenditionOutputCreateParams;
use Chunkify\Assets\AssetThumbnailOutputCreateParams;
use Chunkify\Assets\AssetTranscriptOutputCreateParams;
use Chunkify\Assets\Outputs\OutputCreateParams\Output;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Create one caption, static rendition or additional thumbnail output. The accepted output processes asynchronously and is returned in the same envelope as output reads.
 *
 * @see Chunkify\Services\Assets\OutputsService::create()
 *
 * @phpstan-import-type OutputVariants from \Chunkify\Assets\Outputs\OutputCreateParams\Output
 * @phpstan-import-type OutputShape from \Chunkify\Assets\Outputs\OutputCreateParams\Output
 *
 * @phpstan-type OutputCreateParamsShape = array{output: OutputShape}
 */
final class OutputCreateParams implements BaseModel
{
    /** @use SdkModel<OutputCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Create one output for an Asset. Type selects its required, strictly validated parameters.
     *
     * @var OutputVariants $output
     */
    #[Required(union: Output::class)]
    public AssetCaptionOutputCreateParams|AssetStaticRenditionOutputCreateParams|AssetThumbnailOutputCreateParams|AssetTranscriptOutputCreateParams $output;

    /**
     * `new OutputCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OutputCreateParams::with(output: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OutputCreateParams)->withOutput(...)
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
     * @param OutputShape $output
     */
    public static function with(
        AssetCaptionOutputCreateParams|array|AssetStaticRenditionOutputCreateParams|AssetThumbnailOutputCreateParams|AssetTranscriptOutputCreateParams $output,
    ): self {
        $self = new self;

        $self['output'] = $output;

        return $self;
    }

    /**
     * Create one output for an Asset. Type selects its required, strictly validated parameters.
     *
     * @param OutputShape $output
     */
    public function withOutput(
        AssetCaptionOutputCreateParams|array|AssetStaticRenditionOutputCreateParams|AssetThumbnailOutputCreateParams|AssetTranscriptOutputCreateParams $output,
    ): self {
        $self = clone $this;
        $self['output'] = $output;

        return $self;
    }
}
