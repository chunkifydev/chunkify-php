<?php

declare(strict_types=1);

namespace Chunkify\Projects\ProjectUpdateParams\PlayerAppearance;

/**
 * Mode specifies which palette the player uses. auto follows the viewer's system setting.
 * An embed can override it with its theme URL parameter. Defaults to auto.
 */
enum Mode: string
{
    case AUTO = 'auto';

    case LIGHT = 'light';

    case DARK = 'dark';
}
