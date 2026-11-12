<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\TranscodingsContract;
use Chunkify\Transcodings\Transcoding;
use Chunkify\Transcodings\TranscodingCreateParams\Format\M4aAac;
use Chunkify\Transcodings\TranscodingCreateParams\Format\MP4Av1;
use Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H264;
use Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H265;
use Chunkify\Transcodings\TranscodingCreateParams\Format\WebmVp9;
use Chunkify\Transcodings\TranscodingCreateParams\Storage;
use Chunkify\Transcodings\TranscodingListParams\Created;
use Chunkify\Transcodings\TranscodingListParams\Status;

/**
 * @phpstan-import-type FormatShape from \Chunkify\Transcodings\TranscodingCreateParams\Format
 * @phpstan-import-type StorageShape from \Chunkify\Transcodings\TranscodingCreateParams\Storage
 * @phpstan-import-type CreatedShape from \Chunkify\Transcodings\TranscodingListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class TranscodingsService implements TranscodingsContract
{
    /**
     * @api
     */
    public TranscodingsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TranscodingsRawService($client);
    }

    /**
     * @api
     *
     * Create a standalone file export with resolved encoding settings.
     *
     * @param FormatShape $format format specifies the requested encoding settings
     * @param string $sourceID sourceId identifies a Source in this Project
     * @param array<string,string> $metadata Metadata attaches string values to the Transcoding. The serialized object may contain at most 2048 bytes.
     * @param Storage|StorageShape $storage Storage overrides the Project output destination. Source storage remains independent.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        MP4H264|array|MP4H265|MP4Av1|WebmVp9|M4aAac $format,
        string $sourceID,
        ?array $metadata = null,
        Storage|array|null $storage = null,
        RequestOptions|array|null $requestOptions = null,
    ): Transcoding {
        $params = [];
        $params['format'] = $format;
        $params['sourceID'] = $sourceID;
        null !== $metadata && $params['metadata'] = $metadata;
        null !== $storage && $params['storage'] = $storage;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve the accepted settings, published files and current state of one Transcoding.
     *
     * @param string $transcodingID transcodingId identifies a Transcoding in the authenticated Project
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $transcodingID,
        RequestOptions|array|null $requestOptions = null
    ): Transcoding {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($transcodingID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Transcodings in the authenticated Project, newest first by default.
     *
     * @param string $id Id filters by an exact Transcoding ID. Omit to include all matching resources.
     * @param Created|CreatedShape $created
     * @param int $limit maximum number of Transcodings to return
     * @param int $offset number of Transcodings to skip
     * @param string $sourceID Filter Transcodings linked to this Source. Omit to include Transcodings from all Sources in the Project.
     * @param Status|value-of<Status> $status filter by Transcoding status
     * @param string $storageID filter by output Storage ID
     * @param RequestOpts|null $requestOptions
     *
     * @return PaginatedResults<Transcoding>
     *
     * @throws APIException
     */
    public function list(
        ?string $id = null,
        Created|array|null $created = null,
        int $limit = 100,
        int $offset = 0,
        ?string $sourceID = null,
        Status|string|null $status = null,
        ?string $storageID = null,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'created' => $created,
                'limit' => $limit,
                'offset' => $offset,
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
     * Delete a ready, failed, cancelled or expired Transcoding and its file records. The Source and settled usage are preserved. Customer output files remain unless delete_files is true; temporary files retain their original 24-hour expiry. Deletion remains available for inactive teams.
     *
     * @param string $transcodingID transcodingId identifies a Transcoding in the authenticated Project
     * @param bool $deleteFiles DeleteFiles specifies whether to permanently delete this Transcoding's output files at their saved storage paths. Defaults to false. The original Source and unrelated files are preserved. If deletion fails, records remain for retry, but some files may already be deleted. Managed dashboard images are removed with the resource; temporary outputs still expire after 24 hours when this option is false.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $transcodingID,
        bool $deleteFiles = false,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['deleteFiles' => $deleteFiles]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($transcodingID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel a preparing Transcoding and release its unpaid reservation. Repeating an accepted cancellation succeeds.
     *
     * @param string $transcodingID transcodingId identifies a Transcoding in the authenticated Project
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $transcodingID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($transcodingID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
