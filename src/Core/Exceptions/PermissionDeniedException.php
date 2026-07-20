<?php

namespace Chunkify\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Chunkify Permission Denied Exception';
}
