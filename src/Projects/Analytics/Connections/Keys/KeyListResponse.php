<?php

declare(strict_types=1);

namespace Chunkify\Projects\Analytics\Connections\Keys;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type KeyShape from \Chunkify\Projects\Analytics\Connections\Keys\Key
 *
 * @phpstan-type KeyListResponseShape = array{
 *   data: list<Key|KeyShape>, status: 'success'
 * }
 */
final class KeyListResponse implements BaseModel
{
    /** @use SdkModel<KeyListResponseShape> */
    use SdkModel;

    /** @var 'success' $status */
    #[Required]
    public string $status = 'success';

    /** @var list<Key> $data */
    #[Required(list: Key::class)]
    public array $data;

    /**
     * `new KeyListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * KeyListResponse::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new KeyListResponse)->withData(...)
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
     * @param list<Key|KeyShape> $data
     */
    public static function with(array $data): self
    {
        $self = new self;

        $self['data'] = $data;

        return $self;
    }

    /**
     * @param list<Key|KeyShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * @param 'success' $status
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
