<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Logs\LogListResponse;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Jobs\Logs\LogListResponse\Data\Level;
use Chunkify\Jobs\Logs\LogListResponse\Data\Service;

/**
 * @phpstan-type DataShape = array{
 *   attributes: array<string,mixed>,
 *   level: Level|value-of<Level>,
 *   msg: string,
 *   service: Service|value-of<Service>,
 *   time: \DateTimeInterface,
 *   jobID?: string|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Additional structured data attached to the log.
     *
     * @var array<string,mixed> $attributes
     */
    #[Required(map: 'mixed')]
    public array $attributes;

    /**
     * Log level.
     *
     * @var value-of<Level> $level
     */
    #[Required(enum: Level::class)]
    public string $level;

    /**
     * The log message content.
     */
    #[Required]
    public string $msg;

    /**
     * Name of the service that generated the log.
     *
     * @var value-of<Service> $service
     */
    #[Required(enum: Service::class)]
    public string $service;

    /**
     * Timestamp when the log was created.
     */
    #[Required]
    public \DateTimeInterface $time;

    /**
     * Optional ID of the job this log is associated with.
     */
    #[Optional('job_id')]
    public ?string $jobID;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(attributes: ..., level: ..., msg: ..., service: ..., time: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withAttributes(...)
     *   ->withLevel(...)
     *   ->withMsg(...)
     *   ->withService(...)
     *   ->withTime(...)
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
     * @param array<string,mixed> $attributes
     * @param Level|value-of<Level> $level
     * @param Service|value-of<Service> $service
     */
    public static function with(
        array $attributes,
        Level|string $level,
        string $msg,
        Service|string $service,
        \DateTimeInterface $time,
        ?string $jobID = null,
    ): self {
        $self = new self;

        $self['attributes'] = $attributes;
        $self['level'] = $level;
        $self['msg'] = $msg;
        $self['service'] = $service;
        $self['time'] = $time;

        null !== $jobID && $self['jobID'] = $jobID;

        return $self;
    }

    /**
     * Additional structured data attached to the log.
     *
     * @param array<string,mixed> $attributes
     */
    public function withAttributes(array $attributes): self
    {
        $self = clone $this;
        $self['attributes'] = $attributes;

        return $self;
    }

    /**
     * Log level.
     *
     * @param Level|value-of<Level> $level
     */
    public function withLevel(Level|string $level): self
    {
        $self = clone $this;
        $self['level'] = $level;

        return $self;
    }

    /**
     * The log message content.
     */
    public function withMsg(string $msg): self
    {
        $self = clone $this;
        $self['msg'] = $msg;

        return $self;
    }

    /**
     * Name of the service that generated the log.
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
     * Timestamp when the log was created.
     */
    public function withTime(\DateTimeInterface $time): self
    {
        $self = clone $this;
        $self['time'] = $time;

        return $self;
    }

    /**
     * Optional ID of the job this log is associated with.
     */
    public function withJobID(string $jobID): self
    {
        $self = clone $this;
        $self['jobID'] = $jobID;

        return $self;
    }
}
