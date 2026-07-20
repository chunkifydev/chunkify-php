<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
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
use Chunkify\ServiceContracts\JobsContract;
use Chunkify\Services\Jobs\FilesService;
use Chunkify\Services\Jobs\LogsService;
use Chunkify\Services\Jobs\TranscodersService;

/**
 * @phpstan-import-type FormatShape from \Chunkify\Jobs\JobCreateParams\Format
 * @phpstan-import-type StorageShape from \Chunkify\Jobs\JobCreateParams\Storage
 * @phpstan-import-type TranscoderShape from \Chunkify\Jobs\JobCreateParams\Transcoder
 * @phpstan-import-type CreatedShape from \Chunkify\Jobs\JobListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class JobsService implements JobsContract
{
    /**
     * @api
     */
    public JobsRawService $raw;

    /**
     * @api
     */
    public FilesService $files;

    /**
     * @api
     */
    public LogsService $logs;

    /**
     * @api
     */
    public TranscodersService $transcoders;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new JobsRawService($client);
        $this->files = new FilesService($client);
        $this->logs = new LogsService($client);
        $this->transcoders = new TranscodersService($client);
    }

    /**
     * @api
     *
     * Create a new video processing job with specified parameters
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
    ): Job {
        $params = Util::removeNulls(
            [
                'format' => $format,
                'sourceID' => $sourceID,
                'hlsManifestID' => $hlsManifestID,
                'metadata' => $metadata,
                'storage' => $storage,
                'transcoder' => $transcoder,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve details of a specific job
     *
     * @param string $jobID Job ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): Job {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($jobID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a list of jobs with optional filtering and pagination
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
    ): PaginatedResults {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'created' => $created,
                'formatID' => $formatID,
                'hlsManifestID' => $hlsManifestID,
                'limit' => $limit,
                'metadata' => $metadata,
                'offset' => $offset,
                'sourceID' => $sourceID,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a job.
     *
     * @param string $jobID Job id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($jobID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel a job.
     *
     * @param string $jobID Job id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($jobID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
