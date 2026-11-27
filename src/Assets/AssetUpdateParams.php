<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Update an Asset's title, metadata, or whether its preview can be watched without an API token. Omitted fields remain unchanged.
 *
 * @see Chunkify\Services\AssetsService::update()
 *
 * @phpstan-type AssetUpdateParamsShape = array{
 *   metadata?: array<string,string>|null,
 *   publicPlayback?: bool|null,
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
     * Allow public playback without an API token, through the public preview page and embeds. Does not control CDN or static download access. Disabling it does not revoke signed URLs already issued.
     */
    #[Optional('public_playback')]
    public ?bool $publicPlayback;

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
        ?bool $publicPlayback = null,
        ?string $title = null
    ): self {
        $self = new self;

        null !== $metadata && $self['metadata'] = $metadata;
        null !== $publicPlayback && $self['publicPlayback'] = $publicPlayback;
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
     * Allow public playback without an API token, through the public preview page and embeds. Does not control CDN or static download access. Disabling it does not revoke signed URLs already issued.
     */
    public function withPublicPlayback(bool $publicPlayback): self
    {
        $self = clone $this;
        $self['publicPlayback'] = $publicPlayback;

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
