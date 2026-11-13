<?php

declare(strict_types=1);

namespace Chunkify;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * A customer-facing Asset output processing failure.
 *
 * @phpstan-type AssetOutputErrorShape = array{code: string, message: string}
 */
final class AssetOutputError implements BaseModel
{
    /** @use SdkModel<AssetOutputErrorShape> */
    use SdkModel;

    /**
     * Machine-readable processing error code.
     */
    #[Required]
    public string $code;

    /**
     * Description of the processing failure.
     */
    #[Required]
    public string $message;

    /**
     * `new AssetOutputError()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetOutputError::with(code: ..., message: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetOutputError)->withCode(...)->withMessage(...)
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
     * Machine-readable processing error code.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Description of the processing failure.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
