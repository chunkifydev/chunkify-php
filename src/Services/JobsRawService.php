<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\Jobs\Job;
use Chunkify\Jobs\JobCreateParams;
use Chunkify\Jobs\JobCreateParams\Storage;
use Chunkify\Jobs\JobCreateParams\Transcoder;
use Chunkify\Jobs\JobListParams;
use Chunkify\Jobs\JobListParams\Created;
use Chunkify\Jobs\JobListParams\FormatID;
use Chunkify\Jobs\JobListParams\Status;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\JobsRawContract;

/**
 * @phpstan-import-type FormatShape from \Chunkify\Jobs\JobCreateParams\Format
 * @phpstan-import-type StorageShape from \Chunkify\Jobs\JobCreateParams\Storage
 * @phpstan-import-type TranscoderShape from \Chunkify\Jobs\JobCreateParams\Transcoder
 * @phpstan-import-type CreatedShape from \Chunkify\Jobs\JobListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class JobsRawService implements JobsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @deprecated
     *
     * @api
     *
     * Create a new video processing job with specified parameters. The job is created with pending status and waits for scheduler admission before processing. Pending jobs are admitted oldest first across all projects in the team as vCPU capacity becomes available. Deprecated: Jobs are a legacy resource. Use Assets, Transcodings or Thumbnails instead.
     *
     * @param array{
     *   format: FormatShape,
     *   sourceID: string,
     *   hlsManifestID?: string,
     *   metadata?: array<string,string>,
     *   storage?: Storage|StorageShape,
     *   transcoder?: Transcoder|TranscoderShape,
     * }|JobCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Job>
     *
     * @throws APIException
     */
    public function create(
        array|JobCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = JobCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'jobs',
            body: (object) $parsed,
            unwrap: 'data',
            options: $options,
            convert: Job::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @deprecated
     *
     * @api
     *
     * Retrieve details of a specific job. Deprecated: Jobs are a legacy resource. Use Assets, Transcodings or Thumbnails instead.
     *
     * @param string $jobID Job ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Job>
     *
     * @throws APIException
     */
    public function retrieve(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['jobs/%1$s', $jobID],
            unwrap: 'data',
            options: $requestOptions,
            convert: Job::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @deprecated
     *
     * @api
     *
     * Retrieve a list of jobs with optional filtering and pagination. Deprecated: Jobs are a legacy resource. Use Assets, Transcodings or Thumbnails instead.
     *
     * @param array{
     *   id?: string,
     *   created?: Created|CreatedShape,
     *   formatID?: value-of<FormatID>,
     *   hlsManifestID?: string,
     *   limit?: int,
     *   metadata?: list<list<string>>,
     *   offset?: int,
     *   sourceID?: string,
     *   status?: Status|value-of<Status>,
     * }|JobListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Job>>
     *
     * @throws APIException
     */
    public function list(
        array|JobListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = JobListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'jobs',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'formatID' => 'format_id',
                    'hlsManifestID' => 'hls_manifest_id',
                    'sourceID' => 'source_id',
                ],
            ),
            options: $options,
            convert: Job::class,
            page: PaginatedResults::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @deprecated
     *
     * @api
     *
     * Delete a job. Deprecated: Jobs are a legacy resource. Use Assets, Transcodings or Thumbnails instead.
     *
     * @param string $jobID Job id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['jobs/%1$s', $jobID],
            options: $requestOptions,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @deprecated
     *
     * @api
     *
     * Cancel a job. Deprecated: Jobs are a legacy resource. Use Assets, Transcodings or Thumbnails instead.
     *
     * @param string $jobID Job id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function cancel(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['jobs/%1$s/cancel', $jobID],
            options: $requestOptions,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }
}
