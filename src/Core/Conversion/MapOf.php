<?php

declare(strict_types=1);

namespace Chunkify\Core\Conversion;

use Chunkify\Core\Conversion\Concerns\ArrayOf;
use Chunkify\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
