<?php

declare(strict_types=1);

namespace Chunkify\Jobs;

use Chunkify\ChunkifyError;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Jobs\Job\Status;
use Chunkify\Jobs\JobFormat\JobsHlsAv1;
use Chunkify\Jobs\JobFormat\JobsHlsH264;
use Chunkify\Jobs\JobFormat\JobsHlsH265;
use Chunkify\Jobs\JobFormat\JobsJpg;
use Chunkify\Jobs\JobFormat\JobsMP4Av1;
use Chunkify\Jobs\JobFormat\JobsMP4H264;
use Chunkify\Jobs\JobFormat\JobsMP4H265;
use Chunkify\Jobs\JobFormat\JobsWebmVp9;

/**
 * @phpstan-import-type JobFormatVariants from \Chunkify\Jobs\JobFormat
 * @phpstan-import-type JobFormatShape from \Chunkify\Jobs\JobFormat
 * @phpstan-import-type JobStorageShape from \Chunkify\Jobs\JobStorage
 * @phpstan-import-type ChunkifyErrorShape from \Chunkify\ChunkifyError
 * @phpstan-import-type JobTranscoderShape from \Chunkify\Jobs\JobTranscoder
 *
 * @phpstan-type JobShape = array{
 *   id: string,
 *   billableTime: int,
 *   createdAt: \DateTimeInterface,
 *   format: JobFormatShape,
 *   progress: float,
 *   sourceID: string,
 *   status: Status|value-of<Status>,
 *   storage: JobStorage|JobStorageShape,
 *   updatedAt: \DateTimeInterface,
 *   error?: null|ChunkifyError|ChunkifyErrorShape,
 *   hlsManifestID?: string|null,
 *   metadata?: array<string,string>|null,
 *   startedAt?: \DateTimeInterface|null,
 *   transcoder?: null|JobTranscoder|JobTranscoderShape,
 * }
 */
final class Job implements BaseModel
{
    /** @use SdkModel<JobShape> */
    use SdkModel;

    /**
     * Unique identifier for the job.
     */
    #[Required]
    public string $id;

    /**
     * Billable time in seconds.
     */
    #[Required('billable_time')]
    public int $billableTime;

    /**
     * Creation timestamp.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The format parameters and settings for a job.
     *
     * @var JobFormatVariants $format
     */
    #[Required(union: JobFormat::class)]
    public JobsMP4Av1|JobsMP4H264|JobsMP4H265|JobsWebmVp9|JobsHlsAv1|JobsHlsH264|JobsHlsH265|JobsJpg $format;

    /**
     * Progress percentage of the job (0-100).
     */
    #[Required]
    public float $progress;

    /**
     * ID of the source media being processed.
     */
    #[Required('source_id')]
    public string $sourceID;

    /**
     * Current status of the job.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Storage settings for where the job output will be saved.
     */
    #[Required]
    public JobStorage $storage;

    /**
     * Last update timestamp.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Error message for the job.
     */
    #[Optional]
    public ?ChunkifyError $error;

    /**
     * HLS manifest ID.
     */
    #[Optional('hls_manifest_id')]
    public ?string $hlsManifestID;

    /**
     * Additional metadata for the job.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * When the job started processing.
     */
    #[Optional('started_at')]
    public ?\DateTimeInterface $startedAt;

    /**
     * The transcoder configuration for a job.
     */
    #[Optional]
    public ?JobTranscoder $transcoder;

    /**
     * `new Job()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Job::with(
     *   id: ...,
     *   billableTime: ...,
     *   createdAt: ...,
     *   format: ...,
     *   progress: ...,
     *   sourceID: ...,
     *   status: ...,
     *   storage: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Job)
     *   ->withID(...)
     *   ->withBillableTime(...)
     *   ->withCreatedAt(...)
     *   ->withFormat(...)
     *   ->withProgress(...)
     *   ->withSourceID(...)
     *   ->withStatus(...)
     *   ->withStorage(...)
     *   ->withUpdatedAt(...)
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
     * @param JobFormatShape $format
     * @param JobStorage|JobStorageShape $storage
     * @param Status|value-of<Status> $status
     * @param ChunkifyError|ChunkifyErrorShape|null $error
     * @param array<string,string>|null $metadata
     * @param JobTranscoder|JobTranscoderShape|null $transcoder
     */
    public static function with(
        string $id,
        int $billableTime,
        \DateTimeInterface $createdAt,
        JobsMP4Av1|array|JobsMP4H264|JobsMP4H265|JobsWebmVp9|JobsHlsAv1|JobsHlsH264|JobsHlsH265|JobsJpg $format,
        float $progress,
        string $sourceID,
        JobStorage|array $storage,
        \DateTimeInterface $updatedAt,
        Status|string $status = 'pending',
        ChunkifyError|array|null $error = null,
        ?string $hlsManifestID = null,
        ?array $metadata = null,
        ?\DateTimeInterface $startedAt = null,
        JobTranscoder|array|null $transcoder = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['billableTime'] = $billableTime;
        $self['createdAt'] = $createdAt;
        $self['format'] = $format;
        $self['progress'] = $progress;
        $self['sourceID'] = $sourceID;
        $self['status'] = $status;
        $self['storage'] = $storage;
        $self['updatedAt'] = $updatedAt;

        null !== $error && $self['error'] = $error;
        null !== $hlsManifestID && $self['hlsManifestID'] = $hlsManifestID;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $startedAt && $self['startedAt'] = $startedAt;
        null !== $transcoder && $self['transcoder'] = $transcoder;

        return $self;
    }

    /**
     * Unique identifier for the job.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Billable time in seconds.
     */
    public function withBillableTime(int $billableTime): self
    {
        $self = clone $this;
        $self['billableTime'] = $billableTime;

        return $self;
    }

    /**
     * Creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The format parameters and settings for a job.
     *
     * @param JobFormatShape $format
     */
    public function withFormat(
        JobsMP4Av1|array|JobsMP4H264|JobsMP4H265|JobsWebmVp9|JobsHlsAv1|JobsHlsH264|JobsHlsH265|JobsJpg $format,
    ): self {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Progress percentage of the job (0-100).
     */
    public function withProgress(float $progress): self
    {
        $self = clone $this;
        $self['progress'] = $progress;

        return $self;
    }

    /**
     * ID of the source media being processed.
     */
    public function withSourceID(string $sourceID): self
    {
        $self = clone $this;
        $self['sourceID'] = $sourceID;

        return $self;
    }

    /**
     * Current status of the job.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Storage settings for where the job output will be saved.
     *
     * @param JobStorage|JobStorageShape $storage
     */
    public function withStorage(JobStorage|array $storage): self
    {
        $self = clone $this;
        $self['storage'] = $storage;

        return $self;
    }

    /**
     * Last update timestamp.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Error message for the job.
     *
     * @param ChunkifyError|ChunkifyErrorShape $error
     */
    public function withError(ChunkifyError|array $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * HLS manifest ID.
     */
    public function withHlsManifestID(string $hlsManifestID): self
    {
        $self = clone $this;
        $self['hlsManifestID'] = $hlsManifestID;

        return $self;
    }

    /**
     * Additional metadata for the job.
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
     * When the job started processing.
     */
    public function withStartedAt(\DateTimeInterface $startedAt): self
    {
        $self = clone $this;
        $self['startedAt'] = $startedAt;

        return $self;
    }

    /**
     * The transcoder configuration for a job.
     *
     * @param JobTranscoder|JobTranscoderShape $transcoder
     */
    public function withTranscoder(JobTranscoder|array $transcoder): self
    {
        $self = clone $this;
        $self['transcoder'] = $transcoder;

        return $self;
    }
}
