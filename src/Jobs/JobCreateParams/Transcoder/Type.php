<?php

declare(strict_types=1);

namespace Chunkify\Jobs\JobCreateParams\Transcoder;

/**
 * Type specifies the CPU configuration for each transcoder instance.
 * Required if Quantity is set.
 */
enum Type: string
{
    case _4V_CPU = '4vCPU';

    case _8V_CPU = '8vCPU';

    case _16V_CPU = '16vCPU';
}
