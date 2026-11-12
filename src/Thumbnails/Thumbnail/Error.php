<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails\Thumbnail;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Error explains a failed request. Omitted otherwise.
 *
 * @phpstan-type ErrorShape = array{code: string, message: string}
 */
final class Error implements BaseModel
{
    /** @use SdkModel<ErrorShape> */
    use SdkModel;

    /**
     * Code identifies the processing failure.
     */
    #[Required]
    public string $code;

    /**
     * Message explains the processing failure.
     */
    #[Required]
    public string $message;

    /**
     * `new Error()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Error::with(code: ..., message: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Error)->withCode(...)->withMessage(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $code, string $message): self
    {
        $self = new self;

        $self['code'] = $code;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Code identifies the processing failure.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Message explains the processing failure.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
