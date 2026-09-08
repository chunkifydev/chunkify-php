<?php

declare(strict_types=1);

namespace Chunkify\Storages\StorageCreateParams\Storage;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Storages\StorageCreateParams\Storage\StorageAwsCreateParams\Region;

/**
 * Storage parameters for AWS S3 storage.
 *
 * @phpstan-type StorageAwsCreateParamsShape = array{
 *   accessKeyID: string,
 *   bucket: string,
 *   provider: 'aws',
 *   region: Region|value-of<Region>,
 *   secretAccessKey: string,
 *   basePrefix?: string|null,
 *   cdnBaseURL?: string|null,
 *   public?: bool|null,
 * }
 */
final class StorageAwsCreateParams implements BaseModel
{
    /** @use SdkModel<StorageAwsCreateParamsShape> */
    use SdkModel;

    /**
     * Provider specifies the storage provider.
     *
     * @var 'aws' $provider
     */
    #[Required]
    public string $provider = 'aws';

    /**
     * AccessKeyId is the access key for the storage provider. Required if not using Chunkify storage.
     */
    #[Required('access_key_id')]
    public string $accessKeyID;

    /**
     * Bucket is the name of the storage bucket.
     */
    #[Required]
    public string $bucket;

    /**
     * Region specifies the region of the storage provider.
     *
     * @var value-of<Region> $region
     */
    #[Required(enum: Region::class)]
    public string $region;

    /**
     * SecretAccessKey is the secret key for the storage provider. Required if not using Chunkify storage.
     */
    #[Required('secret_access_key')]
    public string $secretAccessKey;

    /**
     * Object-key prefix for final job outputs. The API normalizes it without a leading slash and with one trailing slash. Omit it or send an empty string to use the bucket root.
     */
    #[Optional('base_prefix')]
    public ?string $basePrefix;

    /**
     * Optional customer-managed HTTPS delivery origin. It must not contain credentials, a path, query string, or fragment.
     */
    #[Optional('cdn_base_url', nullable: true)]
    public ?string $cdnBaseURL;

    /**
     * Public indicates whether the storage is publicly accessible.
     */
    #[Optional]
    public ?bool $public;

    /**
     * `new StorageAwsCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StorageAwsCreateParams::with(
     *   accessKeyID: ..., bucket: ..., region: ..., secretAccessKey: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StorageAwsCreateParams)
     *   ->withAccessKeyID(...)
     *   ->withBucket(...)
     *   ->withRegion(...)
     *   ->withSecretAccessKey(...)
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
     * @param Region|value-of<Region> $region
     */
    public static function with(
        string $accessKeyID,
        string $bucket,
        Region|string $region,
        string $secretAccessKey,
        ?string $basePrefix = null,
        ?string $cdnBaseURL = null,
        ?bool $public = null,
    ): self {
        $self = new self;

        $self['accessKeyID'] = $accessKeyID;
        $self['bucket'] = $bucket;
        $self['region'] = $region;
        $self['secretAccessKey'] = $secretAccessKey;

        null !== $basePrefix && $self['basePrefix'] = $basePrefix;
        null !== $cdnBaseURL && $self['cdnBaseURL'] = $cdnBaseURL;
        null !== $public && $self['public'] = $public;

        return $self;
    }

    /**
     * AccessKeyId is the access key for the storage provider. Required if not using Chunkify storage.
     */
    public function withAccessKeyID(string $accessKeyID): self
    {
        $self = clone $this;
        $self['accessKeyID'] = $accessKeyID;

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
     * Provider specifies the storage provider.
     *
     * @param 'aws' $provider
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
     * @param Region|value-of<Region> $region
     */
    public function withRegion(Region|string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }

    /**
     * SecretAccessKey is the secret key for the storage provider. Required if not using Chunkify storage.
     */
    public function withSecretAccessKey(string $secretAccessKey): self
    {
        $self = clone $this;
        $self['secretAccessKey'] = $secretAccessKey;

        return $self;
    }

    /**
     * Object-key prefix for final job outputs. The API normalizes it without a leading slash and with one trailing slash. Omit it or send an empty string to use the bucket root.
     */
    public function withBasePrefix(string $basePrefix): self
    {
        $self = clone $this;
        $self['basePrefix'] = $basePrefix;

        return $self;
    }

    /**
     * Optional customer-managed HTTPS delivery origin. It must not contain credentials, a path, query string, or fragment.
     */
    public function withCdnBaseURL(?string $cdnBaseURL): self
    {
        $self = clone $this;
        $self['cdnBaseURL'] = $cdnBaseURL;

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
}
