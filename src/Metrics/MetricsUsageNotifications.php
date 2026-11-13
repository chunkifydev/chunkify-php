<?php

declare(strict_types=1);

namespace Chunkify\Metrics;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Webhook delivery activity.
 *
 * @phpstan-type MetricsUsageNotificationsShape = array{failed: int, sent: int}
 */
final class MetricsUsageNotifications implements BaseModel
{
    /** @use SdkModel<MetricsUsageNotificationsShape> */
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
     * `new MetricsUsageNotifications()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MetricsUsageNotifications::with(failed: ..., sent: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MetricsUsageNotifications)->withFailed(...)->withSent(...)
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
