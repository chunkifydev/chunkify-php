<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Job\Transcoder;

/**
 * Type of transcoder instance.
 */
enum Type: string
{
    case _4V_CPU = '4vCPU';

    case _8V_CPU = '8vCPU';

    case _16V_CPU = '16vCPU';
}
