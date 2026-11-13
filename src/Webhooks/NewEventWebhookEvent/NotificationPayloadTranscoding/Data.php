<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadTranscoding;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Transcodings\Transcoding;

/**
 * Payload for the event named in event. Replays preserve the original data; retrieve the resource for current state and fresh signed URLs.
 *
 * @phpstan-import-type TranscodingShape from \Chunkify\Transcodings\Transcoding
 *
 * @phpstan-type DataShape = array{transcoding: Transcoding|TranscodingShape}
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Transcoding contains the canonical resource snapshot at the event time.
     */
    #[Required]
    public Transcoding $transcoding;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(transcoding: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withTranscoding(...)
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
     * @param Transcoding|TranscodingShape $transcoding
     */
    public static function with(Transcoding|array $transcoding): self
    {
        $self = new self;

        $self['transcoding'] = $transcoding;

        return $self;
    }

    /**
     * Transcoding contains the canonical resource snapshot at the event time.
     *
     * @param Transcoding|TranscodingShape $transcoding
     */
    public function withTranscoding(Transcoding|array $transcoding): self
    {
        $self = clone $this;
        $self['transcoding'] = $transcoding;

        return $self;
    }
}
