<?php

declare(strict_types=1);

namespace Chunkify\Jobs;

use Chunkify\ChunkifyError;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Jobs\Job\Format;
use Chunkify\Jobs\Job\Format\JobsHlsAv1;
use Chunkify\Jobs\Job\Format\JobsHlsH264;
use Chunkify\Jobs\Job\Format\JobsHlsH265;
use Chunkify\Jobs\Job\Format\JobsJpg;
use Chunkify\Jobs\Job\Format\JobsMP4Av1;
use Chunkify\Jobs\Job\Format\JobsMP4H264;
use Chunkify\Jobs\Job\Format\JobsMP4H265;
use Chunkify\Jobs\Job\Format\JobsWebmVp9;
use Chunkify\Jobs\Job\Status;
use Chunkify\Jobs\Job\Storage;
use Chunkify\Jobs\Job\Transcoder;

/**
 * @phpstan-import-type FormatVariants from \Chunkify\Jobs\Job\Format
 * @phpstan-import-type FormatShape from \Chunkify\Jobs\Job\Format
 * @phpstan-import-type StorageShape from \Chunkify\Jobs\Job\Storage
 * @phpstan-import-type TranscoderShape from \Chunkify\Jobs\Job\Transcoder
 * @phpstan-import-type ChunkifyErrorShape from \Chunkify\ChunkifyError
 *
 * @phpstan-type JobShape = array{
 *   id: string,
 *   billableTime: int,
 *   createdAt: \DateTimeInterface,
 *   format: FormatShape,
 *   progress: float,
 *   sourceID: string,
 *   status: Status|value-of<Status>,
 *   storage: Storage|StorageShape,
 *   transcoder: Transcoder|TranscoderShape,
 *   updatedAt: \DateTimeInterface,
 *   error?: null|ChunkifyError|ChunkifyErrorShape,
 *   hlsManifestID?: string|null,
 *   metadata?: array<string,string>|null,
 *   startedAt?: \DateTimeInterface|null,
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
     * A template defines the transcoding parameters and settings for a job.
     *
     * @var FormatVariants $format
     */
    #[Required(union: Format::class)]
    public JobsMP4Av1|JobsMP4H264|JobsMP4H265|JobsWebmVp9|JobsHlsAv1|JobsHlsH264|JobsHlsH265|JobsJpg $format;

    /**
     * Progress percentage of the job (0-100).
     */
    #[Required]
    public float $progress;

    /**
     * ID of the source video being transcoded.
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
    public Storage $storage;

    /**
     * The transcoder configuration for a job.
     */
    #[Required]
    public Transcoder $transcoder;

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
     *   transcoder: ...,
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
     *   ->withTranscoder(...)
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
     * @param FormatShape $format
     * @param Storage|StorageShape $storage
     * @param Transcoder|TranscoderShape $transcoder
     * @param Status|value-of<Status> $status
     * @param ChunkifyError|ChunkifyErrorShape|null $error
     * @param array<string,string>|null $metadata
     */
    public static function with(
        string $id,
        int $billableTime,
        \DateTimeInterface $createdAt,
        JobsMP4Av1|array|JobsMP4H264|JobsMP4H265|JobsWebmVp9|JobsHlsAv1|JobsHlsH264|JobsHlsH265|JobsJpg $format,
        float $progress,
        string $sourceID,
        Storage|array $storage,
        Transcoder|array $transcoder,
        \DateTimeInterface $updatedAt,
        Status|string $status = 'queued',
        ChunkifyError|array|null $error = null,
        ?string $hlsManifestID = null,
        ?array $metadata = null,
        ?\DateTimeInterface $startedAt = null,
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
        $self['transcoder'] = $transcoder;
        $self['updatedAt'] = $updatedAt;

        null !== $error && $self['error'] = $error;
        null !== $hlsManifestID && $self['hlsManifestID'] = $hlsManifestID;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $startedAt && $self['startedAt'] = $startedAt;

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
     * A template defines the transcoding parameters and settings for a job.
     *
     * @param FormatShape $format
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
     * ID of the source video being transcoded.
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
     * @param Storage|StorageShape $storage
     */
    public function withStorage(Storage|array $storage): self
    {
        $self = clone $this;
        $self['storage'] = $storage;

        return $self;
    }

    /**
     * The transcoder configuration for a job.
     *
     * @param Transcoder|TranscoderShape $transcoder
     */
    public function withTranscoder(Transcoder|array $transcoder): self
    {
        $self = clone $this;
        $self['transcoder'] = $transcoder;

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
}
