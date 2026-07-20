<?php

namespace Chunkify\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Chunkify Rate Limit Exception';
}
