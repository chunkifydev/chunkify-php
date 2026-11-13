<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Create an Asset-owned static rendition output.
 *
 * @phpstan-import-type AssetStaticRenditionCreateParamsShape from \Chunkify\Assets\AssetStaticRenditionCreateParams
 *
 * @phpstan-type AssetStaticRenditionOutputCreateParamsShape = array{
 *   params: AssetStaticRenditionCreateParams|AssetStaticRenditionCreateParamsShape,
 *   type: 'static_rendition',
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
    public AssetStaticRenditionCreateParams $params;

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
     * @param AssetStaticRenditionCreateParams|AssetStaticRenditionCreateParamsShape $params
     */
    public static function with(
        AssetStaticRenditionCreateParams|array $params
    ): self {
        $self = new self;

        $self['params'] = $params;

        return $self;
    }

    /**
     * Params specifies the settings for this output type.
     *
     * @param AssetStaticRenditionCreateParams|AssetStaticRenditionCreateParamsShape $params
     */
    public function withParams(
        AssetStaticRenditionCreateParams|array $params
    ): self {
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
