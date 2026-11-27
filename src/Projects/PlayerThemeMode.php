<?php

declare(strict_types=1);

namespace Chunkify\Projects;

enum PlayerThemeMode: string
{
    case AUTO = 'auto';

    case LIGHT = 'light';

    case DARK = 'dark';
}
