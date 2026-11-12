<?php

declare(strict_types=1);

namespace Chunkify\Events\Event;

/**
 * Summary of the latest retained attempt for each webhook. none means no retained attempts; pending means at least one latest attempt is awaiting delivery; failed means at least one latest attempt failed and none are pending; delivered means all latest attempts succeeded. Earlier failures superseded by successful retries do not mark the event failed.
 */
enum DeliveryStatus: string
{
    case NONE = 'none';

    case PENDING = 'pending';

    case DELIVERED = 'delivered';

    case FAILED = 'failed';
}
