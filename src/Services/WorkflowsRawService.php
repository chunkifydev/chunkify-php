<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\WorkflowsRawContract;
use Chunkify\Workflows\Workflow;
use Chunkify\Workflows\WorkflowCreateParams;
use Chunkify\Workflows\WorkflowCreateParams\SchemaVersion;
use Chunkify\Workflows\WorkflowListParams;
use Chunkify\Workflows\WorkflowRule;
use Chunkify\Workflows\WorkflowUpdateParams;

/**
 * @phpstan-import-type WorkflowRuleShape from \Chunkify\Workflows\WorkflowRule
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class WorkflowsRawService implements WorkflowsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Workflow with its first definition revision. Select it when creating an Asset or Upload, or set it as the Project default.
     *
     * @param array{
     *   name: string,
     *   rules: list<WorkflowRule|WorkflowRuleShape>,
     *   schemaVersion: SchemaVersion|value-of<SchemaVersion>,
     * }|WorkflowCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Workflow>
     *
     * @throws APIException
     */
    public function create(
        array|WorkflowCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WorkflowCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'workflows',
            body: (object) $parsed,
            unwrap: 'data',
            options: $options,
            convert: Workflow::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve a Workflow and its current definition, including archived Workflows.
     *
     * @param string $workflowID ID of the Workflow
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Workflow>
     *
     * @throws APIException
     */
    public function retrieve(
        string $workflowID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['workflows/%1$s', $workflowID],
            unwrap: 'data',
            options: $requestOptions,
            convert: Workflow::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Update the Workflow name or replace its rules. Replacing rules requires the current revision. A changed definition creates a new revision; unchanged rules and name-only edits preserve it. Existing Assets and Uploads keep their selected revision until a ready Asset explicitly updates to the latest revision. Archived Workflows cannot be updated.
     *
     * @param string $workflowID ID of the Workflow
     * @param array{
     *   expectedRevision?: int,
     *   name?: string,
     *   rules?: list<WorkflowRule|WorkflowRuleShape>,
     *   schemaVersion?: WorkflowUpdateParams\SchemaVersion|value-of<WorkflowUpdateParams\SchemaVersion>,
     * }|WorkflowUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $workflowID,
        array|WorkflowUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WorkflowUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['workflows/%1$s', $workflowID],
            body: (object) $parsed,
            options: $options,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * List Workflows in the Project, newest first. Archived Workflows are excluded unless archived is true.
     *
     * @param array{
     *   archived?: bool, limit?: int, offset?: int
     * }|WorkflowListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Workflow>>
     *
     * @throws APIException
     */
    public function list(
        array|WorkflowListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WorkflowListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'workflows',
            query: $parsed,
            options: $options,
            convert: Workflow::class,
            page: PaginatedResults::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Archive the Workflow and clear it from the Project default. New Assets cannot select it and new events do not start runs. Accepted actions finish, and outputs and retained history remain available.
     *
     * @param string $workflowID ID of the Workflow
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $workflowID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['workflows/%1$s', $workflowID],
            options: $requestOptions,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }
}
