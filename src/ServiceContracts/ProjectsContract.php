<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\Projects\Project;
use Chunkify\Projects\ProjectListResponse;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface ProjectsContract
{
    /**
     * @api
     *
     * @param string $name name is the name of the project, which must be between 4 and 32 characters
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        RequestOptions|array|null $requestOptions = null
    ): Project;

    /**
     * @api
     *
     * @param string $projectID Project Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $projectID,
        RequestOptions|array|null $requestOptions = null
    ): Project;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): ProjectListResponse;

    /**
     * @api
     *
     * @param string $projectID Project Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $projectID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
