<?php

declare(strict_types=1);

namespace Chunkify\Uploads;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type UploadMultipartPartParamsShape = array{
 *   etag: string, partNumber: int
 * }
 */
final class UploadMultipartPartParams implements BaseModel
{
    /** @use SdkModel<UploadMultipartPartParamsShape> */
    use SdkModel;

    /**
     * ETag returned by storage for this part, including its quotation marks when present.
     */
    #[Required]
    public string $etag;

    /**
     * One-based part number.
     */
    #[Required('part_number')]
    public int $partNumber;

    /**
     * `new UploadMultipartPartParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UploadMultipartPartParams::with(etag: ..., partNumber: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UploadMultipartPartParams)->withEtag(...)->withPartNumber(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $etag, int $partNumber): self
    {
        $self = new self;

        $self['etag'] = $etag;
        $self['partNumber'] = $partNumber;

        return $self;
    }

    /**
     * ETag returned by storage for this part, including its quotation marks when present.
     */
    public function withEtag(string $etag): self
    {
        $self = clone $this;
        $self['etag'] = $etag;

        return $self;
    }

    /**
     * One-based part number.
     */
    public function withPartNumber(int $partNumber): self
    {
        $self = clone $this;
        $self['partNumber'] = $partNumber;

        return $self;
    }
}
