<?php

namespace Chunkify\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Chunkify Conflict Exception';
}
