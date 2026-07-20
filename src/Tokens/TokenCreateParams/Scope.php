<?php

declare(strict_types=1);

namespace Chunkify\Tokens\TokenCreateParams;

/**
 * Scope specifies the scope of the token, which must be either "team" or "project".
 */
enum Scope: string
{
    case PROJECT = 'project';

    case TEAM = 'team';
}
