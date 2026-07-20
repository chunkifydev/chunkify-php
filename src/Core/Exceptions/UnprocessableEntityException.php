<?php

namespace Chunkify\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Chunkify Unprocessable Entity Exception';
}
