<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Output Storage selection, independent of Source storage.
 *
 * @phpstan-type ThumbnailCreateStorageParamsShape = array{
 *   id?: string|null, path?: string|null
 * }
 */
final class ThumbnailCreateStorageParams implements BaseModel
{
    /** @use SdkModel<ThumbnailCreateStorageParamsShape> */
    use SdkModel;

    /**
     * Id identifies output Storage in this Project. Omit to use the Project default.
     */
    #[Optional]
    public ?string $id;

    /**
     * Path specifies the output filename template relative to the selected Storage base_prefix. Required for customer storage; generated for Chunkify temporary storage.
     * The filename must contain one %05d placeholder, replaced by the image or sprite sheet number starting at 1, and end in .jpg for jpeg or .webp for webp.
     * The WebVTT file uses the filename without the placeholder and its adjacent separator, such as thumb.vtt for thumb-%05d.jpg. The combined path may contain at most 1024 bytes.
     */
    #[Optional]
    public ?string $path;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $id = null, ?string $path = null): self
    {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $path && $self['path'] = $path;

        return $self;
    }

    /**
     * Id identifies output Storage in this Project. Omit to use the Project default.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Path specifies the output filename template relative to the selected Storage base_prefix. Required for customer storage; generated for Chunkify temporary storage.
     * The filename must contain one %05d placeholder, replaced by the image or sprite sheet number starting at 1, and end in .jpg for jpeg or .webp for webp.
     * The WebVTT file uses the filename without the placeholder and its adjacent separator, such as thumb.vtt for thumb-%05d.jpg. The combined path may contain at most 1024 bytes.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }
}
