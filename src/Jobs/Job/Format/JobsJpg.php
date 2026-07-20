<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Job\Format;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * FFmpeg encoding parameters specific to JPEG image extraction.
 *
 * @phpstan-type JobsJpgShape = array{
 *   id: 'jpg',
 *   interval: int,
 *   chunkDuration?: int|null,
 *   duration?: int|null,
 *   frames?: int|null,
 *   height?: int|null,
 *   seek?: int|null,
 *   sprite?: bool|null,
 *   width?: int|null,
 * }
 */
final class JobsJpg implements BaseModel
{
    /** @use SdkModel<JobsJpgShape> */
    use SdkModel;

    /** @var 'jpg' $id */
    #[Required]
    public string $id = 'jpg';

    /**
     * Time interval in seconds at which frames are extracted from the video (e.g., interval=10 extracts frames at 0s, 10s, 20s, etc.).
     * Must be between 1 and 60 seconds.
     */
    #[Required]
    public int $interval;

    #[Optional('chunk_duration')]
    public ?int $chunkDuration;

    /**
     * Duration specifies the duration to process in seconds.
     * Must be a positive value.
     */
    #[Optional]
    public ?int $duration;

    #[Optional]
    public ?int $frames;

    #[Optional]
    public ?int $height;

    /**
     * Seek specifies the timestamp to start processing from (in seconds).
     * Must be a positive value.
     */
    #[Optional]
    public ?int $seek;

    #[Optional]
    public ?bool $sprite;

    #[Optional]
    public ?int $width;

    /**
     * `new JobsJpg()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JobsJpg::with(interval: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JobsJpg)->withInterval(...)
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
        int $interval,
        ?int $chunkDuration = null,
        ?int $duration = null,
        ?int $frames = null,
        ?int $height = null,
        ?int $seek = null,
        ?bool $sprite = null,
        ?int $width = null,
    ): self {
        $self = new self;

        $self['interval'] = $interval;

        null !== $chunkDuration && $self['chunkDuration'] = $chunkDuration;
        null !== $duration && $self['duration'] = $duration;
        null !== $frames && $self['frames'] = $frames;
        null !== $height && $self['height'] = $height;
        null !== $seek && $self['seek'] = $seek;
        null !== $sprite && $self['sprite'] = $sprite;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * @param 'jpg' $id
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Time interval in seconds at which frames are extracted from the video (e.g., interval=10 extracts frames at 0s, 10s, 20s, etc.).
     * Must be between 1 and 60 seconds.
     */
    public function withInterval(int $interval): self
    {
        $self = clone $this;
        $self['interval'] = $interval;

        return $self;
    }

    public function withChunkDuration(int $chunkDuration): self
    {
        $self = clone $this;
        $self['chunkDuration'] = $chunkDuration;

        return $self;
    }

    /**
     * Duration specifies the duration to process in seconds.
     * Must be a positive value.
     */
    public function withDuration(int $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    public function withFrames(int $frames): self
    {
        $self = clone $this;
        $self['frames'] = $frames;

        return $self;
    }

    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Seek specifies the timestamp to start processing from (in seconds).
     * Must be a positive value.
     */
    public function withSeek(int $seek): self
    {
        $self = clone $this;
        $self['seek'] = $seek;

        return $self;
    }

    public function withSprite(bool $sprite): self
    {
        $self = clone $this;
        $self['sprite'] = $sprite;

        return $self;
    }

    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
