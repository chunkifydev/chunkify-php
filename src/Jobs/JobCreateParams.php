<?php

declare(strict_types=1);

namespace Chunkify\Jobs;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Jobs\JobCreateParams\Format;
use Chunkify\Jobs\JobCreateParams\Storage;
use Chunkify\Jobs\JobCreateParams\Transcoder;

/**
 * Create a new video processing job with specified parameters. The job is created with pending status and waits for scheduler admission before processing. Pending jobs are admitted oldest first across all projects in the team as vCPU capacity becomes available.
 *
 * @see Chunkify\Services\JobsService::create()
 *
 * @phpstan-import-type FormatVariants from \Chunkify\Jobs\JobCreateParams\Format
 * @phpstan-import-type FormatShape from \Chunkify\Jobs\JobCreateParams\Format
 * @phpstan-import-type StorageShape from \Chunkify\Jobs\JobCreateParams\Storage
 * @phpstan-import-type TranscoderShape from \Chunkify\Jobs\JobCreateParams\Transcoder
 *
 * @phpstan-type JobCreateParamsShape = array{
 *   format: FormatShape,
 *   sourceID: string,
 *   hlsManifestID?: string|null,
 *   metadata?: array<string,string>|null,
 *   storage?: null|Storage|StorageShape,
 *   transcoder?: null|Transcoder|TranscoderShape,
 * }
 */
final class JobCreateParams implements BaseModel
{
    /** @use SdkModel<JobCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Required format configuration, one and only one valid format configuration must be provided.
     * If you want to use a format without specifying any configuration, use an empty object in the corresponding field.
     *
     * @var FormatVariants $format
     */
    #[Required(union: Format::class)]
    public MP4Av1|MP4H264|MP4H265|WebmVp9|HlsAv1|HlsH264|HlsH265|Jpg $format;

    /**
     * The ID of the source file to transcode.
     */
    #[Required('source_id')]
    public string $sourceID;

    /**
     * Optional HLS manifest configuration
     * Use the same hls manifest ID to group multiple jobs into a single HLS manifest
     * By default, it's automatically generated if no set for HLS jobs.
     */
    #[Optional('hls_manifest_id')]
    public ?string $hlsManifestID;

    /**
     * Optional metadata to attach to the job, the maximum size allowed is 2048 bytes.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * Optional storage configuration.
     */
    #[Optional]
    public ?Storage $storage;

    /**
     * Optional transcoder configuration. If not provided, the system will automatically
     * calculate the optimal quantity and CPU type based on the source file specifications
     * and output requirements. This auto-scaling ensures efficient resource utilization.
     */
    #[Optional]
    public ?Transcoder $transcoder;

    /**
     * `new JobCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JobCreateParams::with(format: ..., sourceID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JobCreateParams)->withFormat(...)->withSourceID(...)
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
     * @param array<string,string>|null $metadata
     * @param Storage|StorageShape|null $storage
     * @param Transcoder|TranscoderShape|null $transcoder
     */
    public static function with(
        MP4Av1|array|MP4H264|MP4H265|WebmVp9|HlsAv1|HlsH264|HlsH265|Jpg $format,
        string $sourceID,
        ?string $hlsManifestID = null,
        ?array $metadata = null,
        Storage|array|null $storage = null,
        Transcoder|array|null $transcoder = null,
    ): self {
        $self = new self;

        $self['format'] = $format;
        $self['sourceID'] = $sourceID;

        null !== $hlsManifestID && $self['hlsManifestID'] = $hlsManifestID;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $storage && $self['storage'] = $storage;
        null !== $transcoder && $self['transcoder'] = $transcoder;

        return $self;
    }

    /**
     * Required format configuration, one and only one valid format configuration must be provided.
     * If you want to use a format without specifying any configuration, use an empty object in the corresponding field.
     *
     * @param FormatShape $format
     */
    public function withFormat(
        MP4Av1|array|MP4H264|MP4H265|WebmVp9|HlsAv1|HlsH264|HlsH265|Jpg $format
    ): self {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * The ID of the source file to transcode.
     */
    public function withSourceID(string $sourceID): self
    {
        $self = clone $this;
        $self['sourceID'] = $sourceID;

        return $self;
    }

    /**
     * Optional HLS manifest configuration
     * Use the same hls manifest ID to group multiple jobs into a single HLS manifest
     * By default, it's automatically generated if no set for HLS jobs.
     */
    public function withHlsManifestID(string $hlsManifestID): self
    {
        $self = clone $this;
        $self['hlsManifestID'] = $hlsManifestID;

        return $self;
    }

    /**
     * Optional metadata to attach to the job, the maximum size allowed is 2048 bytes.
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
     * Optional storage configuration.
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
     * Optional transcoder configuration. If not provided, the system will automatically
     * calculate the optimal quantity and CPU type based on the source file specifications
     * and output requirements. This auto-scaling ensures efficient resource utilization.
     *
     * @param Transcoder|TranscoderShape $transcoder
     */
    public function withTranscoder(Transcoder|array $transcoder): self
    {
        $self = clone $this;
        $self['transcoder'] = $transcoder;

        return $self;
    }
}
