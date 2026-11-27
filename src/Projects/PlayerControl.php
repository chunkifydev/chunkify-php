<?php

declare(strict_types=1);

namespace Chunkify\Projects;

enum PlayerControl: string
{
    case CAPTIONS = 'captions';

    case SETTINGS = 'settings';

    case PIP = 'pip';

    case FULLSCREEN = 'fullscreen';

    case CAST = 'cast';

    case AIRPLAY = 'airplay';

    case MUTE = 'mute';
}
