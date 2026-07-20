<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\Jobs\HlsAv1;
use Chunkify\Jobs\HlsH264;
use Chunkify\Jobs\HlsH265;
use Chunkify\Jobs\Job;
use Chunkify\Jobs\JobCreateParams\Storage;
use Chunkify\Jobs\JobCreateParams\Transcoder;
use Chunkify\Jobs\JobListParams\Created;
use Chunkify\Jobs\JobListParams\FormatID;
use Chunkify\Jobs\JobListParams\Status;
use Chunkify\Jobs\Jpg;
use Chunkify\Jobs\MP4Av1;
use Chunkify\Jobs\MP4H264;
use Chunkify\Jobs\MP4H265;
use Chunkify\Jobs\WebmVp9;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type FormatShape from \Chunkify\Jobs\JobCreateParams\Format
 * @phpstan-import-type StorageShape from \Chunkify\Jobs\JobCreateParams\Storage
 * @phpstan-import-type TranscoderShape from \Chunkify\Jobs\JobCreateParams\Transcoder
 * @phpstan-import-type CreatedShape from \Chunkify\Jobs\JobListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface JobsContract
{
    /**
     * @api
     *
     * @param FormatShape $format Required format configuration, one and only one valid format configuration must be provided.
     * If you want to use a format without specifying any configuration, use an empty object in the corresponding field.
     * @param string $sourceID The ID of the source file to transcode
     * @param string $hlsManifestID Optional HLS manifest configuration
     * Use the same hls manifest ID to group multiple jobs into a single HLS manifest
     * By default, it's automatically generated if no set for HLS jobs
     * @param array<string,string> $metadata Optional metadata to attach to the job, the maximum size allowed is 2048 bytes
     * @param Storage|StorageShape $storage Optional storage configuration
     * @param Transcoder|TranscoderShape $transcoder Optional transcoder configuration. If not provided, the system will automatically
     * calculate the optimal quantity and CPU type based on the source file specifications
     * and output requirements. This auto-scaling ensures efficient resource utilization.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        MP4Av1|array|MP4H264|MP4H265|WebmVp9|HlsAv1|HlsH264|HlsH265|Jpg $format,
        string $sourceID,
        ?string $hlsManifestID = null,
        ?array $metadata = null,
        Storage|array|null $storage = null,
        Transcoder|array|null $transcoder = null,
        RequestOptions|array|null $requestOptions = null,
    ): Job;

    /**
     * @api
     *
     * @param string $jobID Job ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): Job;

    /**
     * @api
     *
     * @param string $id Filter by job ID
     * @param Created|CreatedShape $created
     * @param FormatID|value-of<FormatID> $formatID Filter by format id
     * @param string $hlsManifestID Filter by hls manifest ID
     * @param int $limit Pagination limit
     * @param list<list<string>> $metadata Filter by metadata
     * @param int $offset Pagination offset
     * @param string $sourceID Filter by source ID
     * @param Status|value-of<Status> $status Filter by job status
     * @param RequestOpts|null $requestOptions
     *
     * @return PaginatedResults<Job>
     *
     * @throws APIException
     */
    public function list(
        ?string $id = null,
        Created|array|null $created = null,
        FormatID|string|null $formatID = null,
        ?string $hlsManifestID = null,
        int $limit = 100,
        ?array $metadata = null,
        int $offset = 0,
        ?string $sourceID = null,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults;

    /**
     * @api
     *
     * @param string $jobID Job id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $jobID Job id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
