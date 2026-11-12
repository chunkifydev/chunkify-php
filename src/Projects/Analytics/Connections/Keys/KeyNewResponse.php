<?php

declare(strict_types=1);

namespace Chunkify\Projects\Analytics\Connections\Keys;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type KeyShape from \Chunkify\Projects\Analytics\Connections\Keys\Key
 *
 * @phpstan-type KeyNewResponseShape = array{
 *   data: Key|KeyShape, key: string, status: 'success'
 * }
 */
final class KeyNewResponse implements BaseModel
{
    /** @use SdkModel<KeyNewResponseShape> */
    use SdkModel;

    /** @var 'success' $status */
    #[Required]
    public string $status = 'success';

    /**
     * One key per purpose. Public player values remain available; read and MCP values are returned only on creation or rotation.
     */
    #[Required]
    public Key $data;

    /**
     * Key is the new credential. Save read and MCP keys now; later reads omit their values. Public keys remain available.
     */
    #[Required]
    public string $key;

    /**
     * `new KeyNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * KeyNewResponse::with(data: ..., key: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new KeyNewResponse)->withData(...)->withKey(...)
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
     * @param Key|KeyShape $data
     */
    public static function with(Key|array $data, string $key): self
    {
        $self = new self;

        $self['data'] = $data;
        $self['key'] = $key;

        return $self;
    }

    /**
     * One key per purpose. Public player values remain available; read and MCP values are returned only on creation or rotation.
     *
     * @param Key|KeyShape $data
     */
    public function withData(Key|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Key is the new credential. Save read and MCP keys now; later reads omit their values. Public keys remain available.
     */
    public function withKey(string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

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
