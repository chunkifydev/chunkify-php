<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\Projects\Project;
use Chunkify\Projects\ProjectListResponse;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\ProjectsContract;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class ProjectsService implements ProjectsContract
{
    /**
     * @api
     */
    public ProjectsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ProjectsRawService($client);
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
        $params = Util::removeNulls(['name' => $name]);

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
     * @param string $name Name is the name of the project. Required when storage_id is not provided.
     * @param string $storageID StorageId is the storage id of the project. Required when name is not provided.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $projectID,
        ?string $name = null,
        ?string $storageID = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['name' => $name, 'storageID' => $storageID]);

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
     * Delete a project and revoke all associated access tokens. Only team owners can delete projects.
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
