<?php

declare(strict_types=1);

namespace Chunkify\Storages\Storage;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Storages\Storage\StorageCloudflare\Location;

/**
 * @phpstan-type StorageCloudflareShape = array{
 *   id: string,
 *   bucket: string,
 *   createdAt: \DateTimeInterface,
 *   endpoint: string,
 *   location: Location|value-of<Location>,
 *   provider: 'cloudflare',
 *   public: bool,
 *   region: 'auto',
 *   slug: string,
 * }
 */
final class StorageCloudflare implements BaseModel
{
    /** @use SdkModel<StorageCloudflareShape> */
    use SdkModel;

    /**
     * Provider specifies the storage provider.
     *
     * @var 'cloudflare' $provider
     */
    #[Required]
    public string $provider = 'cloudflare';

    /**
     * Region specifies the region of the storage provider.
     *
     * @var 'auto' $region
     */
    #[Required]
    public string $region = 'auto';

    /**
     * Unique identifier of the storage configuration.
     */
    #[Required]
    public string $id;

    /**
     * Bucket is the name of the storage bucket.
     */
    #[Required]
    public string $bucket;

    /**
     * Created at timestamp.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Endpoint is the endpoint of the storage provider.
     */
    #[Required]
    public string $endpoint;

    /**
     * Location specifies the location of the storage provider.
     *
     * @var value-of<Location> $location
     */
    #[Required(enum: Location::class)]
    public string $location;

    /**
     * Public indicates whether the storage is publicly accessible.
     */
    #[Required]
    public bool $public;

    /**
     * Unique identifier of the storage configuration.
     */
    #[Required]
    public string $slug;

    /**
     * `new StorageCloudflare()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StorageCloudflare::with(
     *   id: ...,
     *   bucket: ...,
     *   createdAt: ...,
     *   endpoint: ...,
     *   location: ...,
     *   public: ...,
     *   slug: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StorageCloudflare)
     *   ->withID(...)
     *   ->withBucket(...)
     *   ->withCreatedAt(...)
     *   ->withEndpoint(...)
     *   ->withLocation(...)
     *   ->withPublic(...)
     *   ->withSlug(...)
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
     * @param Location|value-of<Location> $location
     */
    public static function with(
        string $id,
        string $bucket,
        \DateTimeInterface $createdAt,
        string $endpoint,
        Location|string $location,
        string $slug,
        bool $public = false,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['bucket'] = $bucket;
        $self['createdAt'] = $createdAt;
        $self['endpoint'] = $endpoint;
        $self['location'] = $location;
        $self['public'] = $public;
        $self['slug'] = $slug;

        return $self;
    }

    /**
     * Unique identifier of the storage configuration.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Bucket is the name of the storage bucket.
     */
    public function withBucket(string $bucket): self
    {
        $self = clone $this;
        $self['bucket'] = $bucket;

        return $self;
    }

    /**
     * Created at timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Endpoint is the endpoint of the storage provider.
     */
    public function withEndpoint(string $endpoint): self
    {
        $self = clone $this;
        $self['endpoint'] = $endpoint;

        return $self;
    }

    /**
     * Location specifies the location of the storage provider.
     *
     * @param Location|value-of<Location> $location
     */
    public function withLocation(Location|string $location): self
    {
        $self = clone $this;
        $self['location'] = $location;

        return $self;
    }

    /**
     * Provider specifies the storage provider.
     *
     * @param 'cloudflare' $provider
     */
    public function withProvider(string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * Public indicates whether the storage is publicly accessible.
     */
    public function withPublic(bool $public): self
    {
        $self = clone $this;
        $self['public'] = $public;

        return $self;
    }

    /**
     * Region specifies the region of the storage provider.
     *
     * @param 'auto' $region
     */
    public function withRegion(string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }

    /**
     * Unique identifier of the storage configuration.
     */
    public function withSlug(string $slug): self
    {
        $self = clone $this;
        $self['slug'] = $slug;

        return $self;
    }
}
