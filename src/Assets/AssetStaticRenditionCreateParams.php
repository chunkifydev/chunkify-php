<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Assets\AssetStaticRenditionCreateParams\Resolution;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Parameters for an independently processed H.264 MP4 rendition.
 *
 * @phpstan-type AssetStaticRenditionCreateParamsShape = array{
 *   resolution: Resolution|value-of<Resolution>
 * }
 */
final class AssetStaticRenditionCreateParams implements BaseModel
{
    /** @use SdkModel<AssetStaticRenditionCreateParamsShape> */
    use SdkModel;

    /**
     * H.264 MP4 resolution. highest selects the largest supported output without upscaling. Hobby supports up to 1080p; other plans support up to 2160p. Independent of the streaming resolution limits.
     *
     * @var value-of<Resolution> $resolution
     */
    #[Required(enum: Resolution::class)]
    public string $resolution;

    /**
     * `new AssetStaticRenditionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetStaticRenditionCreateParams::with(resolution: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetStaticRenditionCreateParams)->withResolution(...)
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
     * @param Resolution|value-of<Resolution> $resolution
     */
    public static function with(Resolution|string $resolution): self
    {
        $self = new self;

        $self['resolution'] = $resolution;

        return $self;
    }

    /**
     * H.264 MP4 resolution. highest selects the largest supported output without upscaling. Hobby supports up to 1080p; other plans support up to 2160p. Independent of the streaming resolution limits.
     *
     * @param Resolution|value-of<Resolution> $resolution
     */
    public function withResolution(Resolution|string $resolution): self
    {
        $self = clone $this;
        $self['resolution'] = $resolution;

        return $self;
    }
}
