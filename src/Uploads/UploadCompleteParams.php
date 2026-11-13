<?php

declare(strict_types=1);

namespace Chunkify\Uploads;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * POST the returned completion_url before expires_at. Single-PUT Uploads send no body; multipart Uploads send every part number and storage ETag. Chunkify verifies the assembled object and atomically creates the Source and optional Asset. An Asset destination conflict returns 409 and fails the Upload without committing Source, Asset, or usage changes. Valid retries return 204 without duplicate side effects. Retry network errors, 429, and 5xx responses with bounded backoff.
 *
 * @see Chunkify\Services\UploadsService::complete()
 *
 * @phpstan-import-type UploadMultipartPartParamsShape from \Chunkify\Uploads\UploadMultipartPartParams
 *
 * @phpstan-type UploadCompleteParamsShape = array{
 *   parts?: list<UploadMultipartPartParams|UploadMultipartPartParamsShape>|null
 * }
 */
final class UploadCompleteParams implements BaseModel
{
    /** @use SdkModel<UploadCompleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * All uploaded parts in ascending part_number order, with the ETags returned by storage.
     *
     * @var list<UploadMultipartPartParams>|null $parts
     */
    #[Optional(list: UploadMultipartPartParams::class)]
    public ?array $parts;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<UploadMultipartPartParams|UploadMultipartPartParamsShape>|null $parts
     */
    public static function with(?array $parts = null): self
    {
        $self = new self;

        null !== $parts && $self['parts'] = $parts;

        return $self;
    }

    /**
     * All uploaded parts in ascending part_number order, with the ETags returned by storage.
     *
     * @param list<UploadMultipartPartParams|UploadMultipartPartParamsShape> $parts
     */
    public function withParts(array $parts): self
    {
        $self = clone $this;
        $self['parts'] = $parts;

        return $self;
    }
}
