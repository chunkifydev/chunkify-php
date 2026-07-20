<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\UnwrapWebhookEvent\Data;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Jobs\Job;

/**
 * Payload data structure for job.failed and job.cancelled events.
 *
 * @phpstan-import-type JobShape from \Chunkify\Jobs\Job
 *
 * @phpstan-type NotificationPayloadJobFailedShape = array{job: Job|JobShape}
 */
final class NotificationPayloadJobFailed implements BaseModel
{
    /** @use SdkModel<NotificationPayloadJobFailedShape> */
    use SdkModel;

    #[Required]
    public Job $job;

    /**
     * `new NotificationPayloadJobFailed()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPayloadJobFailed::with(job: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPayloadJobFailed)->withJob(...)
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
