<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs\OutputCreateParams\Output;

use Chunkify\Assets\Outputs\OutputCreateParams\Output\AssetStaticRenditionOutputCreateParams\Params;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Create an Asset-owned static rendition output.
 *
 * @phpstan-import-type ParamsShape from \Chunkify\Assets\Outputs\OutputCreateParams\Output\AssetStaticRenditionOutputCreateParams\Params
 *
 * @phpstan-type AssetStaticRenditionOutputCreateParamsShape = array{
 *   params: Params|ParamsShape, type: 'static_rendition'
 * }
 */
final class AssetStaticRenditionOutputCreateParams implements BaseModel
{
    /** @use SdkModel<AssetStaticRenditionOutputCreateParamsShape> */
    use SdkModel;

    /**
     * Type specifies the output kind to create.
     *
     * @var 'static_rendition' $type
     */
    #[Required]
    public string $type = 'static_rendition';

    /**
     * Params specifies the settings for this output type.
     */
    #[Required]
    public Params $params;

    /**
     * `new AssetStaticRenditionOutputCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetStaticRenditionOutputCreateParams::with(params: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetStaticRenditionOutputCreateParams)->withParams(...)
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
     * @param Params|ParamsShape $params
     */
    public static function with(Params|array $params): self
    {
        $self = new self;

        $self['params'] = $params;

        return $self;
    }

    /**
     * Params specifies the settings for this output type.
     *
     * @param Params|ParamsShape $params
     */
    public function withParams(Params|array $params): self
    {
        $self = clone $this;
        $self['params'] = $params;

        return $self;
    }

    /**
     * Type specifies the output kind to create.
     *
     * @param 'static_rendition' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
