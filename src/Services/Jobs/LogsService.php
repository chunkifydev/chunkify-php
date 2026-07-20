<?php

declare(strict_types=1);

namespace Chunkify\Services\Jobs;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\Jobs\Logs\LogListParams\Service;
use Chunkify\Jobs\Logs\LogListResponse;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Jobs\LogsContract;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class LogsService implements LogsContract
{
    /**
     * @api
     */
    public LogsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LogsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve logs for a specific job, either from the transcoder or manager service
     *
     * @param string $jobID Job ID
     * @param Service|value-of<Service> $service Service type (transcoder or manager)
     * @param int $transcoderID Transcoder ID (required if service is transcoder)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $jobID,
        Service|string $service,
        ?int $transcoderID = null,
        RequestOptions|array|null $requestOptions = null,
    ): LogListResponse {
        $params = Util::removeNulls(
            ['service' => $service, 'transcoderID' => $transcoderID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($jobID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
