<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Assets\Asset;
use Chunkify\Assets\AssetCreateParams\MaxResolution;
use Chunkify\Assets\AssetCreateParams\MinResolution;
use Chunkify\Assets\AssetCreateParams\Storage;
use Chunkify\Assets\AssetListParams\Created;
use Chunkify\Assets\AssetListParams\Status;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Omit;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type StorageShape from \Chunkify\Assets\AssetCreateParams\Storage
 * @phpstan-import-type CreatedShape from \Chunkify\Assets\AssetListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface AssetsContract
{
    /**
     * @api
     *
     * @param string $sourceID ID of the video Source to process
     * @param MaxResolution|value-of<MaxResolution> $maxResolution Maximum streaming resolution. Omit to use the Project default, or the plan maximum if unset. 2160p requires Starter or above. Smaller sources are not upscaled. Does not affect static renditions.
     * @param array<string,string> $metadata string metadata with a maximum encoded JSON size of 2048 bytes
     * @param MinResolution|value-of<MinResolution> $minResolution Minimum streaming resolution. Omit to use the Project default; auto removes the minimum. Must not exceed max_resolution. Smaller sources are not upscaled. Does not affect static renditions.
     * @param string $pathTemplate PathTemplate specifies the Asset output folder relative to Storage base_prefix.
     * Supports {assetID} and case-sensitive {metadata.<key>}; referenced values must be non-empty.
     * Ignored for Chunkify storage, which always uses {assetID}.
     * Overrides the Project default. Defaults to {assetID} when neither is set. Maximum template size: 1024 UTF-8 bytes. Expanded prefix: 768 bytes including base_prefix and trailing slash.
     * @param bool $previewEnabled Allow public preview access without an API token. Omit to use the Project default. Does not control CDN or static download access.
     * @param Storage|StorageShape $storage Output Storage. Omit to use the Project default. The path_template controls the folder for generated output paths.
     * @param string $title Asset title, up to 256 characters. Defaults to an empty string.
     * @param string|Omit|null $workflowID WorkflowId specifies the Workflow to select. Omit to use the Project default. Set null to disable automatic actions. The current revision is pinned when creation is accepted.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $sourceID,
        MaxResolution|string|null $maxResolution = null,
        ?array $metadata = null,
        MinResolution|string|null $minResolution = null,
        ?string $pathTemplate = null,
        ?bool $previewEnabled = null,
        Storage|array|null $storage = null,
        ?string $title = null,
        string|Omit|null $workflowID = Omit::Value,
        RequestOptions|array|null $requestOptions = null,
    ): Asset;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $assetID,
        RequestOptions|array|null $requestOptions = null
    ): Asset;

    /**
     * @api
     *
     * @param array<string,string> $metadata Replaces all metadata. Send {} to clear it; omit to leave unchanged. Maximum encoded JSON size: 2,048 bytes.
     * @param bool $previewEnabled Allow public preview access without an API token. Does not control CDN or static download access. Disabling it does not revoke signed URLs already issued.
     * @param string $title Asset title, up to 256 characters. Send an empty string to clear it; omit to leave unchanged.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $assetID,
        ?array $metadata = null,
        ?bool $previewEnabled = null,
        ?string $title = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param Created|CreatedShape $created
     * @param int $limit maximum number of Assets to return
     * @param list<string> $metadata repeat key:value pairs to match all supplied metadata conditions
     * @param int $offset number of Assets to skip
     * @param string $search case-insensitive search of Asset IDs and titles
     * @param string $sourceID Filter Assets linked to this Source. Omit to include Assets from all Sources in the Project.
     * @param Status|value-of<Status> $status filter by Asset status
     * @param string $storageID filter by output Storage ID
     * @param RequestOpts|null $requestOptions
     *
     * @return PaginatedResults<Asset>
     *
     * @throws APIException
     */
    public function list(
        Created|array|null $created = null,
        int $limit = 100,
        ?array $metadata = null,
        int $offset = 0,
        ?string $search = null,
        ?string $sourceID = null,
        Status|string|null $status = null,
        ?string $storageID = null,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults;

    /**
     * @api
     *
     * @param bool $deleteFiles Also delete all files under the Asset's storage prefix, including streaming and static outputs. Other files and the original input are preserved. Defaults to false, which preserves published media files. Private transcript text and saved subtitle copies are always scheduled for removal. File deletion is irreversible. If cleanup fails, records remain for retry, but files may already be deleted.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $assetID,
        bool $deleteFiles = false,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
