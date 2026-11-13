<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Logs;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Log;

/**
 * Response containing a list of logs for a job.
 *
 * @phpstan-import-type LogShape from \Chunkify\Log
 *
 * @phpstan-type LogListResponseShape = array{
 *   data: list<Log|LogShape>, status: 'success'
 * }
 */
final class LogListResponse implements BaseModel
{
    /** @use SdkModel<LogListResponseShape> */
    use SdkModel;

    /**
     * Status indicates the response status "success".
     *
     * @var 'success' $status
     */
    #[Required]
    public string $status = 'success';

    /** @var list<Log> $data */
    #[Required(list: Log::class)]
    public array $data;

    /**
     * `new LogListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LogListResponse::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LogListResponse)->withData(...)
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
     * @param list<Log|LogShape> $data
     */
    public static function with(array $data): self
    {
        $self = new self;

        $self['data'] = $data;

        return $self;
    }

    /**
     * @param list<Log|LogShape> $data
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
