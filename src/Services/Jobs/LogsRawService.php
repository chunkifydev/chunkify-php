<?php

declare(strict_types=1);

namespace Chunkify\Services\Jobs;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\Jobs\Logs\LogListParams;
use Chunkify\Jobs\Logs\LogListParams\Service;
use Chunkify\Jobs\Logs\LogListResponse;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Jobs\LogsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class LogsRawService implements LogsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve logs for a specific job, either from the transcoder or manager service
     *
     * @param string $jobID Job ID
     * @param array{
     *   service: Service|value-of<Service>, transcoderID?: int
     * }|LogListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LogListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $jobID,
        array|LogListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LogListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/jobs/%1$s/logs', $jobID],
            query: Util::array_transform_keys(
                $parsed,
                ['transcoderID' => 'transcoder_id']
            ),
            options: $options,
            convert: LogListResponse::class,
            security: ['projectAccessToken' => true],
        );
    }
}
