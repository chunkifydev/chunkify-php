<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs\OutputCreateParams;

use Chunkify\Assets\AssetCaptionOutputCreateParams;
use Chunkify\Assets\AssetStaticRenditionOutputCreateParams;
use Chunkify\Assets\AssetThumbnailOutputCreateParams;
use Chunkify\Assets\AssetTranscriptOutputCreateParams;
use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;

/**
 * Create one output for an Asset. Type selects its required, strictly validated parameters.
 *
 * @phpstan-import-type AssetCaptionOutputCreateParamsShape from \Chunkify\Assets\AssetCaptionOutputCreateParams
 * @phpstan-import-type AssetStaticRenditionOutputCreateParamsShape from \Chunkify\Assets\AssetStaticRenditionOutputCreateParams
 * @phpstan-import-type AssetThumbnailOutputCreateParamsShape from \Chunkify\Assets\AssetThumbnailOutputCreateParams
 * @phpstan-import-type AssetTranscriptOutputCreateParamsShape from \Chunkify\Assets\AssetTranscriptOutputCreateParams
 *
 * @phpstan-type OutputVariants = AssetCaptionOutputCreateParams|AssetStaticRenditionOutputCreateParams|AssetThumbnailOutputCreateParams|AssetTranscriptOutputCreateParams
 * @phpstan-type OutputShape = OutputVariants|AssetCaptionOutputCreateParamsShape|AssetStaticRenditionOutputCreateParamsShape|AssetThumbnailOutputCreateParamsShape|AssetTranscriptOutputCreateParamsShape
 */
final class Output implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'type';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'caption' => AssetCaptionOutputCreateParams::class,
            'static_rendition' => AssetStaticRenditionOutputCreateParams::class,
            'thumbnail' => AssetThumbnailOutputCreateParams::class,
            'transcript' => AssetTranscriptOutputCreateParams::class,
        ];
    }
}
