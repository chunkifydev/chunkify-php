<?php

declare(strict_types=1);

namespace Chunkify\Assets\Workflow\Actions;

use Chunkify\Assets\AssetActionInput;
use Chunkify\Assets\AssetActionResult;
use Chunkify\Assets\AssetActionStatus;
use Chunkify\Assets\AssetActionType;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * One execution of an Asset action, started by a Workflow or a direct output request.
 *
 * @phpstan-import-type AssetActionInputShape from \Chunkify\Assets\AssetActionInput
 * @phpstan-import-type AssetActionResultShape from \Chunkify\Assets\AssetActionResult
 *
 * @phpstan-type AssetActionRunShape = array{
 *   id: string,
 *   assetID: string,
 *   completedAt: \DateTimeInterface|null,
 *   createdAt: \DateTimeInterface,
 *   input: AssetActionInput|AssetActionInputShape,
 *   status: AssetActionStatus|value-of<AssetActionStatus>,
 *   type: AssetActionType|value-of<AssetActionType>,
 *   updatedAt: \DateTimeInterface,
 *   workflowRunID: string|null,
 *   actionID?: string|null,
 *   error?: string|null,
 *   reason?: string|null,
 *   result?: null|AssetActionResult|AssetActionResultShape,
 *   ruleID?: string|null,
 * }
 */
final class AssetActionRun implements BaseModel
{
    /** @use SdkModel<AssetActionRunShape> */
    use SdkModel;

    /**
     * Unique action execution ID, prefixed with acr_.
     */
    #[Required]
    public string $id;

    /**
     * ID of the Asset processed by this action.
     */
    #[Required('asset_id')]
    public string $assetID;

    /**
     * When the action completed, failed, was skipped, or was cancelled. Null while work remains.
     */
    #[Required('completed_at')]
    public ?\DateTimeInterface $completedAt;

    /**
     * When the action was accepted.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Resolved parameters and input references for this execution.
     */
    #[Required]
    public AssetActionInput $input;

    /**
     * Current execution status of the action.
     *
     * @var value-of<AssetActionStatus> $status
     */
    #[Required(enum: AssetActionStatus::class)]
    public string $status;

    /**
     * Type of action performed.
     *
     * @var value-of<AssetActionType> $type
     */
    #[Required(enum: AssetActionType::class)]
    public string $type;

    /**
     * When the action was last updated.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * ID of the Workflow run that started the action. Null for direct output requests.
     */
    #[Required('workflow_run_id')]
    public ?string $workflowRunID;

    /**
     * Action key within the rule. Omitted for direct output requests.
     */
    #[Optional('action_id')]
    public ?string $actionID;

    /**
     * Reason the action failed. Omitted when no failure message is available.
     */
    #[Optional]
    public ?string $error;

    /**
     * Machine-readable reason for waiting, skipping, failure, or cancellation. Omitted when no reason applies.
     */
    #[Optional]
    public ?string $reason;

    /**
     * Output reference and reuse flag. Included when the action completes successfully.
     */
    #[Optional]
    public ?AssetActionResult $result;

    /**
     * Rule key from the Workflow definition. Omitted for direct output requests.
     */
    #[Optional('rule_id')]
    public ?string $ruleID;

    /**
     * `new AssetActionRun()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetActionRun::with(
     *   id: ...,
     *   assetID: ...,
     *   completedAt: ...,
     *   createdAt: ...,
     *   input: ...,
     *   status: ...,
     *   type: ...,
     *   updatedAt: ...,
     *   workflowRunID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetActionRun)
     *   ->withID(...)
     *   ->withAssetID(...)
     *   ->withCompletedAt(...)
     *   ->withCreatedAt(...)
     *   ->withInput(...)
     *   ->withStatus(...)
     *   ->withType(...)
     *   ->withUpdatedAt(...)
     *   ->withWorkflowRunID(...)
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
     * @param AssetActionInput|AssetActionInputShape $input
     * @param AssetActionStatus|value-of<AssetActionStatus> $status
     * @param AssetActionType|value-of<AssetActionType> $type
     * @param AssetActionResult|AssetActionResultShape|null $result
     */
    public static function with(
        string $id,
        string $assetID,
        ?\DateTimeInterface $completedAt,
        \DateTimeInterface $createdAt,
        AssetActionInput|array $input,
        AssetActionStatus|string $status,
        AssetActionType|string $type,
        \DateTimeInterface $updatedAt,
        ?string $workflowRunID,
        ?string $actionID = null,
        ?string $error = null,
        ?string $reason = null,
        AssetActionResult|array|null $result = null,
        ?string $ruleID = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['assetID'] = $assetID;
        $self['completedAt'] = $completedAt;
        $self['createdAt'] = $createdAt;
        $self['input'] = $input;
        $self['status'] = $status;
        $self['type'] = $type;
        $self['updatedAt'] = $updatedAt;
        $self['workflowRunID'] = $workflowRunID;

        null !== $actionID && $self['actionID'] = $actionID;
        null !== $error && $self['error'] = $error;
        null !== $reason && $self['reason'] = $reason;
        null !== $result && $self['result'] = $result;
        null !== $ruleID && $self['ruleID'] = $ruleID;

        return $self;
    }

    /**
     * Unique action execution ID, prefixed with acr_.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * ID of the Asset processed by this action.
     */
    public function withAssetID(string $assetID): self
    {
        $self = clone $this;
        $self['assetID'] = $assetID;

        return $self;
    }

    /**
     * When the action completed, failed, was skipped, or was cancelled. Null while work remains.
     */
    public function withCompletedAt(?\DateTimeInterface $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

        return $self;
    }

    /**
     * When the action was accepted.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Resolved parameters and input references for this execution.
     *
     * @param AssetActionInput|AssetActionInputShape $input
     */
    public function withInput(AssetActionInput|array $input): self
    {
        $self = clone $this;
        $self['input'] = $input;

        return $self;
    }

    /**
     * Current execution status of the action.
     *
     * @param AssetActionStatus|value-of<AssetActionStatus> $status
     */
    public function withStatus(AssetActionStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Type of action performed.
     *
     * @param AssetActionType|value-of<AssetActionType> $type
     */
    public function withType(AssetActionType|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * When the action was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * ID of the Workflow run that started the action. Null for direct output requests.
     */
    public function withWorkflowRunID(?string $workflowRunID): self
    {
        $self = clone $this;
        $self['workflowRunID'] = $workflowRunID;

        return $self;
    }

    /**
     * Action key within the rule. Omitted for direct output requests.
     */
    public function withActionID(string $actionID): self
    {
        $self = clone $this;
        $self['actionID'] = $actionID;

        return $self;
    }

    /**
     * Reason the action failed. Omitted when no failure message is available.
     */
    public function withError(string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Machine-readable reason for waiting, skipping, failure, or cancellation. Omitted when no reason applies.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * Output reference and reuse flag. Included when the action completes successfully.
     *
     * @param AssetActionResult|AssetActionResultShape $result
     */
    public function withResult(AssetActionResult|array $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }

    /**
     * Rule key from the Workflow definition. Omitted for direct output requests.
     */
    public function withRuleID(string $ruleID): self
    {
        $self = clone $this;
        $self['ruleID'] = $ruleID;

        return $self;
    }
}
