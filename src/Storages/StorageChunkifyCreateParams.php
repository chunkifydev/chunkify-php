<?php

declare(strict_types=1);

namespace Chunkify\Storages;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Core\Omit;

/**
 * Storage parameters for Chunkify ephemeral storage.
 *
 * @phpstan-type StorageChunkifyCreateParamsShape = array{
 *   provider: 'chunkify',
 *   region: ChunkifyRegion|value-of<ChunkifyRegion>,
 *   cdnBaseURL?: string|null,
 * }
 */
final class StorageChunkifyCreateParams implements BaseModel
{
    /** @use SdkModel<StorageChunkifyCreateParamsShape> */
    use SdkModel;

    /**
     * Provider specifies the storage provider.
     *
     * @var 'chunkify' $provider
     */
    #[Required]
    public string $provider = 'chunkify';

    /**
     * Region specifies the region of the storage provider.
     *
     * @var value-of<ChunkifyRegion> $region
     */
    #[Required(enum: ChunkifyRegion::class)]
    public string $region;

    /**
     * Unsupported for Chunkify-managed temporary storage. Requests that provide this field are rejected.
     */
    #[Optional('cdn_base_url', nullable: true)]
    public ?string $cdnBaseURL;

    /**
     * `new StorageChunkifyCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StorageChunkifyCreateParams::with(region: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StorageChunkifyCreateParams)->withRegion(...)
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
     * @param ChunkifyRegion|value-of<ChunkifyRegion> $region
     */
    public static function with(
        ChunkifyRegion|string $region,
        string|Omit|null $cdnBaseURL = Omit::Value
    ): self {
        $self = new self;

        $self['region'] = $region;

        Omit::Value !== $cdnBaseURL && $self['cdnBaseURL'] = $cdnBaseURL;

        return $self;
    }

    /**
     * Provider specifies the storage provider.
     *
     * @param 'chunkify' $provider
     */
    public function withProvider(string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * Region specifies the region of the storage provider.
     *
     * @param ChunkifyRegion|value-of<ChunkifyRegion> $region
     */
    public function withRegion(ChunkifyRegion|string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }

    /**
     * Unsupported for Chunkify-managed temporary storage. Requests that provide this field are rejected.
     */
    public function withCdnBaseURL(?string $cdnBaseURL): self
    {
        $self = clone $this;
        $self['cdnBaseURL'] = $cdnBaseURL;

        return $self;
    }
}
