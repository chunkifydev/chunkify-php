<?php

declare(strict_types=1);

namespace Chunkify\Uploads;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type UploadMultipartSignedPartShape from \Chunkify\Uploads\UploadMultipartSignedPart
 *
 * @phpstan-type UploadMultipartSessionShape = array{
 *   expiresAt: \DateTimeInterface,
 *   partSizeBytes: int,
 *   parts: list<UploadMultipartSignedPart|UploadMultipartSignedPartShape>,
 * }
 */
final class UploadMultipartSession implements BaseModel
{
    /** @use SdkModel<UploadMultipartSessionShape> */
    use SdkModel;

    /**
     * ExpiresAt specifies when the signed part URLs expire. URLs cannot be refreshed; create a new Upload after expiry.
     */
    #[Required('expires_at')]
    public \DateTimeInterface $expiresAt;

    /**
     * PartSizeBytes specifies the size of each part except the final part, in bytes.
     */
    #[Required('part_size_bytes')]
    public int $partSizeBytes;

    /**
     * Parts contains every signed upload URL in ascending part_number order. Upload file slices directly to these URLs.
     *
     * @var list<UploadMultipartSignedPart> $parts
     */
    #[Required(list: UploadMultipartSignedPart::class)]
    public array $parts;

    /**
     * `new UploadMultipartSession()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UploadMultipartSession::with(expiresAt: ..., partSizeBytes: ..., parts: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UploadMultipartSession)
     *   ->withExpiresAt(...)
     *   ->withPartSizeBytes(...)
     *   ->withParts(...)
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
     *
     * @param list<UploadMultipartSignedPart|UploadMultipartSignedPartShape> $parts
     */
    public static function with(
        \DateTimeInterface $expiresAt,
        int $partSizeBytes,
        array $parts
    ): self {
        $self = new self;

        $self['expiresAt'] = $expiresAt;
        $self['partSizeBytes'] = $partSizeBytes;
        $self['parts'] = $parts;

        return $self;
    }

    /**
     * ExpiresAt specifies when the signed part URLs expire. URLs cannot be refreshed; create a new Upload after expiry.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * PartSizeBytes specifies the size of each part except the final part, in bytes.
     */
    public function withPartSizeBytes(int $partSizeBytes): self
    {
        $self = clone $this;
        $self['partSizeBytes'] = $partSizeBytes;

        return $self;
    }

    /**
     * Parts contains every signed upload URL in ascending part_number order. Upload file slices directly to these URLs.
     *
     * @param list<UploadMultipartSignedPart|UploadMultipartSignedPartShape> $parts
     */
    public function withParts(array $parts): self
    {
        $self = clone $this;
        $self['parts'] = $parts;

        return $self;
    }
}
