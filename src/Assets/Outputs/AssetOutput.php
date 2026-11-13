<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs;

use Chunkify\Assets\AssetCaptionOutput;
use Chunkify\Assets\AssetStaticRenditionOutput;
use Chunkify\Assets\AssetThumbnailOutput;
use Chunkify\Assets\AssetTranscriptOutput;
use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;

/**
 * A resource produced for an Asset, requested directly or by a Workflow. Its type selects the details schema. Output state is independent of Asset playback readiness.
 *
 * @phpstan-import-type AssetCaptionOutputShape from \Chunkify\Assets\AssetCaptionOutput
 * @phpstan-import-type AssetStaticRenditionOutputShape from \Chunkify\Assets\AssetStaticRenditionOutput
 * @phpstan-import-type AssetThumbnailOutputShape from \Chunkify\Assets\AssetThumbnailOutput
 * @phpstan-import-type AssetTranscriptOutputShape from \Chunkify\Assets\AssetTranscriptOutput
 *
 * @phpstan-type AssetOutputVariants = AssetCaptionOutput|AssetStaticRenditionOutput|AssetThumbnailOutput|AssetTranscriptOutput
 * @phpstan-type AssetOutputShape = AssetOutputVariants|AssetCaptionOutputShape|AssetStaticRenditionOutputShape|AssetThumbnailOutputShape|AssetTranscriptOutputShape
 */
final class AssetOutput implements ConverterSource
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
            'caption' => AssetCaptionOutput::class,
            'static_rendition' => AssetStaticRenditionOutput::class,
            'thumbnail' => AssetThumbnailOutput::class,
            'transcript' => AssetTranscriptOutput::class,
        ];
    }
}
