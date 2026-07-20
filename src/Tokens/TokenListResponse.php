<?php

declare(strict_types=1);

namespace Chunkify\Tokens;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Response containing the list of all tokens for a team. Including project and team tokens.
 *
 * @phpstan-import-type TokenShape from \Chunkify\Tokens\Token
 *
 * @phpstan-type TokenListResponseShape = array{
 *   data: list<Token|TokenShape>, status: 'success'
 * }
 */
final class TokenListResponse implements BaseModel
{
    /** @use SdkModel<TokenListResponseShape> */
    use SdkModel;

    /**
     * Status indicates the response status "success".
     *
     * @var 'success' $status
     */
    #[Required]
    public string $status = 'success';

    /**
     * Data contains the token items.
     *
     * @var list<Token> $data
     */
    #[Required(list: Token::class)]
    public array $data;

    /**
     * `new TokenListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TokenListResponse::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TokenListResponse)->withData(...)
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
     *
     * @param list<Token|TokenShape> $data
     */
    public static function with(array $data): self
    {
        $self = new self;

        $self['data'] = $data;

        return $self;
    }

    /**
     * Data contains the token items.
     *
     * @param list<Token|TokenShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Status indicates the response status "success".
     *
     * @param 'success' $status
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
