<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Response containing the list of all webhooks for a project.
 *
 * @phpstan-import-type WebhookShape from \Chunkify\Webhooks\Webhook
 *
 * @phpstan-type WebhookListResponseShape = array{
 *   data: list<Webhook|WebhookShape>, status: 'success'
 * }
 */
final class WebhookListResponse implements BaseModel
{
    /** @use SdkModel<WebhookListResponseShape> */
    use SdkModel;

    /**
     * Status indicates the response status "success".
     *
     * @var 'success' $status
     */
    #[Required]
    public string $status = 'success';

    /**
     * Data contains the webhook items.
     *
     * @var list<Webhook> $data
     */
    #[Required(list: Webhook::class)]
    public array $data;

    /**
     * `new WebhookListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookListResponse::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookListResponse)->withData(...)
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
     * @param list<Webhook|WebhookShape> $data
     */
    public static function with(array $data): self
    {
        $self = new self;

        $self['data'] = $data;

        return $self;
    }

    /**
     * Data contains the webhook items.
     *
     * @param list<Webhook|WebhookShape> $data
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
