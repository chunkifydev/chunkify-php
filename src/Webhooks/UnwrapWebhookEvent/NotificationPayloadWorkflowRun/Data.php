<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadWorkflowRun;

use Chunkify\Assets\Workflow\Actions\AssetActionRun;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\Runs\WorkflowRun;

/**
 * Payload for the event named in event. Replays preserve the original data; retrieve the resource for current state and fresh signed URLs.
 *
 * @phpstan-import-type AssetActionRunShape from \Chunkify\Assets\Workflow\Actions\AssetActionRun
 * @phpstan-import-type WorkflowRunShape from \Chunkify\Workflows\Runs\WorkflowRun
 *
 * @phpstan-type DataShape = array{
 *   actionRuns: list<AssetActionRun|AssetActionRunShape>,
 *   workflowRun: WorkflowRun|WorkflowRunShape,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * ActionRuns specifies every action admitted by this run, including its rule and action IDs, type, input, status, output reference, and any skip or failure reason. Actions from other runs are excluded.
     *
     * @var list<AssetActionRun> $actionRuns
     */
    #[Required('action_runs', list: AssetActionRun::class)]
    public array $actionRuns;

    /**
     * Snapshot of the Workflow run when the event was recorded.
     */
    #[Required('workflow_run')]
    public WorkflowRun $workflowRun;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(actionRuns: ..., workflowRun: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withActionRuns(...)->withWorkflowRun(...)
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
     * @param list<AssetActionRun|AssetActionRunShape> $actionRuns
     * @param WorkflowRun|WorkflowRunShape $workflowRun
     */
    public static function with(
        array $actionRuns,
        WorkflowRun|array $workflowRun
    ): self {
        $self = new self;

        $self['actionRuns'] = $actionRuns;
        $self['workflowRun'] = $workflowRun;

        return $self;
    }

    /**
     * ActionRuns specifies every action admitted by this run, including its rule and action IDs, type, input, status, output reference, and any skip or failure reason. Actions from other runs are excluded.
     *
     * @param list<AssetActionRun|AssetActionRunShape> $actionRuns
     */
    public function withActionRuns(array $actionRuns): self
    {
        $self = clone $this;
        $self['actionRuns'] = $actionRuns;

        return $self;
    }

    /**
     * Snapshot of the Workflow run when the event was recorded.
     *
     * @param WorkflowRun|WorkflowRunShape $workflowRun
     */
    public function withWorkflowRun(WorkflowRun|array $workflowRun): self
    {
        $self = clone $this;
        $self['workflowRun'] = $workflowRun;

        return $self;
    }
}
