<?php

declare(strict_types=1);

namespace Chunkify\Core;

/**
 * Distinguishes an omitted argument from an explicit null value.
 */
enum Omit
{
    case Value;
}
