<?php

declare(strict_types=1);

namespace Chunkify\Storages;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Update customer-owned storage settings. Prefix changes apply to final outputs that have not been uploaded yet. Existing files keep their stored object keys.
 *
 * @see Chunkify\Services\StoragesService::update()
 *
 * @phpstan-type StorageUpdateParamsShape = array{
 *   basePrefix?: string|null, cdnBaseURL?: string|null
 * }
 */
final class StorageUpdateParams implements BaseModel
{
    /** @use SdkModel<StorageUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Object-key prefix for future final job outputs. Existing files keep their stored object keys. Send an empty string to use the bucket root.
     */
    #[Optional('base_prefix')]
    public ?string $basePrefix;

    /**
     * Customer-managed HTTPS delivery origin, or null to remove the current value.
     */
    #[Optional('cdn_base_url', nullable: true)]
    public ?string $cdnBaseURL;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $basePrefix = null,
        ?string $cdnBaseURL = null
    ): self {
        $self = new self;

        null !== $basePrefix && $self['basePrefix'] = $basePrefix;
        null !== $cdnBaseURL && $self['cdnBaseURL'] = $cdnBaseURL;

        return $self;
    }

    /**
     * Object-key prefix for future final job outputs. Existing files keep their stored object keys. Send an empty string to use the bucket root.
     */
    public function withBasePrefix(string $basePrefix): self
    {
        $self = clone $this;
        $self['basePrefix'] = $basePrefix;

        return $self;
    }

    /**
     * Customer-managed HTTPS delivery origin, or null to remove the current value.
     */
    public function withCdnBaseURL(?string $cdnBaseURL): self
    {
        $self = clone $this;
        $self['cdnBaseURL'] = $cdnBaseURL;

        return $self;
    }
}
