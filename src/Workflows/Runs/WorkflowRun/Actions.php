<?php

declare(strict_types=1);

namespace Chunkify\Workflows\Runs\WorkflowRun;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Counts of action outcomes in this run. Reused actions are included in completed.
 *
 * @phpstan-type ActionsShape = array{
 *   cancelled: int,
 *   completed: int,
 *   failed: int,
 *   reused: int,
 *   skipped: int,
 *   total: int,
 * }
 */
final class Actions implements BaseModel
{
    /** @use SdkModel<ActionsShape> */
    use SdkModel;

    /**
     * Number of actions cancelled before completion.
     */
    #[Required]
    public int $cancelled;

    /**
     * Number of actions that completed successfully, including reused outputs.
     */
    #[Required]
    public int $completed;

    /**
     * Number of actions that failed.
     */
    #[Required]
    public int $failed;

    /**
     * Number of completed actions that reused an existing output. Included in completed.
     */
    #[Required]
    public int $reused;

    /**
     * Number of actions skipped without producing an output.
     */
    #[Required]
    public int $skipped;

    /**
     * Total number of actions in the run, including unfinished actions.
     */
    #[Required]
    public int $total;

    /**
     * `new Actions()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Actions::with(
     *   cancelled: ...,
     *   completed: ...,
     *   failed: ...,
     *   reused: ...,
     *   skipped: ...,
     *   total: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Actions)
     *   ->withCancelled(...)
     *   ->withCompleted(...)
     *   ->withFailed(...)
     *   ->withReused(...)
     *   ->withSkipped(...)
     *   ->withTotal(...)
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
     */
    public static function with(
        int $cancelled,
        int $completed,
        int $failed,
        int $reused,
        int $skipped,
        int $total,
    ): self {
        $self = new self;

        $self['cancelled'] = $cancelled;
        $self['completed'] = $completed;
        $self['failed'] = $failed;
        $self['reused'] = $reused;
        $self['skipped'] = $skipped;
        $self['total'] = $total;

        return $self;
    }

    /**
     * Number of actions cancelled before completion.
     */
    public function withCancelled(int $cancelled): self
    {
        $self = clone $this;
        $self['cancelled'] = $cancelled;

        return $self;
    }

    /**
     * Number of actions that completed successfully, including reused outputs.
     */
    public function withCompleted(int $completed): self
    {
        $self = clone $this;
        $self['completed'] = $completed;

        return $self;
    }

    /**
     * Number of actions that failed.
     */
    public function withFailed(int $failed): self
    {
        $self = clone $this;
        $self['failed'] = $failed;

        return $self;
    }

    /**
     * Number of completed actions that reused an existing output. Included in completed.
     */
    public function withReused(int $reused): self
    {
        $self = clone $this;
        $self['reused'] = $reused;

        return $self;
    }

    /**
     * Number of actions skipped without producing an output.
     */
    public function withSkipped(int $skipped): self
    {
        $self = clone $this;
        $self['skipped'] = $skipped;

        return $self;
    }

    /**
     * Total number of actions in the run, including unfinished actions.
     */
    public function withTotal(int $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }
}
