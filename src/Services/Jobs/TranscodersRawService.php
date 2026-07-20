<?php

declare(strict_types=1);

namespace Chunkify\Services\Jobs;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Jobs\Transcoders\TranscoderListResponse;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Jobs\TranscodersRawContract;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class TranscodersRawService implements TranscodersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve all the transcoders statuses for a specific job
     *
     * @param string $jobID Job ID to get status for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TranscoderListResponse>
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
            path: ['api/jobs/%1$s/transcoders', $jobID],
            options: $requestOptions,
            convert: TranscoderListResponse::class,
            security: ['projectAccessToken' => true],
        );
    }
}
