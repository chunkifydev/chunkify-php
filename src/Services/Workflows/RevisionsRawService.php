<?php

declare(strict_types=1);

namespace Chunkify\Services\Workflows;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\Workflows\RevisionsRawContract;
use Chunkify\Workflows\Revisions\RevisionRetrieveParams;
use Chunkify\Workflows\Revisions\WorkflowRevision;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class RevisionsRawService implements RevisionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve an immutable definition revision, including revisions of archived Workflows.
     *
     * @param int $revision revision number of the Workflow definition to retrieve
     * @param array{workflowID: string}|RevisionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkflowRevision>
     *
     * @throws APIException
     */
    public function retrieve(
        int $revision,
        array|RevisionRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RevisionRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $workflowID = $parsed['workflowID'];
        unset($parsed['workflowID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['workflows/%1$s/revisions/%2$s', $workflowID, $revision],
            unwrap: 'data',
            options: $options,
            convert: WorkflowRevision::class,
            security: ['projectAccessToken' => true],
        );
    }
}
