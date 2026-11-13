<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Workflows\Workflow;
use Chunkify\Workflows\WorkflowCreateParams\Rule;
use Chunkify\Workflows\WorkflowCreateParams\SchemaVersion;

/**
 * @phpstan-import-type RuleShape from \Chunkify\Workflows\WorkflowCreateParams\Rule
 * @phpstan-import-type RuleShape from \Chunkify\Workflows\WorkflowUpdateParams\Rule as RuleShape1
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface WorkflowsContract
{
    /**
     * @api
     *
     * @param string $name Name specifies the Workflow name.
     * Use 1 to 128 characters.
     * @param list<Rule|RuleShape> $rules Rules specifies the event subscriptions and actions in this definition.
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
    ): Workflow;

    /**
     * @api
     *
     * @param string $workflowID ID of the Workflow
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $workflowID,
        RequestOptions|array|null $requestOptions = null
    ): Workflow;

    /**
     * @api
     *
     * @param string $workflowID ID of the Workflow
     * @param int $expectedRevision ExpectedRevision specifies the current Workflow revision when replacing rules. The update returns a conflict if it no longer matches.
     * Required when rules is provided. Must be at least 1.
     * @param string $name Name specifies the Workflow name.
     * Use 1 to 128 characters.
     * @param list<\Chunkify\Workflows\WorkflowUpdateParams\Rule|RuleShape1> $rules Rules specifies the event subscriptions and actions in this definition.
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
    ): mixed;

    /**
     * @api
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
    ): PaginatedResults;

    /**
     * @api
     *
     * @param string $workflowID ID of the Workflow
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $workflowID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
