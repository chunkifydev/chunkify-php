<?php

declare(strict_types=1);

namespace Chunkify\Uploads;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Core\Omit;
use Chunkify\Uploads\UploadCreateParams\UploadMode;

/**
 * Create an Upload session for a direct transfer to storage. Multipart creation returns every signed part URL. Retry parts with their original URLs and complete before expiry. Customer storage requires long-lived credentials and an incomplete-multipart lifecycle rule. Start a new Upload after abandoning a session.
 *
 * @see Chunkify\Services\UploadsService::create()
 *
 * @phpstan-import-type UploadCreateStorageParamsShape from \Chunkify\Uploads\UploadCreateStorageParams
 *
 * @phpstan-type UploadCreateParamsShape = array{
 *   createAsset?: bool|null,
 *   fileSizeBytes?: int|null,
 *   metadata?: array<string,string>|null,
 *   storage?: null|UploadCreateStorageParams|UploadCreateStorageParamsShape,
 *   uploadMode?: null|UploadMode|value-of<UploadMode>,
 *   validityTimeout?: int|null,
 *   workflowID?: string|null,
 * }
 */
final class UploadCreateParams implements BaseModel
{
    /** @use SdkModel<UploadCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * CreateAsset specifies whether to create an Asset after Upload completion. Defaults to false.
     * Snapshots the Project output settings, including the path template. Referenced metadata must be non-empty in this request. Asset processing is billed separately.
     */
    #[Optional('create_asset')]
    public ?bool $createAsset;

    /**
     * FileSizeBytes specifies the exact file size in bytes. Required when UploadMode is omitted, auto, or multipart. Optional for explicit single mode. Must fit the team's Source size limit. Single PUT supports up to 5 GiB, subject to the provider's limit; multipart supports up to 5 TiB.
     */
    #[Optional('file_size_bytes')]
    public ?int $fileSizeBytes;

    /**
     * Metadata allows for additional information to be attached to the upload, with a maximum size of 2048 bytes.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * Optional Storage override. Omit id to use the Project default. Customer-connected Storage requires path; Chunkify Storage generates its own path.
     */
    #[Optional]
    public ?UploadCreateStorageParams $storage;

    /**
     * UploadMode specifies the transfer method. Defaults to auto. Auto chooses multipart above 100 MiB and single PUT at or below 100 MiB for every Storage provider. Multipart requires a provider that supports the required multipart operations and signed part URLs. Provider failures return an error without falling back to single PUT.
     *
     * @var value-of<UploadMode>|null $uploadMode
     */
    #[Optional('upload_mode', enum: UploadMode::class)]
    public ?string $uploadMode;

    /**
     * ValidityTimeout specifies the session and signed URL lifetime in seconds. Single PUT defaults to 7200 and allows 300–36000. Multipart defaults to twice the transfer time at 5 Mbps plus 1800 seconds, bounded to 7200–172800; an explicit value allows 300–172800. Complete before expiry. Storage credentials and policies can shorten URL validity. Expired URLs cannot be refreshed.
     */
    #[Optional('validity_timeout')]
    public ?int $validityTimeout;

    /**
     * WorkflowId specifies the Workflow to select. Omit to use the Project default. Set null to disable automatic actions. The current revision is pinned when creation is accepted.
     */
    #[Optional('workflow_id', nullable: true)]
    public ?string $workflowID;

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
     * @param UploadCreateStorageParams|UploadCreateStorageParamsShape|null $storage
     * @param UploadMode|value-of<UploadMode>|null $uploadMode
     */
    public static function with(
        ?bool $createAsset = null,
        ?int $fileSizeBytes = null,
        ?array $metadata = null,
        UploadCreateStorageParams|array|null $storage = null,
        UploadMode|string|null $uploadMode = null,
        ?int $validityTimeout = null,
        string|Omit|null $workflowID = Omit::Value,
    ): self {
        $self = new self;

        null !== $createAsset && $self['createAsset'] = $createAsset;
        null !== $fileSizeBytes && $self['fileSizeBytes'] = $fileSizeBytes;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $storage && $self['storage'] = $storage;
        null !== $uploadMode && $self['uploadMode'] = $uploadMode;
        null !== $validityTimeout && $self['validityTimeout'] = $validityTimeout;
        Omit::Value !== $workflowID && $self['workflowID'] = $workflowID;

        return $self;
    }

    /**
     * CreateAsset specifies whether to create an Asset after Upload completion. Defaults to false.
     * Snapshots the Project output settings, including the path template. Referenced metadata must be non-empty in this request. Asset processing is billed separately.
     */
    public function withCreateAsset(bool $createAsset): self
    {
        $self = clone $this;
        $self['createAsset'] = $createAsset;

        return $self;
    }

    /**
     * FileSizeBytes specifies the exact file size in bytes. Required when UploadMode is omitted, auto, or multipart. Optional for explicit single mode. Must fit the team's Source size limit. Single PUT supports up to 5 GiB, subject to the provider's limit; multipart supports up to 5 TiB.
     */
    public function withFileSizeBytes(int $fileSizeBytes): self
    {
        $self = clone $this;
        $self['fileSizeBytes'] = $fileSizeBytes;

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
     * Optional Storage override. Omit id to use the Project default. Customer-connected Storage requires path; Chunkify Storage generates its own path.
     *
     * @param UploadCreateStorageParams|UploadCreateStorageParamsShape $storage
     */
    public function withStorage(UploadCreateStorageParams|array $storage): self
    {
        $self = clone $this;
        $self['storage'] = $storage;

        return $self;
    }

    /**
     * UploadMode specifies the transfer method. Defaults to auto. Auto chooses multipart above 100 MiB and single PUT at or below 100 MiB for every Storage provider. Multipart requires a provider that supports the required multipart operations and signed part URLs. Provider failures return an error without falling back to single PUT.
     *
     * @param UploadMode|value-of<UploadMode> $uploadMode
     */
    public function withUploadMode(UploadMode|string $uploadMode): self
    {
        $self = clone $this;
        $self['uploadMode'] = $uploadMode;

        return $self;
    }

    /**
     * ValidityTimeout specifies the session and signed URL lifetime in seconds. Single PUT defaults to 7200 and allows 300–36000. Multipart defaults to twice the transfer time at 5 Mbps plus 1800 seconds, bounded to 7200–172800; an explicit value allows 300–172800. Complete before expiry. Storage credentials and policies can shorten URL validity. Expired URLs cannot be refreshed.
     */
    public function withValidityTimeout(int $validityTimeout): self
    {
        $self = clone $this;
        $self['validityTimeout'] = $validityTimeout;

        return $self;
    }

    /**
     * WorkflowId specifies the Workflow to select. Omit to use the Project default. Set null to disable automatic actions. The current revision is pinned when creation is accepted.
     */
    public function withWorkflowID(?string $workflowID): self
    {
        $self = clone $this;
        $self['workflowID'] = $workflowID;

        return $self;
    }
}
