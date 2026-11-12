<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricsUsage\Summary;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Webhook delivery activity.
 *
 * @phpstan-type NotificationsShape = array{failed: int, sent: int}
 */
final class Notifications implements BaseModel
{
    /** @use SdkModel<NotificationsShape> */
    use SdkModel;

    /**
     * Failed specifies recorded failed webhook delivery attempts.
     */
    #[Required]
    public int $failed;

    /**
     * Sent specifies recorded successful webhook deliveries.
     */
    #[Required]
    public int $sent;

    /**
     * `new Notifications()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Notifications::with(failed: ..., sent: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Notifications)->withFailed(...)->withSent(...)
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
     */
    public static function with(int $failed, int $sent): self
    {
        $self = new self;

        $self['failed'] = $failed;
        $self['sent'] = $sent;

        return $self;
    }

    /**
     * Failed specifies recorded failed webhook delivery attempts.
     */
    public function withFailed(int $failed): self
    {
        $self = clone $this;
        $self['failed'] = $failed;

        return $self;
    }

    /**
     * Sent specifies recorded successful webhook deliveries.
     */
    public function withSent(int $sent): self
    {
        $self = clone $this;
        $self['sent'] = $sent;

        return $self;
    }
}
