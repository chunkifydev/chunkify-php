<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Transcodings\Transcoding;

/**
 * Payload for transcoding.created, transcoding.ready, transcoding.failed, transcoding.cancelled, transcoding.expired and transcoding.deleted events.
 *
 * @phpstan-import-type TranscodingShape from \Chunkify\Transcodings\Transcoding
 *
 * @phpstan-type NotificationPayloadTranscodingDataShape = array{
 *   transcoding: Transcoding|TranscodingShape
 * }
 */
final class NotificationPayloadTranscodingData implements BaseModel
{
    /** @use SdkModel<NotificationPayloadTranscodingDataShape> */
    use SdkModel;

    /**
     * Transcoding contains the canonical resource snapshot at the event time.
     */
    #[Required]
    public Transcoding $transcoding;

    /**
     * `new NotificationPayloadTranscodingData()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPayloadTranscodingData::with(transcoding: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPayloadTranscodingData)->withTranscoding(...)
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
