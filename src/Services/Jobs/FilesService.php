<?php

declare(strict_types=1);

namespace Chunkify\Services\Jobs;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Jobs\Files\FileListResponse;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Jobs\FilesContract;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class FilesService implements FilesContract
{
    /**
     * @api
     */
    public FilesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FilesRawService($client);
    }

    /**
     * @api
     *
     * Retrieve all files associated with a specific job
     *
     * @param string $jobID Job ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): FileListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($jobID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
