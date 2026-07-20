<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Logs;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Jobs\Logs\LogListParams\Service;

/**
 * Retrieve logs for a specific job, either from the transcoder or manager service.
 *
 * @see Chunkify\Services\Jobs\LogsService::list()
 *
 * @phpstan-type LogListParamsShape = array{
 *   service: Service|value-of<Service>, transcoderID?: int|null
 * }
 */
final class LogListParams implements BaseModel
{
    /** @use SdkModel<LogListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Service type (transcoder or manager).
     *
     * @var value-of<Service> $service
     */
    #[Required(enum: Service::class)]
    public string $service;

    /**
     * Transcoder ID (required if service is transcoder).
     */
    #[Optional]
    public ?int $transcoderID;

    /**
     * `new LogListParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LogListParams::with(service: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LogListParams)->withService(...)
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
     * @param Service|value-of<Service> $service
     */
    public static function with(
        Service|string $service,
        ?int $transcoderID = null
    ): self {
        $self = new self;

        $self['service'] = $service;

        null !== $transcoderID && $self['transcoderID'] = $transcoderID;

        return $self;
    }

    /**
     * Service type (transcoder or manager).
     *
     * @param Service|value-of<Service> $service
     */
    public function withService(Service|string $service): self
    {
        $self = clone $this;
        $self['service'] = $service;

        return $self;
    }

    /**
     * Transcoder ID (required if service is transcoder).
     */
    public function withTranscoderID(int $transcoderID): self
    {
        $self = clone $this;
        $self['transcoderID'] = $transcoderID;

        return $self;
    }
}
