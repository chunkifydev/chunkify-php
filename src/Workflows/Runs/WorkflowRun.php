<?php

declare(strict_types=1);

namespace Chunkify\Workflows\Runs;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\Runs\WorkflowRun\Actions;
use Chunkify\Workflows\Runs\WorkflowRun\AssetExecutionStatus;
use Chunkify\Workflows\Runs\WorkflowRun\Status;

/**
 * One execution of Workflow rules for an Asset, started by an event or by updating to a newer revision.
 *
 * @phpstan-import-type ActionsShape from \Chunkify\Workflows\Runs\WorkflowRun\Actions
 *
 * @phpstan-type WorkflowRunShape = array{
 *   id: string,
 *   actions: Actions|ActionsShape,
 *   assetExecutionStatus: AssetExecutionStatus|value-of<AssetExecutionStatus>,
 *   assetID: string,
 *   completedAt: \DateTimeInterface|null,
 *   createdAt: \DateTimeInterface,
 *   event: string,
 *   eventID: string|null,
 *   revision: int,
 *   rootRunID: string,
 *   status: Status|value-of<Status>,
 *   updatedAt: \DateTimeInterface,
 *   workflowID: string,
 *   error?: string|null,
 * }
 */
final class WorkflowRun implements BaseModel
{
    /** @use SdkModel<WorkflowRunShape> */
    use SdkModel;

    /**
     * Unique Workflow run ID.
     */
    #[Required]
    public string $id;

    /**
     * Counts of action outcomes in this run. Reused actions are included in completed.
     */
    #[Required]
    public Actions $actions;

    /**
     * AssetExecutionStatus specifies the combined status of this revision for the Asset across retained runs.
     * Any failed action or run makes it failed. Pending or active work, or an Asset still preparing for an unarchived Workflow, makes it running. Otherwise it is completed.
     *
     * @var value-of<AssetExecutionStatus> $assetExecutionStatus
     */
    #[Required('asset_execution_status', enum: AssetExecutionStatus::class)]
    public string $assetExecutionStatus;

    /**
     * ID of the Asset processed by this run.
     */
    #[Required('asset_id')]
    public string $assetID;

    /**
     * When the run completed, failed, or was cancelled. Null while the run is pending or running.
     */
    #[Required('completed_at')]
    public ?\DateTimeInterface $completedAt;

    /**
     * When the run was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Event specifies the Asset lifecycle event that triggered this run, or manual when the Asset was updated to a newer revision. Action details are available from the run's actions endpoint.
     */
    #[Required]
    public string $event;

    /**
     * EventId specifies the event that triggered this run. Null when the Asset was updated to a newer revision.
     */
    #[Required('event_id')]
    public ?string $eventID;

    /**
     * Pinned Workflow revision used by this run.
     */
    #[Required]
    public int $revision;

    /**
     * ID of the first run in this event chain. Equals id when this run starts the chain.
     */
    #[Required('root_run_id')]
    public string $rootRunID;

    /**
     * Current status of this event run, based on its own actions.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * When the run was last updated.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * ID of the Workflow executed by this run.
     */
    #[Required('workflow_id')]
    public string $workflowID;

    /**
     * Reason the run failed. Omitted when no failure message is available.
     */
    #[Optional]
    public ?string $error;

    /**
     * `new WorkflowRun()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkflowRun::with(
     *   id: ...,
     *   actions: ...,
     *   assetExecutionStatus: ...,
     *   assetID: ...,
     *   completedAt: ...,
     *   createdAt: ...,
     *   event: ...,
     *   eventID: ...,
     *   revision: ...,
     *   rootRunID: ...,
     *   status: ...,
     *   updatedAt: ...,
     *   workflowID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkflowRun)
     *   ->withID(...)
     *   ->withActions(...)
     *   ->withAssetExecutionStatus(...)
     *   ->withAssetID(...)
     *   ->withCompletedAt(...)
     *   ->withCreatedAt(...)
     *   ->withEvent(...)
     *   ->withEventID(...)
     *   ->withRevision(...)
     *   ->withRootRunID(...)
     *   ->withStatus(...)
     *   ->withUpdatedAt(...)
     *   ->withWorkflowID(...)
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
     * @param Actions|ActionsShape $actions
     * @param AssetExecutionStatus|value-of<AssetExecutionStatus> $assetExecutionStatus
     * @param Status|value-of<Status> $status
     */
    public static function with(
        string $id,
        Actions|array $actions,
        AssetExecutionStatus|string $assetExecutionStatus,
        string $assetID,
        ?\DateTimeInterface $completedAt,
        \DateTimeInterface $createdAt,
        string $event,
        ?string $eventID,
        int $revision,
        string $rootRunID,
        Status|string $status,
        \DateTimeInterface $updatedAt,
        string $workflowID,
        ?string $error = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['actions'] = $actions;
        $self['assetExecutionStatus'] = $assetExecutionStatus;
        $self['assetID'] = $assetID;
        $self['completedAt'] = $completedAt;
        $self['createdAt'] = $createdAt;
        $self['event'] = $event;
        $self['eventID'] = $eventID;
        $self['revision'] = $revision;
        $self['rootRunID'] = $rootRunID;
        $self['status'] = $status;
        $self['updatedAt'] = $updatedAt;
        $self['workflowID'] = $workflowID;

        null !== $error && $self['error'] = $error;

        return $self;
    }

    /**
     * Unique Workflow run ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Counts of action outcomes in this run. Reused actions are included in completed.
     *
     * @param Actions|ActionsShape $actions
     */
    public function withActions(Actions|array $actions): self
    {
        $self = clone $this;
        $self['actions'] = $actions;

        return $self;
    }

    /**
     * AssetExecutionStatus specifies the combined status of this revision for the Asset across retained runs.
     * Any failed action or run makes it failed. Pending or active work, or an Asset still preparing for an unarchived Workflow, makes it running. Otherwise it is completed.
     *
     * @param AssetExecutionStatus|value-of<AssetExecutionStatus> $assetExecutionStatus
     */
    public function withAssetExecutionStatus(
        AssetExecutionStatus|string $assetExecutionStatus
    ): self {
        $self = clone $this;
        $self['assetExecutionStatus'] = $assetExecutionStatus;

        return $self;
    }

    /**
     * ID of the Asset processed by this run.
     */
    public function withAssetID(string $assetID): self
    {
        $self = clone $this;
        $self['assetID'] = $assetID;

        return $self;
    }

    /**
     * When the run completed, failed, or was cancelled. Null while the run is pending or running.
     */
    public function withCompletedAt(?\DateTimeInterface $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

        return $self;
    }

    /**
     * When the run was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Event specifies the Asset lifecycle event that triggered this run, or manual when the Asset was updated to a newer revision. Action details are available from the run's actions endpoint.
     */
    public function withEvent(string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }

    /**
     * EventId specifies the event that triggered this run. Null when the Asset was updated to a newer revision.
     */
    public function withEventID(?string $eventID): self
    {
        $self = clone $this;
        $self['eventID'] = $eventID;

        return $self;
    }

    /**
     * Pinned Workflow revision used by this run.
     */
    public function withRevision(int $revision): self
    {
        $self = clone $this;
        $self['revision'] = $revision;

        return $self;
    }

    /**
     * ID of the first run in this event chain. Equals id when this run starts the chain.
     */
    public function withRootRunID(string $rootRunID): self
    {
        $self = clone $this;
        $self['rootRunID'] = $rootRunID;

        return $self;
    }

    /**
     * Current status of this event run, based on its own actions.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * When the run was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * ID of the Workflow executed by this run.
     */
    public function withWorkflowID(string $workflowID): self
    {
        $self = clone $this;
        $self['workflowID'] = $workflowID;

        return $self;
    }

    /**
     * Reason the run failed. Omitted when no failure message is available.
     */
    public function withError(string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }
}
