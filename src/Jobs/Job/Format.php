<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Job;

use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;
use Chunkify\Jobs\Job\Format\JobsHlsAv1;
use Chunkify\Jobs\Job\Format\JobsHlsH264;
use Chunkify\Jobs\Job\Format\JobsHlsH265;
use Chunkify\Jobs\Job\Format\JobsJpg;
use Chunkify\Jobs\Job\Format\JobsMP4Av1;
use Chunkify\Jobs\Job\Format\JobsMP4H264;
use Chunkify\Jobs\Job\Format\JobsMP4H265;
use Chunkify\Jobs\Job\Format\JobsWebmVp9;

/**
 * A template defines the transcoding parameters and settings for a job.
 *
 * @phpstan-import-type JobsMP4Av1Shape from \Chunkify\Jobs\Job\Format\JobsMP4Av1
 * @phpstan-import-type JobsMP4H264Shape from \Chunkify\Jobs\Job\Format\JobsMP4H264
 * @phpstan-import-type JobsMP4H265Shape from \Chunkify\Jobs\Job\Format\JobsMP4H265
 * @phpstan-import-type JobsWebmVp9Shape from \Chunkify\Jobs\Job\Format\JobsWebmVp9
 * @phpstan-import-type JobsHlsAv1Shape from \Chunkify\Jobs\Job\Format\JobsHlsAv1
 * @phpstan-import-type JobsHlsH264Shape from \Chunkify\Jobs\Job\Format\JobsHlsH264
 * @phpstan-import-type JobsHlsH265Shape from \Chunkify\Jobs\Job\Format\JobsHlsH265
 * @phpstan-import-type JobsJpgShape from \Chunkify\Jobs\Job\Format\JobsJpg
 *
 * @phpstan-type FormatVariants = JobsMP4Av1|JobsMP4H264|JobsMP4H265|JobsWebmVp9|JobsHlsAv1|JobsHlsH264|JobsHlsH265|JobsJpg
 * @phpstan-type FormatShape = FormatVariants|JobsMP4Av1Shape|JobsMP4H264Shape|JobsMP4H265Shape|JobsWebmVp9Shape|JobsHlsAv1Shape|JobsHlsH264Shape|JobsHlsH265Shape|JobsJpgShape
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
            'mp4_av1' => JobsMP4Av1::class,
            'mp4_h264' => JobsMP4H264::class,
            'mp4_h265' => JobsMP4H265::class,
            'webm_vp9' => JobsWebmVp9::class,
            'hls_av1' => JobsHlsAv1::class,
            'hls_h264' => JobsHlsH264::class,
            'hls_h265' => JobsHlsH265::class,
            'jpg' => JobsJpg::class,
        ];
    }
}
