<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadAssetOutputDeleted;

use Chunkify\Assets\Outputs\AssetOutput;
use Chunkify\Assets\Outputs\AssetOutput\AssetCaptionOutput;
use Chunkify\Assets\Outputs\AssetOutput\AssetStaticRenditionOutput;
use Chunkify\Assets\Outputs\AssetOutput\AssetThumbnailOutput;
use Chunkify\Assets\Outputs\AssetOutput\AssetTranscriptOutput;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Payload for the event named in event. Replays preserve the original data; retrieve the resource for current state and fresh signed URLs.
 *
 * @phpstan-import-type AssetOutputVariants from \Chunkify\Assets\Outputs\AssetOutput
 * @phpstan-import-type AssetOutputShape from \Chunkify\Assets\Outputs\AssetOutput
 *
 * @phpstan-type DataShape = array{filesDeleted: bool, output: AssetOutputShape}
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * FilesDeleted indicates whether the requested cleanup of the output files completed without error. Missing files count as successful cleanup. False means these files were not removed at event time. Private transcript text and saved subtitle copies are always scheduled for asynchronous cleanup.
     */
    #[Required('files_deleted')]
    public bool $filesDeleted;

    /**
     * Output contains the canonical typed output snapshot before removal.
     *
     * @var AssetOutputVariants $output
     */
    #[Required(union: AssetOutput::class)]
    public AssetCaptionOutput|AssetStaticRenditionOutput|AssetThumbnailOutput|AssetTranscriptOutput $output;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(filesDeleted: ..., output: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withFilesDeleted(...)->withOutput(...)
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
     * @param AssetOutputShape $output
     */
    public static function with(
        bool $filesDeleted,
        AssetCaptionOutput|array|AssetStaticRenditionOutput|AssetThumbnailOutput|AssetTranscriptOutput $output,
    ): self {
        $self = new self;

        $self['filesDeleted'] = $filesDeleted;
        $self['output'] = $output;

        return $self;
    }

    /**
     * FilesDeleted indicates whether the requested cleanup of the output files completed without error. Missing files count as successful cleanup. False means these files were not removed at event time. Private transcript text and saved subtitle copies are always scheduled for asynchronous cleanup.
     */
    public function withFilesDeleted(bool $filesDeleted): self
    {
        $self = clone $this;
        $self['filesDeleted'] = $filesDeleted;

        return $self;
    }

    /**
     * Output contains the canonical typed output snapshot before removal.
     *
     * @param AssetOutputShape $output
     */
    public function withOutput(
        AssetCaptionOutput|array|AssetStaticRenditionOutput|AssetThumbnailOutput|AssetTranscriptOutput $output,
    ): self {
        $self = clone $this;
        $self['output'] = $output;

        return $self;
    }
}
