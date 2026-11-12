<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingMP4Av1;

/**
 * Profilev selects the AV1 Main profile. Use pixfmt to select 8-bit or 10-bit output.
 */
enum Profilev: string
{
    case MAIN = 'main';
}
