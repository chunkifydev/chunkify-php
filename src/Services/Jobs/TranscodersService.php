<?php

declare(strict_types=1);

namespace Chunkify\Services\Jobs;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Jobs\Transcoders\TranscoderListResponse;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Jobs\TranscodersContract;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class TranscodersService implements TranscodersContract
{
    /**
     * @api
     */
    public TranscodersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TranscodersRawService($client);
    }

    /**
     * @api
     *
     * Retrieve all the transcoders statuses for a specific job
     *
     * @param string $jobID Job ID to get status for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): TranscoderListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($jobID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
