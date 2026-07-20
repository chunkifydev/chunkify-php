<?php

declare(strict_types=1);

namespace Chunkify\Uploads;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Create a new upload with the specified name.
 *
 * @see Chunkify\Services\UploadsService::create()
 *
 * @phpstan-type UploadCreateParamsShape = array{
 *   metadata?: array<string,string>|null, validityTimeout?: int|null
 * }
 */
final class UploadCreateParams implements BaseModel
{
    /** @use SdkModel<UploadCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Metadata allows for additional information to be attached to the upload, with a maximum size of 2048 bytes.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * The upload URL will be valid for the given timeout in seconds.
     */
    #[Optional('validity_timeout')]
    public ?int $validityTimeout;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,string>|null $metadata
     */
    public static function with(
        ?array $metadata = null,
        ?int $validityTimeout = null
    ): self {
        $self = new self;

        null !== $metadata && $self['metadata'] = $metadata;
        null !== $validityTimeout && $self['validityTimeout'] = $validityTimeout;

        return $self;
    }

    /**
     * Metadata allows for additional information to be attached to the upload, with a maximum size of 2048 bytes.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * The upload URL will be valid for the given timeout in seconds.
     */
    public function withValidityTimeout(int $validityTimeout): self
    {
        $self = clone $this;
        $self['validityTimeout'] = $validityTimeout;

        return $self;
    }
}
