<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs\OutputCreateParams\Output;

use Chunkify\Assets\Outputs\OutputCreateParams\Output\AssetThumbnailOutputCreateParams\Params;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Create an Asset-owned thumbnail output.
 *
 * @phpstan-import-type ParamsShape from \Chunkify\Assets\Outputs\OutputCreateParams\Output\AssetThumbnailOutputCreateParams\Params
 *
 * @phpstan-type AssetThumbnailOutputCreateParamsShape = array{
 *   params: Params|ParamsShape, type: 'thumbnail'
 * }
 */
final class AssetThumbnailOutputCreateParams implements BaseModel
{
    /** @use SdkModel<AssetThumbnailOutputCreateParamsShape> */
    use SdkModel;

    /**
     * Type specifies the output kind to create.
     *
     * @var 'thumbnail' $type
     */
    #[Required]
    public string $type = 'thumbnail';

    /**
     * Params specifies the settings for this output type.
     */
    #[Required]
    public Params $params;

    /**
     * `new AssetThumbnailOutputCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetThumbnailOutputCreateParams::with(params: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetThumbnailOutputCreateParams)->withParams(...)
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
     * @param 'thumbnail' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
