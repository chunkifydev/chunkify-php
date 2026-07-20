<?php

namespace Chunkify\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Chunkify Not Found Exception';
}
