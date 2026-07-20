<?php

namespace Chunkify\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Chunkify Authentication Exception';
}
