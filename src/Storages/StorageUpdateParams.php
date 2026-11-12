<?php

declare(strict_types=1);

namespace Chunkify\Storages;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Core\Omit;

/**
 * Update customer-owned storage settings. Send access_key_id and secret_access_key together to rotate credentials for AWS S3, Cloudflare R2, or S3-compatible storage. Both values must be non-empty and non-null. Omitting both preserves the saved pair and skips connection validation. Replacement credentials are checked against the saved bucket, endpoint, region, and addressing style using the creation upload, metadata, and download checks with best-effort probe cleanup. A prefix changed in the same request is used for validation. Both credentials are encrypted and saved atomically with other settings; a failed update preserves the previous values. Credential-only updates keep the Storage ID, resource associations, object paths, and Project default. Subsequent storage lookups use the new pair; running work may retain an existing client or signed URL. Rotation does not renew issued URLs, and revoking old keys can invalidate them. Prefix changes apply to final outputs that have not been uploaded yet. Existing files keep their stored object keys.
 *
 * @see Chunkify\Services\StoragesService::update()
 *
 * @phpstan-type StorageUpdateParamsShape = array{
 *   accessKeyID?: string|null,
 *   basePrefix?: string|null,
 *   cdnBaseURL?: string|null,
 *   secretAccessKey?: string|null,
 * }
 */
final class StorageUpdateParams implements BaseModel
{
    /** @use SdkModel<StorageUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Replacement access key ID for customer-managed storage. Send with a non-empty secret_access_key. Omit both credential fields to keep the saved pair. Null and empty values are rejected. Credentials are validated before either value is saved and are never returned.
     */
    #[Optional('access_key_id')]
    public ?string $accessKeyID;

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

    /**
     * Replacement secret access key. Required with access_key_id; cannot be null or empty. The pair is encrypted and saved atomically only after validation succeeds.
     */
    #[Optional('secret_access_key')]
    public ?string $secretAccessKey;

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
        ?string $accessKeyID = null,
        ?string $basePrefix = null,
        string|Omit|null $cdnBaseURL = Omit::Value,
        ?string $secretAccessKey = null,
    ): self {
        $self = new self;

        null !== $accessKeyID && $self['accessKeyID'] = $accessKeyID;
        null !== $basePrefix && $self['basePrefix'] = $basePrefix;
        Omit::Value !== $cdnBaseURL && $self['cdnBaseURL'] = $cdnBaseURL;
        null !== $secretAccessKey && $self['secretAccessKey'] = $secretAccessKey;

        return $self;
    }

    /**
     * Replacement access key ID for customer-managed storage. Send with a non-empty secret_access_key. Omit both credential fields to keep the saved pair. Null and empty values are rejected. Credentials are validated before either value is saved and are never returned.
     */
    public function withAccessKeyID(string $accessKeyID): self
    {
        $self = clone $this;
        $self['accessKeyID'] = $accessKeyID;

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

    /**
     * Replacement secret access key. Required with access_key_id; cannot be null or empty. The pair is encrypted and saved atomically only after validation succeeds.
     */
    public function withSecretAccessKey(string $secretAccessKey): self
    {
        $self = clone $this;
        $self['secretAccessKey'] = $secretAccessKey;

        return $self;
    }
}
