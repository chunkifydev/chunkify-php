<?php

declare(strict_types=1);

namespace Chunkify\Jobs\JobCreateParams;

use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;
use Chunkify\Jobs\HlsAv1;
use Chunkify\Jobs\HlsH264;
use Chunkify\Jobs\HlsH265;
use Chunkify\Jobs\Jpg;
use Chunkify\Jobs\MP4Av1;
use Chunkify\Jobs\MP4H264;
use Chunkify\Jobs\MP4H265;
use Chunkify\Jobs\WebmVp9;

/**
 * Required format configuration, one and only one valid format configuration must be provided.
 * If you want to use a format without specifying any configuration, use an empty object in the corresponding field.
 *
 * @phpstan-import-type MP4Av1Shape from \Chunkify\Jobs\MP4Av1
 * @phpstan-import-type MP4H264Shape from \Chunkify\Jobs\MP4H264
 * @phpstan-import-type MP4H265Shape from \Chunkify\Jobs\MP4H265
 * @phpstan-import-type WebmVp9Shape from \Chunkify\Jobs\WebmVp9
 * @phpstan-import-type HlsAv1Shape from \Chunkify\Jobs\HlsAv1
 * @phpstan-import-type HlsH264Shape from \Chunkify\Jobs\HlsH264
 * @phpstan-import-type HlsH265Shape from \Chunkify\Jobs\HlsH265
 * @phpstan-import-type JpgShape from \Chunkify\Jobs\Jpg
 *
 * @phpstan-type FormatVariants = MP4Av1|MP4H264|MP4H265|WebmVp9|HlsAv1|HlsH264|HlsH265|Jpg
 * @phpstan-type FormatShape = FormatVariants|MP4Av1Shape|MP4H264Shape|MP4H265Shape|WebmVp9Shape|HlsAv1Shape|HlsH264Shape|HlsH265Shape|JpgShape
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
            'mp4_av1' => MP4Av1::class,
            'mp4_h264' => MP4H264::class,
            'mp4_h265' => MP4H265::class,
            'webm_vp9' => WebmVp9::class,
            'hls_av1' => HlsAv1::class,
            'hls_h264' => HlsH264::class,
            'hls_h265' => HlsH265::class,
            'jpg' => Jpg::class,
        ];
    }
}
