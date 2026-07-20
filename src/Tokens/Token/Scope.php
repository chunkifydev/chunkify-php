<?php

declare(strict_types=1);

namespace Chunkify\Tokens\Token;

/**
 * Access scope of the token.
 */
enum Scope: string
{
    case PROJECT = 'project';

    case TEAM = 'team';
}
