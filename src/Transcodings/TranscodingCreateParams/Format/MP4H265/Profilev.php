<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H265;

/**
 * Profilev selects the HEVC profile. It must support the requested pixel format.
 */
enum Profilev: string
{
    case MAIN = 'main';

    case MAIN10 = 'main10';

    case MAIN12 = 'main12';

    case MAIN422_10 = 'main422-10';

    case MAIN422_12 = 'main422-12';

    case MAIN444_8 = 'main444-8';

    case MAIN444_10 = 'main444-10';

    case MAIN444_12 = 'main444-12';
}
