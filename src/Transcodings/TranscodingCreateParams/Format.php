<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingCreateParams;

use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;
use Chunkify\Transcodings\TranscodingM4aAac;
use Chunkify\Transcodings\TranscodingMP4Av1;
use Chunkify\Transcodings\TranscodingMP4H264;
use Chunkify\Transcodings\TranscodingMP4H265;
use Chunkify\Transcodings\TranscodingWebmVp9;

/**
 * Format specifies the requested encoding settings.
 *
 * @phpstan-import-type TranscodingMP4H264Shape from \Chunkify\Transcodings\TranscodingMP4H264
 * @phpstan-import-type TranscodingMP4H265Shape from \Chunkify\Transcodings\TranscodingMP4H265
 * @phpstan-import-type TranscodingMP4Av1Shape from \Chunkify\Transcodings\TranscodingMP4Av1
 * @phpstan-import-type TranscodingWebmVp9Shape from \Chunkify\Transcodings\TranscodingWebmVp9
 * @phpstan-import-type TranscodingM4aAacShape from \Chunkify\Transcodings\TranscodingM4aAac
 *
 * @phpstan-type FormatVariants = TranscodingMP4H264|TranscodingMP4H265|TranscodingMP4Av1|TranscodingWebmVp9|TranscodingM4aAac
 * @phpstan-type FormatShape = FormatVariants|TranscodingMP4H264Shape|TranscodingMP4H265Shape|TranscodingMP4Av1Shape|TranscodingWebmVp9Shape|TranscodingM4aAacShape
 */
final class Format implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'id';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'mp4_h264' => TranscodingMP4H264::class,
            'mp4_h265' => TranscodingMP4H265::class,
            'mp4_av1' => TranscodingMP4Av1::class,
            'webm_vp9' => TranscodingWebmVp9::class,
            'm4a_aac' => TranscodingM4aAac::class,
        ];
    }
}
