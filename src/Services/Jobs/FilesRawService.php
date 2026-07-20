<?php

declare(strict_types=1);

namespace Chunkify\Services\Jobs;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Jobs\Files\FileListResponse;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Jobs\FilesRawContract;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class FilesRawService implements FilesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve all files associated with a specific job
     *
     * @param string $jobID Job ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/jobs/%1$s/files', $jobID],
            options: $requestOptions,
            convert: FileListResponse::class,
            security: ['projectAccessToken' => true],
        );
    }
}
