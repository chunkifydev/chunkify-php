<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\WorkflowsContract;
use Chunkify\Services\Workflows\RevisionsService;
use Chunkify\Services\Workflows\RunsService;
use Chunkify\Workflows\Workflow;
use Chunkify\Workflows\WorkflowCreateParams\SchemaVersion;
use Chunkify\Workflows\WorkflowRuleParams;

/**
 * @phpstan-import-type WorkflowRuleParamsShape from \Chunkify\Workflows\WorkflowRuleParams
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class WorkflowsService implements WorkflowsContract
{
    /**
     * @api
     */
    public WorkflowsRawService $raw;

    /**
     * @api
     */
    public RevisionsService $revisions;

    /**
     * @api
     */
    public RunsService $runs;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WorkflowsRawService($client);
        $this->revisions = new RevisionsService($client);
        $this->runs = new RunsService($client);
    }

    /**
     * @api
     *
     * Create a Workflow with its first definition revision. Select it when creating an Asset or Upload, or set it as the Project default.
     *
     * @param string $name Name specifies the Workflow name.
     * Use 1 to 128 characters.
     * @param list<WorkflowRuleParams|WorkflowRuleParamsShape> $rules Rules specifies the event subscriptions and actions in this definition.
     * Provide exactly one asset.ready rule and up to 15 connected rules, with at most 32 actions and 65536 encoded bytes across all rules. Array order affects display only.
     * @param SchemaVersion|value-of<SchemaVersion> $schemaVersion SchemaVersion specifies the Workflow definition format. The supported version is 1.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        array $rules,
        SchemaVersion|int $schemaVersion,
        RequestOptions|array|null $requestOptions = null,
    ): Workflow {
        $params = [];
        $params['name'] = $name;
        $params['rules'] = $rules;
        $params['schemaVersion'] = $schemaVersion;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Workflow and its current definition, including archived Workflows.
     *
     * @param string $workflowID ID of the Workflow
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $workflowID,
        RequestOptions|array|null $requestOptions = null
    ): Workflow {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($workflowID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update the Workflow name or replace its rules. Replacing rules requires the current revision. A changed definition creates a new revision; unchanged rules and name-only edits preserve it. Existing Assets and Uploads keep their selected revision until a ready Asset explicitly updates to the latest revision. Archived Workflows cannot be updated.
     *
     * @param string $workflowID ID of the Workflow
     * @param int $expectedRevision ExpectedRevision specifies the current Workflow revision when replacing rules. The update returns a conflict if it no longer matches.
     * Required when rules is provided. Must be at least 1.
     * @param string $name Name specifies the Workflow name.
     * Use 1 to 128 characters.
     * @param list<WorkflowRuleParams|WorkflowRuleParamsShape> $rules Rules specifies the event subscriptions and actions in this definition.
     * Provide exactly one asset.ready rule and up to 15 connected rules, with at most 32 actions and 65536 encoded bytes across all rules. Array order affects display only.
     * Replaces the complete definition and requires schema_version and expected_revision. Existing Assets and Uploads keep their pinned revision.
     * @param \Chunkify\Workflows\WorkflowUpdateParams\SchemaVersion|value-of<\Chunkify\Workflows\WorkflowUpdateParams\SchemaVersion> $schemaVersion SchemaVersion specifies the Workflow definition format. The supported version is 1. Required when rules is provided.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $workflowID,
        ?int $expectedRevision = null,
        ?string $name = null,
        ?array $rules = null,
        \Chunkify\Workflows\WorkflowUpdateParams\SchemaVersion|int|null $schemaVersion = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = [];
        null !== $expectedRevision && $params['expectedRevision'] = $expectedRevision;
        null !== $name && $params['name'] = $name;
        null !== $rules && $params['rules'] = $rules;
        null !== $schemaVersion && $params['schemaVersion'] = $schemaVersion;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($workflowID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Workflows in the Project, newest first. Archived Workflows are excluded unless archived is true.
     *
     * @param bool $archived Archived specifies whether to include archived Workflows. Defaults to false.
     * @param int $limit Limit specifies the maximum number of results to return.
     * Accepts 1 to 100. Defaults to 100.
     * @param int $offset Offset specifies the number of matching results to skip.
     * Must be at least 0. Defaults to 0.
     * @param RequestOpts|null $requestOptions
     *
     * @return PaginatedResults<Workflow>
     *
     * @throws APIException
     */
    public function list(
        ?bool $archived = null,
        int $limit = 100,
        int $offset = 0,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults {
        $params = Util::removeNulls(
            ['archived' => $archived, 'limit' => $limit, 'offset' => $offset]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Archive the Workflow and clear it from the Project default. New Assets cannot select it and new events do not start runs. Accepted actions finish, and outputs and retained history remain available.
     *
     * @param string $workflowID ID of the Workflow
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $workflowID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($workflowID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
