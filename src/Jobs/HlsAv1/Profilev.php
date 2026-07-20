<?php

declare(strict_types=1);

namespace Chunkify\Jobs\HlsAv1;

/**
 * Profilev specifies the AV1 profile. Valid values:
 * - main: Main profile, good for most applications
 * - main10: Main 10-bit profile, supports 10-bit color
 * - mainstillpicture: Still picture profile, optimized for single images
 */
enum Profilev: string
{
    case MAIN = 'main';

    case MAIN10 = 'main10';

    case MAINSTILLPICTURE = 'mainstillpicture';
}
