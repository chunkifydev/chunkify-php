<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Jobs\Job;

/**
 * Payload for job.created. A standalone Job has been accepted for processing; execution may not have started.
 *
 * @phpstan-import-type JobShape from \Chunkify\Jobs\Job
 *
 * @phpstan-type NotificationPayloadJobCreatedDataShape = array{job: Job|JobShape}
 */
final class NotificationPayloadJobCreatedData implements BaseModel
{
    /** @use SdkModel<NotificationPayloadJobCreatedDataShape> */
    use SdkModel;

    #[Required]
    public Job $job;

    /**
     * `new NotificationPayloadJobCreatedData()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPayloadJobCreatedData::with(job: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPayloadJobCreatedData)->withJob(...)
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
     * @param Job|JobShape $job
     */
    public static function with(Job|array $job): self
    {
        $self = new self;

        $self['job'] = $job;

        return $self;
    }

    /**
     * @param Job|JobShape $job
     */
    public function withJob(Job|array $job): self
    {
        $self = clone $this;
        $self['job'] = $job;

        return $self;
    }
}
