<?php

declare(strict_types=1);

namespace Chunkify\Assets\Asset;

/**
 * Status specifies the Asset preparation state. ready means the video is prepared for playback, with its poster and timeline previews available. Static renditions and captions have independent statuses.
 */
enum Status: string
{
    case PREPARING = 'preparing';

    case READY = 'ready';

    case FAILED = 'failed';

    case EXPIRED = 'expired';
}
