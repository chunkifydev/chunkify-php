<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Transcoders;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Jobs\Transcoders\TranscoderListResponse\Data;

/**
 * Response containing a list of transcoders for a job.
 *
 * @phpstan-import-type DataShape from \Chunkify\Jobs\Transcoders\TranscoderListResponse\Data
 *
 * @phpstan-type TranscoderListResponseShape = array{
 *   data: list<Data|DataShape>, status: 'success'
 * }
 */
final class TranscoderListResponse implements BaseModel
{
    /** @use SdkModel<TranscoderListResponseShape> */
    use SdkModel;

    /**
     * Status indicates the response status "success".
     *
     * @var 'success' $status
     */
    #[Required]
    public string $status = 'success';

    /** @var list<Data> $data */
    #[Required(list: Data::class)]
    public array $data;

    /**
     * `new TranscoderListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TranscoderListResponse::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TranscoderListResponse)->withData(...)
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
     * @param list<Data|DataShape> $data
     */
    public static function with(array $data): self
    {
        $self = new self;

        $self['data'] = $data;

        return $self;
    }

    /**
     * @param list<Data|DataShape> $data
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
