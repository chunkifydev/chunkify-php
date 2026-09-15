<?php

declare(strict_types=1);

namespace Chunkify\Storages\Storage;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Storages\Storage\StorageS3Compatible\AddressingStyle;
use Chunkify\Storages\Storage\StorageS3Compatible\Location;

/**
 * A customer-owned storage connection using the standard S3 API.
 *
 * @phpstan-type StorageS3CompatibleShape = array{
 *   id: string,
 *   addressingStyle: AddressingStyle|value-of<AddressingStyle>,
 *   basePrefix: string,
 *   bucket: string,
 *   createdAt: \DateTimeInterface,
 *   endpoint: string,
 *   location: Location|value-of<Location>,
 *   provider: 's3_compatible',
 *   public: bool,
 *   region: string,
 *   slug: string,
 *   cdnBaseURL?: string|null,
 * }
 */
final class StorageS3Compatible implements BaseModel
{
    /** @use SdkModel<StorageS3CompatibleShape> */
    use SdkModel;

    /**
     * Stable provider identifier for generic S3-compatible storage.
     *
     * @var 's3_compatible' $provider
     */
    #[Required]
    public string $provider = 's3_compatible';

    /**
     * Unique identifier of the storage configuration.
     */
    #[Required]
    public string $id;

    /**
     * Addressing style detected during connection validation and used for later S3 operations.
     *
     * @var value-of<AddressingStyle> $addressingStyle
     */
    #[Required('addressing_style', enum: AddressingStyle::class)]
    public string $addressingStyle;

    /**
     * Canonical object-key prefix prepended to every final job output in this customer-owned storage. An empty string means the bucket root.
     */
    #[Required('base_prefix')]
    public string $basePrefix;

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
     * Public HTTPS origin for the S3-compatible service. Credentials, paths, queries, fragments, and non-public destinations are rejected.
     */
    #[Required]
    public string $endpoint;

    /**
     * Chunkify workload location. This is independent from the provider signing region.
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
     * Provider region used for S3 request signing. This is independent from the Chunkify workload location.
     */
    #[Required]
    public string $region;

    /**
     * Unique identifier of the storage configuration.
     */
    #[Required]
    public string $slug;

    /**
     * Optional customer-managed HTTPS delivery origin used to build stable CDN URLs for objects in this storage.
     */
    #[Optional('cdn_base_url', nullable: true)]
    public ?string $cdnBaseURL;

    /**
     * `new StorageS3Compatible()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StorageS3Compatible::with(
     *   id: ...,
     *   addressingStyle: ...,
     *   basePrefix: ...,
     *   bucket: ...,
     *   createdAt: ...,
     *   endpoint: ...,
     *   location: ...,
     *   public: ...,
     *   region: ...,
     *   slug: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StorageS3Compatible)
     *   ->withID(...)
     *   ->withAddressingStyle(...)
     *   ->withBasePrefix(...)
     *   ->withBucket(...)
     *   ->withCreatedAt(...)
     *   ->withEndpoint(...)
     *   ->withLocation(...)
     *   ->withPublic(...)
     *   ->withRegion(...)
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
     * @param AddressingStyle|value-of<AddressingStyle> $addressingStyle
     * @param Location|value-of<Location> $location
     */
    public static function with(
        string $id,
        AddressingStyle|string $addressingStyle,
        string $basePrefix,
        string $bucket,
        \DateTimeInterface $createdAt,
        string $endpoint,
        Location|string $location,
        bool $public,
        string $region,
        string $slug,
        ?string $cdnBaseURL = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['addressingStyle'] = $addressingStyle;
        $self['basePrefix'] = $basePrefix;
        $self['bucket'] = $bucket;
        $self['createdAt'] = $createdAt;
        $self['endpoint'] = $endpoint;
        $self['location'] = $location;
        $self['public'] = $public;
        $self['region'] = $region;
        $self['slug'] = $slug;

        null !== $cdnBaseURL && $self['cdnBaseURL'] = $cdnBaseURL;

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
     * Addressing style detected during connection validation and used for later S3 operations.
     *
     * @param AddressingStyle|value-of<AddressingStyle> $addressingStyle
     */
    public function withAddressingStyle(
        AddressingStyle|string $addressingStyle
    ): self {
        $self = clone $this;
        $self['addressingStyle'] = $addressingStyle;

        return $self;
    }

    /**
     * Canonical object-key prefix prepended to every final job output in this customer-owned storage. An empty string means the bucket root.
     */
    public function withBasePrefix(string $basePrefix): self
    {
        $self = clone $this;
        $self['basePrefix'] = $basePrefix;

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
     * Public HTTPS origin for the S3-compatible service. Credentials, paths, queries, fragments, and non-public destinations are rejected.
     */
    public function withEndpoint(string $endpoint): self
    {
        $self = clone $this;
        $self['endpoint'] = $endpoint;

        return $self;
    }

    /**
     * Chunkify workload location. This is independent from the provider signing region.
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
     * Stable provider identifier for generic S3-compatible storage.
     *
     * @param 's3_compatible' $provider
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
     * Provider region used for S3 request signing. This is independent from the Chunkify workload location.
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

    /**
     * Optional customer-managed HTTPS delivery origin used to build stable CDN URLs for objects in this storage.
     */
    public function withCdnBaseURL(?string $cdnBaseURL): self
    {
        $self = clone $this;
        $self['cdnBaseURL'] = $cdnBaseURL;

        return $self;
    }
}
