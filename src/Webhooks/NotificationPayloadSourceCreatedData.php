<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Sources\Source;

/**
 * Payload for source.created. The Source has been validated and saved. Thumbnails may still be pending.
 *
 * @phpstan-import-type SourceShape from \Chunkify\Sources\Source
 *
 * @phpstan-type NotificationPayloadSourceCreatedDataShape = array{
 *   source: Source|SourceShape
 * }
 */
final class NotificationPayloadSourceCreatedData implements BaseModel
{
    /** @use SdkModel<NotificationPayloadSourceCreatedDataShape> */
    use SdkModel;

    #[Required]
    public Source $source;

    /**
     * `new NotificationPayloadSourceCreatedData()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPayloadSourceCreatedData::with(source: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPayloadSourceCreatedData)->withSource(...)
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
     * @param Source|SourceShape $source
     */
    public static function with(Source|array $source): self
    {
        $self = new self;

        $self['source'] = $source;

        return $self;
    }

    /**
     * @param Source|SourceShape $source
     */
    public function withSource(Source|array $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }
}
