<?php

declare(strict_types=1);

namespace Chunkify\Projects\Project\PlayerAppearance;

/**
 * Mode specifies which palette the player uses. auto follows the viewer's system setting.
 */
enum Mode: string
{
    case AUTO = 'auto';

    case LIGHT = 'light';

    case DARK = 'dark';
}
