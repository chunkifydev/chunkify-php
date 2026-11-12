<?php

declare(strict_types=1);

namespace Chunkify\Projects\AnalyticsConnections;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AnalyticsConnectionShape from \Chunkify\Projects\AnalyticsConnections\AnalyticsConnection
 *
 * @phpstan-type AnalyticsConnectionListResponseShape = array{
 *   data: list<AnalyticsConnection|AnalyticsConnectionShape>, status: 'success'
 * }
 */
final class AnalyticsConnectionListResponse implements BaseModel
{
    /** @use SdkModel<AnalyticsConnectionListResponseShape> */
    use SdkModel;

    /** @var 'success' $status */
    #[Required]
    public string $status = 'success';

    /**
     * Saved connections in creation order.
     *
     * @var list<AnalyticsConnection> $data
     */
    #[Required(list: AnalyticsConnection::class)]
    public array $data;

    /**
     * `new AnalyticsConnectionListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AnalyticsConnectionListResponse::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AnalyticsConnectionListResponse)->withData(...)
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
     * @param list<AnalyticsConnection|AnalyticsConnectionShape> $data
     */
    public static function with(array $data): self
    {
        $self = new self;

        $self['data'] = $data;

        return $self;
    }

    /**
     * Saved connections in creation order.
     *
     * @param list<AnalyticsConnection|AnalyticsConnectionShape> $data
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
