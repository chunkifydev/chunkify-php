<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingCreateParams;

use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;
use Chunkify\Transcodings\TranscodingCreateParams\Format\M4aAac;
use Chunkify\Transcodings\TranscodingCreateParams\Format\MP4Av1;
use Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H264;
use Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H265;
use Chunkify\Transcodings\TranscodingCreateParams\Format\WebmVp9;

/**
 * Format specifies the requested encoding settings.
 *
 * @phpstan-import-type MP4H264Shape from \Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H264
 * @phpstan-import-type MP4H265Shape from \Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H265
 * @phpstan-import-type MP4Av1Shape from \Chunkify\Transcodings\TranscodingCreateParams\Format\MP4Av1
 * @phpstan-import-type WebmVp9Shape from \Chunkify\Transcodings\TranscodingCreateParams\Format\WebmVp9
 * @phpstan-import-type M4aAacShape from \Chunkify\Transcodings\TranscodingCreateParams\Format\M4aAac
 *
 * @phpstan-type FormatVariants = MP4H264|MP4H265|MP4Av1|WebmVp9|M4aAac
 * @phpstan-type FormatShape = FormatVariants|MP4H264Shape|MP4H265Shape|MP4Av1Shape|WebmVp9Shape|M4aAacShape
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
            'mp4_h264' => MP4H264::class,
            'mp4_h265' => MP4H265::class,
            'mp4_av1' => MP4Av1::class,
            'webm_vp9' => WebmVp9::class,
            'm4a_aac' => M4aAac::class,
        ];
    }
}
