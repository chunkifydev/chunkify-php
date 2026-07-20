<?php

namespace Chunkify\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Chunkify Internal Server Exception';
}
