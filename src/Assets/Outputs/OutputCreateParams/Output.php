<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs\OutputCreateParams;

use Chunkify\Assets\Outputs\OutputCreateParams\Output\AssetCaptionOutputCreateParams;
use Chunkify\Assets\Outputs\OutputCreateParams\Output\AssetStaticRenditionOutputCreateParams;
use Chunkify\Assets\Outputs\OutputCreateParams\Output\AssetThumbnailOutputCreateParams;
use Chunkify\Assets\Outputs\OutputCreateParams\Output\AssetTranscriptOutputCreateParams;
use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;

/**
 * Create one output for an Asset. Type selects its required, strictly validated parameters.
 *
 * @phpstan-import-type AssetCaptionOutputCreateParamsShape from \Chunkify\Assets\Outputs\OutputCreateParams\Output\AssetCaptionOutputCreateParams
 * @phpstan-import-type AssetStaticRenditionOutputCreateParamsShape from \Chunkify\Assets\Outputs\OutputCreateParams\Output\AssetStaticRenditionOutputCreateParams
 * @phpstan-import-type AssetThumbnailOutputCreateParamsShape from \Chunkify\Assets\Outputs\OutputCreateParams\Output\AssetThumbnailOutputCreateParams
 * @phpstan-import-type AssetTranscriptOutputCreateParamsShape from \Chunkify\Assets\Outputs\OutputCreateParams\Output\AssetTranscriptOutputCreateParams
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
