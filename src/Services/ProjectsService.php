<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Omit;
use Chunkify\Projects\Project;
use Chunkify\Projects\ProjectListResponse;
use Chunkify\Projects\ProjectUpdateParams\AssetDefaults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\ProjectsContract;
use Chunkify\Services\Projects\AnalyticsConnectionsService;

/**
 * @phpstan-import-type AssetDefaultsShape from \Chunkify\Projects\ProjectUpdateParams\AssetDefaults
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class ProjectsService implements ProjectsContract
{
    /**
     * @api
     */
    public ProjectsRawService $raw;

    /**
     * @api
     */
    public AnalyticsConnectionsService $analyticsConnections;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ProjectsRawService($client);
        $this->analyticsConnections = new AnalyticsConnectionsService($client);
    }

    /**
     * @api
     *
     * Create a new project with the specified name. The project will be created with default Chunkify storage settings.
     *
     * @param string $name name is the name of the project, which must be between 4 and 32 characters
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        RequestOptions|array|null $requestOptions = null
    ): Project {
        $params = [];
        $params['name'] = $name;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve details of a specific project by its slug
     *
     * @param string $projectID Project Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $projectID,
        RequestOptions|array|null $requestOptions = null
    ): Project {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($projectID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a project's name or storage settings. Only team owners can update projects.
     *
     * @param string $projectID Project Id
     * @param AssetDefaults|AssetDefaultsShape $assetDefaults Defaults for new Assets and automatic Uploads. Replaces the whole object. Omitted fields reset to their defaults. Existing Assets are unchanged.
     * @param string|Omit|null $defaultWorkflowID DefaultWorkflowId specifies the default Workflow for new Assets. Set null to clear it.
     * @param string $name project name
     * @param string $storageID ID of this Project's default Storage
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $projectID,
        AssetDefaults|array|null $assetDefaults = null,
        string|Omit|null $defaultWorkflowID = Omit::Value,
        ?string $name = null,
        ?string $storageID = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = [];
        null !== $assetDefaults && $params['assetDefaults'] = $assetDefaults;
        Omit::Value !== $defaultWorkflowID && $params['defaultWorkflowID'] = $defaultWorkflowID;
        null !== $name && $params['name'] = $name;
        null !== $storageID && $params['storageID'] = $storageID;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($projectID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a list of all projects for a team
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): ProjectListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a project and revoke all associated access tokens. Only team owners can delete projects. Customer output files remain in Storage; managed temporary files retain their original expiry.
     *
     * @param string $projectID Project Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $projectID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($projectID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
