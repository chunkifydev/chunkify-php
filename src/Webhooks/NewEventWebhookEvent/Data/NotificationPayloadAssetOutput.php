<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NewEventWebhookEvent\Data;

use Chunkify\Assets\Outputs\AssetOutput;
use Chunkify\Assets\Outputs\AssetOutput\AssetCaptionOutput;
use Chunkify\Assets\Outputs\AssetOutput\AssetStaticRenditionOutput;
use Chunkify\Assets\Outputs\AssetOutput\AssetThumbnailOutput;
use Chunkify\Assets\Outputs\AssetOutput\AssetTranscriptOutput;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Payload for Asset output creation, readiness, and failure events.
 *
 * @phpstan-import-type AssetOutputVariants from \Chunkify\Assets\Outputs\AssetOutput
 * @phpstan-import-type AssetOutputShape from \Chunkify\Assets\Outputs\AssetOutput
 *
 * @phpstan-type NotificationPayloadAssetOutputShape = array{
 *   output: AssetOutputShape
 * }
 */
final class NotificationPayloadAssetOutput implements BaseModel
{
    /** @use SdkModel<NotificationPayloadAssetOutputShape> */
    use SdkModel;

    /**
     * Output contains the canonical typed output snapshot at the event time, matching the output API.
     *
     * @var AssetOutputVariants $output
     */
    #[Required(union: AssetOutput::class)]
    public AssetCaptionOutput|AssetStaticRenditionOutput|AssetThumbnailOutput|AssetTranscriptOutput $output;

    /**
     * `new NotificationPayloadAssetOutput()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPayloadAssetOutput::with(output: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPayloadAssetOutput)->withOutput(...)
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
        AssetCaptionOutput|array|AssetStaticRenditionOutput|AssetThumbnailOutput|AssetTranscriptOutput $output,
    ): self {
        $self = new self;

        $self['output'] = $output;

        return $self;
    }

    /**
     * Output contains the canonical typed output snapshot at the event time, matching the output API.
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
