<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Assets\Asset;
use Chunkify\Assets\AssetCreateParams\MaxResolution;
use Chunkify\Assets\AssetCreateParams\MinResolution;
use Chunkify\Assets\AssetCreateParams\Storage;
use Chunkify\Assets\AssetListParams\Created;
use Chunkify\Assets\AssetStatus;
use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Omit;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\AssetsContract;
use Chunkify\Services\Assets\OutputsService;
use Chunkify\Services\Assets\WorkflowService;

/**
 * Automatic video-on-demand Assets and independent H.264 MP4 static renditions.
 *
 * @phpstan-import-type StorageShape from \Chunkify\Assets\AssetCreateParams\Storage
 * @phpstan-import-type CreatedShape from \Chunkify\Assets\AssetListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class AssetsService implements AssetsContract
{
    /**
     * @api
     */
    public AssetsRawService $raw;

    /**
     * @api
     */
    public OutputsService $outputs;

    /**
     * @api
     */
    public WorkflowService $workflow;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AssetsRawService($client);
        $this->outputs = new OutputsService($client);
        $this->workflow = new WorkflowService($client);
    }

    /**
     * @api
     *
     * Create an Asset from a video Source. Processing starts asynchronously.
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
    ): Asset {
        $params = [];
        $params['sourceID'] = $sourceID;
        null !== $maxResolution && $params['maxResolution'] = $maxResolution;
        null !== $metadata && $params['metadata'] = $metadata;
        null !== $minResolution && $params['minResolution'] = $minResolution;
        null !== $pathTemplate && $params['pathTemplate'] = $pathTemplate;
        null !== $previewEnabled && $params['previewEnabled'] = $previewEnabled;
        null !== $storage && $params['storage'] = $storage;
        null !== $title && $params['title'] = $title;
        Omit::Value !== $workflowID && $params['workflowID'] = $workflowID;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve an Asset and its streaming, static, poster, and timeline outputs.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $assetID,
        RequestOptions|array|null $requestOptions = null
    ): Asset {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($assetID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update the title, metadata, or public preview access. Omitted fields remain unchanged.
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
    ): mixed {
        $params = [];
        null !== $metadata && $params['metadata'] = $metadata;
        null !== $previewEnabled && $params['previewEnabled'] = $previewEnabled;
        null !== $title && $params['title'] = $title;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($assetID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Assets in the Project, with filtering and pagination.
     *
     * @param Created|CreatedShape $created
     * @param int $limit maximum number of Assets to return
     * @param list<string> $metadata repeat key:value pairs to match all supplied metadata conditions
     * @param int $offset number of Assets to skip
     * @param string $search case-insensitive search of Asset IDs and titles
     * @param string $sourceID Filter Assets linked to this Source. Omit to include Assets from all Sources in the Project.
     * @param AssetStatus|value-of<AssetStatus> $status filter by Asset status
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
        AssetStatus|string|null $status = null,
        ?string $storageID = null,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults {
        $params = Util::removeNulls(
            [
                'created' => $created,
                'limit' => $limit,
                'metadata' => $metadata,
                'offset' => $offset,
                'search' => $search,
                'sourceID' => $sourceID,
                'status' => $status,
                'storageID' => $storageID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete an Asset after all processing finishes. Files remain in Storage unless delete_files is true.
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
    ): mixed {
        $params = Util::removeNulls(['deleteFiles' => $deleteFiles]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($assetID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
