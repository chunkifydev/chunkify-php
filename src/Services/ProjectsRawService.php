<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Projects\Project;
use Chunkify\Projects\ProjectCreateParams;
use Chunkify\Projects\ProjectListResponse;
use Chunkify\Projects\ProjectUpdateParams;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\ProjectsRawContract;

/**
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
     * Create a new project with the specified name. The project will be created with default Chunkify storage settings.
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
            path: 'api/projects',
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
     * Retrieve details of a specific project by its slug
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
            path: ['api/projects/%1$s', $projectID],
            unwrap: 'data',
            options: $requestOptions,
            convert: Project::class,
            security: ['teamAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Update a project's name or storage settings. Only team owners can update projects.
     *
     * @param string $projectID Project Id
     * @param array{name?: string, storageID?: string}|ProjectUpdateParams $params
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
            path: ['api/projects/%1$s', $projectID],
            body: (object) $parsed,
            options: $options,
            convert: null,
            security: ['teamAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve a list of all projects for a team
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
            path: 'api/projects',
            options: $requestOptions,
            convert: ProjectListResponse::class,
            security: ['teamAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Delete a project and revoke all associated access tokens. Only team owners can delete projects.
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
            path: ['api/projects/%1$s', $projectID],
            options: $requestOptions,
            convert: null,
            security: ['teamAccessToken' => true],
        );
    }
}
