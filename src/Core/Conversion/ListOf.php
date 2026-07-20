<?php

declare(strict_types=1);

namespace Chunkify\Core\Conversion;

use Chunkify\Core\Conversion\Concerns\ArrayOf;
use Chunkify\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    // @phpstan-ignore-next-line missingType.iterableValue
    private function empty(): array|object
    {
        return [];
    }
}
