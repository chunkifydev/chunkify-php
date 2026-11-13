<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Assets\AssetDefaultsParams;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Omit;
use Chunkify\Projects\Project;
use Chunkify\Projects\ProjectListResponse;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type AssetDefaultsParamsShape from \Chunkify\Assets\AssetDefaultsParams
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
     * @param AssetDefaultsParams|AssetDefaultsParamsShape $assetDefaults Defaults for new Assets and automatic Uploads. Replaces the whole object. Omitted fields reset to their defaults. Existing Assets are unchanged.
     * @param string|Omit|null $defaultWorkflowID DefaultWorkflowId specifies the default Workflow for new Assets. Set null to clear it.
     * @param string $name project name
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
