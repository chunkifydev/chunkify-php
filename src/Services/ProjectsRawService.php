<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Assets\AssetDefaultsParams;
use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Projects\PlayerAppearanceParams;
use Chunkify\Projects\Project;
use Chunkify\Projects\ProjectCreateParams;
use Chunkify\Projects\ProjectListResponse;
use Chunkify\Projects\ProjectUpdateParams;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\ProjectsRawContract;

/**
 * @phpstan-import-type AssetDefaultsParamsShape from \Chunkify\Assets\AssetDefaultsParams
 * @phpstan-import-type PlayerAppearanceParamsShape from \Chunkify\Projects\PlayerAppearanceParams
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class ProjectsRawService implements ProjectsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Project in your team with a name of 4 to 32 characters. New Projects start with Chunkify storage until you connect your own Storage.
     *
     * @param array{name: string}|ProjectCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Project>
     *
     * @throws APIException
     */
    public function create(
        array|ProjectCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProjectCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'projects',
            body: (object) $parsed,
            unwrap: 'data',
            options: $options,
            convert: Project::class,
            security: ['teamAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve a Project in your team by its ID, including its name, slug, default Storage, Asset defaults, and default Workflow.
     *
     * @param string $projectID Project Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Project>
     *
     * @throws APIException
     */
    public function retrieve(
        string $projectID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['projects/%1$s', $projectID],
            unwrap: 'data',
            options: $requestOptions,
            convert: Project::class,
            security: ['teamAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Update a Project's name, default Storage, Asset defaults, or default Workflow. Only team owners can update Projects, and project names must be unique.
     *
     * @param string $projectID Project Id
     * @param array{
     *   assetDefaults?: AssetDefaultsParams|AssetDefaultsParamsShape,
     *   defaultWorkflowID?: string|null,
     *   name?: string,
     *   playerAppearance?: PlayerAppearanceParams|PlayerAppearanceParamsShape,
     *   storageID?: string,
     * }|ProjectUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $projectID,
        array|ProjectUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProjectUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['projects/%1$s', $projectID],
            body: (object) $parsed,
            options: $options,
            convert: null,
            security: ['teamAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * List the Projects in the team that owns the access token, with each Project's name, slug, default Storage, and Asset defaults.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProjectListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'projects',
            options: $requestOptions,
            convert: ProjectListResponse::class,
            security: ['teamAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Delete a project and revoke all associated access tokens. Only team owners can delete projects. Customer output files remain in Storage; managed temporary files retain their original expiry.
     *
     * @param string $projectID Project Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $projectID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['projects/%1$s', $projectID],
            options: $requestOptions,
            convert: null,
            security: ['teamAccessToken' => true],
        );
    }
}
