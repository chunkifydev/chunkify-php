<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Create an Asset-owned caption output.
 *
 * @phpstan-import-type AssetCaptionOutputParamsShape from \Chunkify\Assets\AssetCaptionOutputParams
 *
 * @phpstan-type AssetCaptionOutputCreateParamsShape = array{
 *   params: AssetCaptionOutputParams|AssetCaptionOutputParamsShape,
 *   type: 'caption',
 * }
 */
final class AssetCaptionOutputCreateParams implements BaseModel
{
    /** @use SdkModel<AssetCaptionOutputCreateParamsShape> */
    use SdkModel;

    /**
     * Type specifies the output kind to create.
     *
     * @var 'caption' $type
     */
    #[Required]
    public string $type = 'caption';

    /**
     * Params specifies the settings for this output type.
     */
    #[Required]
    public AssetCaptionOutputParams $params;

    /**
     * `new AssetCaptionOutputCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetCaptionOutputCreateParams::with(params: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetCaptionOutputCreateParams)->withParams(...)
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
     * @param AssetCaptionOutputParams|AssetCaptionOutputParamsShape $params
     */
    public static function with(AssetCaptionOutputParams|array $params): self
    {
        $self = new self;

        $self['params'] = $params;

        return $self;
    }

    /**
     * Params specifies the settings for this output type.
     *
     * @param AssetCaptionOutputParams|AssetCaptionOutputParamsShape $params
     */
    public function withParams(AssetCaptionOutputParams|array $params): self
    {
        $self = clone $this;
        $self['params'] = $params;

        return $self;
    }

    /**
     * Type specifies the output kind to create.
     *
     * @param 'caption' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
