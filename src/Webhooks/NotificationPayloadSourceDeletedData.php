<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Sources\Source;

/**
 * Payload for source.deleted. The Source was deleted on request or after the team's data retention period. Resources created from it are preserved and no longer report its source_id.
 *
 * @phpstan-import-type SourceShape from \Chunkify\Sources\Source
 *
 * @phpstan-type NotificationPayloadSourceDeletedDataShape = array{
 *   source: Source|SourceShape
 * }
 */
final class NotificationPayloadSourceDeletedData implements BaseModel
{
    /** @use SdkModel<NotificationPayloadSourceDeletedDataShape> */
    use SdkModel;

    /**
     * Source contains the last snapshot before deletion.
     */
    #[Required]
    public Source $source;

    /**
     * `new NotificationPayloadSourceDeletedData()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPayloadSourceDeletedData::with(source: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPayloadSourceDeletedData)->withSource(...)
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
     * Source contains the last snapshot before deletion.
     *
     * @param Source|SourceShape $source
     */
    public function withSource(Source|array $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }
}
