<?php

declare(strict_types=1);

namespace Chunkify\Tokens;

enum TokenScope: string
{
    case PROJECT = 'project';

    case TEAM = 'team';
}
