<?php

namespace Chunkify\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Chunkify Bad Request Exception';
}
