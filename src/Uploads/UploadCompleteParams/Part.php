<?php

declare(strict_types=1);

namespace Chunkify\Uploads\UploadCompleteParams;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type PartShape = array{etag: string, partNumber: int}
 */
final class Part implements BaseModel
{
    /** @use SdkModel<PartShape> */
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
     * `new Part()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Part::with(etag: ..., partNumber: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Part)->withEtag(...)->withPartNumber(...)
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
