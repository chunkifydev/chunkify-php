<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Assets\AssetDefaultsParams;
use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Omit;
use Chunkify\Projects\PlayerAppearanceParams;
use Chunkify\Projects\Project;
use Chunkify\Projects\ProjectListResponse;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\ProjectsContract;
use Chunkify\Services\Projects\AnalyticsService;

/**
 * @phpstan-import-type AssetDefaultsParamsShape from \Chunkify\Assets\AssetDefaultsParams
 * @phpstan-import-type PlayerAppearanceParamsShape from \Chunkify\Projects\PlayerAppearanceParams
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
    public AnalyticsService $analytics;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ProjectsRawService($client);
        $this->analytics = new AnalyticsService($client);
    }

    /**
     * @api
     *
     * Create a Project in your team with a name of 4 to 32 characters. New Projects start with Chunkify storage until you connect your own Storage.
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
     * Retrieve a Project in your team by its ID, including its name, slug, default Storage, Asset defaults, and default Workflow.
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
     * Update a Project's name, default Storage, Asset defaults, or default Workflow. Only team owners can update Projects, and project names must be unique.
     *
     * @param string $projectID Project Id
     * @param AssetDefaultsParams|AssetDefaultsParamsShape $assetDefaults Defaults for new Assets and automatic Uploads. Replaces the whole object. Omitted fields reset to their defaults. Existing Assets are unchanged.
     * @param string|Omit|null $defaultWorkflowID DefaultWorkflowId specifies the default Workflow for new Assets. Set null to clear it.
     * @param string $name project name
     * @param PlayerAppearanceParams|PlayerAppearanceParamsShape $playerAppearance Player colours and controls for Chunkify-hosted playback pages, such as embeds. Replaces the whole object. Omitted fields reset to their defaults. Existing embeds use the new values.
     * @param string $storageID ID of this Project's default Storage
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $projectID,
        AssetDefaultsParams|array|null $assetDefaults = null,
        string|Omit|null $defaultWorkflowID = Omit::Value,
        ?string $name = null,
        PlayerAppearanceParams|array|null $playerAppearance = null,
        ?string $storageID = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = [];
        null !== $assetDefaults && $params['assetDefaults'] = $assetDefaults;
        Omit::Value !== $defaultWorkflowID && $params['defaultWorkflowID'] = $defaultWorkflowID;
        null !== $name && $params['name'] = $name;
        null !== $playerAppearance && $params['playerAppearance'] = $playerAppearance;
        null !== $storageID && $params['storageID'] = $storageID;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($projectID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List the Projects in the team that owns the access token, with each Project's name, slug, default Storage, and Asset defaults.
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
