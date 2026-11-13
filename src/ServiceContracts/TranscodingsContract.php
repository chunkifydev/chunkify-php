<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Transcodings\Transcoding;
use Chunkify\Transcodings\TranscodingCreateStorageParams;
use Chunkify\Transcodings\TranscodingListParams\Created;
use Chunkify\Transcodings\TranscodingM4aAac;
use Chunkify\Transcodings\TranscodingMP4Av1;
use Chunkify\Transcodings\TranscodingMP4H264;
use Chunkify\Transcodings\TranscodingMP4H265;
use Chunkify\Transcodings\TranscodingStatus;
use Chunkify\Transcodings\TranscodingWebmVp9;

/**
 * @phpstan-import-type TranscodingCreateFormatParamsShape from \Chunkify\Transcodings\TranscodingCreateFormatParams
 * @phpstan-import-type TranscodingCreateStorageParamsShape from \Chunkify\Transcodings\TranscodingCreateStorageParams
 * @phpstan-import-type CreatedShape from \Chunkify\Transcodings\TranscodingListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface TranscodingsContract
{
    /**
     * @api
     *
     * @param TranscodingCreateFormatParamsShape $format format specifies the requested encoding settings
     * @param string $sourceID sourceId identifies a Source in this Project
     * @param array<string,string> $metadata Metadata attaches string values to the Transcoding. The serialized object may contain at most 2048 bytes.
     * @param TranscodingCreateStorageParams|TranscodingCreateStorageParamsShape $storage Storage overrides the Project output destination. Source storage remains independent.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        TranscodingMP4H264|array|TranscodingMP4H265|TranscodingMP4Av1|TranscodingWebmVp9|TranscodingM4aAac $format,
        string $sourceID,
        ?array $metadata = null,
        TranscodingCreateStorageParams|array|null $storage = null,
        RequestOptions|array|null $requestOptions = null,
    ): Transcoding;

    /**
     * @api
     *
     * @param string $transcodingID transcodingId identifies a Transcoding in the authenticated Project
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $transcodingID,
        RequestOptions|array|null $requestOptions = null
    ): Transcoding;

    /**
     * @api
     *
     * @param string $id Id filters by an exact Transcoding ID. Omit to include all matching resources.
     * @param Created|CreatedShape $created
     * @param int $limit maximum number of Transcodings to return
     * @param int $offset number of Transcodings to skip
     * @param string $sourceID Filter Transcodings linked to this Source. Omit to include Transcodings from all Sources in the Project.
     * @param TranscodingStatus|value-of<TranscodingStatus> $status filter by Transcoding status
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
        TranscodingStatus|string|null $status = null,
        ?string $storageID = null,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
     *
     * @param string $transcodingID transcodingId identifies a Transcoding in the authenticated Project
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $transcodingID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
