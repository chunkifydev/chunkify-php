<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Update the title, metadata, or public preview access. Omitted fields remain unchanged.
 *
 * @see Chunkify\Services\AssetsService::update()
 *
 * @phpstan-type AssetUpdateParamsShape = array{
 *   metadata?: array<string,string>|null,
 *   previewEnabled?: bool|null,
 *   title?: string|null,
 * }
 */
final class AssetUpdateParams implements BaseModel
{
    /** @use SdkModel<AssetUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Replaces all metadata. Send {} to clear it; omit to leave unchanged. Maximum encoded JSON size: 2,048 bytes.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * Allow public preview access without an API token. Does not control CDN or static download access. Disabling it does not revoke signed URLs already issued.
     */
    #[Optional('preview_enabled')]
    public ?bool $previewEnabled;

    /**
     * Asset title, up to 256 characters. Send an empty string to clear it; omit to leave unchanged.
     */
    #[Optional]
    public ?string $title;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,string>|null $metadata
     */
    public static function with(
        ?array $metadata = null,
        ?bool $previewEnabled = null,
        ?string $title = null
    ): self {
        $self = new self;

        null !== $metadata && $self['metadata'] = $metadata;
        null !== $previewEnabled && $self['previewEnabled'] = $previewEnabled;
        null !== $title && $self['title'] = $title;

        return $self;
    }

    /**
     * Replaces all metadata. Send {} to clear it; omit to leave unchanged. Maximum encoded JSON size: 2,048 bytes.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Allow public preview access without an API token. Does not control CDN or static download access. Disabling it does not revoke signed URLs already issued.
     */
    public function withPreviewEnabled(bool $previewEnabled): self
    {
        $self = clone $this;
        $self['previewEnabled'] = $previewEnabled;

        return $self;
    }

    /**
     * Asset title, up to 256 characters. Send an empty string to clear it; omit to leave unchanged.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }
}
