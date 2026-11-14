<?php

declare(strict_types=1);

namespace Chunkify\Uploads;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type UploadMultipartSignedPartShape = array{
 *   partNumber: int, uploadURL: string
 * }
 */
final class UploadMultipartSignedPart implements BaseModel
{
    /** @use SdkModel<UploadMultipartSignedPartShape> */
    use SdkModel;

    /**
     * PartNumber specifies the one-based part number for this URL.
     */
    #[Required('part_number')]
    public int $partNumber;

    /**
     * UploadUrl specifies the signed PUT URL for this part. Retry the same file slice with this URL before multipart.expires_at.
     */
    #[Required('upload_url')]
    public string $uploadURL;

    /**
     * `new UploadMultipartSignedPart()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UploadMultipartSignedPart::with(partNumber: ..., uploadURL: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UploadMultipartSignedPart)->withPartNumber(...)->withUploadURL(...)
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
    public static function with(int $partNumber, string $uploadURL): self
    {
        $self = new self;

        $self['partNumber'] = $partNumber;
        $self['uploadURL'] = $uploadURL;

        return $self;
    }

    /**
     * PartNumber specifies the one-based part number for this URL.
     */
    public function withPartNumber(int $partNumber): self
    {
        $self = clone $this;
        $self['partNumber'] = $partNumber;

        return $self;
    }

    /**
     * UploadUrl specifies the signed PUT URL for this part. Retry the same file slice with this URL before multipart.expires_at.
     */
    public function withUploadURL(string $uploadURL): self
    {
        $self = clone $this;
        $self['uploadURL'] = $uploadURL;

        return $self;
    }
}
