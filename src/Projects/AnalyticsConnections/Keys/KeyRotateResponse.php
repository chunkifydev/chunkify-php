<?php

declare(strict_types=1);

namespace Chunkify\Projects\AnalyticsConnections\Keys;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AnalyticsKeyShape from \Chunkify\Projects\AnalyticsConnections\Keys\AnalyticsKey
 *
 * @phpstan-type KeyRotateResponseShape = array{
 *   data: AnalyticsKey|AnalyticsKeyShape, key: string, status: 'success'
 * }
 */
final class KeyRotateResponse implements BaseModel
{
    /** @use SdkModel<KeyRotateResponseShape> */
    use SdkModel;

    /** @var 'success' $status */
    #[Required]
    public string $status = 'success';

    /**
     * One key per purpose. Public player values remain available; read and MCP values are returned only on creation or rotation.
     */
    #[Required]
    public AnalyticsKey $data;

    /**
     * Key is the new credential. Save read and MCP keys now; later reads omit their values. Public keys remain available.
     */
    #[Required]
    public string $key;

    /**
     * `new KeyRotateResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * KeyRotateResponse::with(data: ..., key: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new KeyRotateResponse)->withData(...)->withKey(...)
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
     * @param AnalyticsKey|AnalyticsKeyShape $data
     */
    public static function with(AnalyticsKey|array $data, string $key): self
    {
        $self = new self;

        $self['data'] = $data;
        $self['key'] = $key;

        return $self;
    }

    /**
     * One key per purpose. Public player values remain available; read and MCP values are returned only on creation or rotation.
     *
     * @param AnalyticsKey|AnalyticsKeyShape $data
     */
    public function withData(AnalyticsKey|array $data): self
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
