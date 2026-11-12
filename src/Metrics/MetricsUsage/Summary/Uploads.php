<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricsUsage\Summary;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Upload activity.
 *
 * @phpstan-type UploadsShape = array{bytes: int, completed: int, failed: int}
 */
final class Uploads implements BaseModel
{
    /** @use SdkModel<UploadsShape> */
    use SdkModel;

    /**
     * Bytes specifies successfully uploaded bytes.
     */
    #[Required]
    public int $bytes;

    /**
     * Completed specifies successfully completed Uploads.
     */
    #[Required]
    public int $completed;

    /**
     * Failed specifies recorded failed Uploads.
     */
    #[Required]
    public int $failed;

    /**
     * `new Uploads()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Uploads::with(bytes: ..., completed: ..., failed: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Uploads)->withBytes(...)->withCompleted(...)->withFailed(...)
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
    public static function with(int $bytes, int $completed, int $failed): self
    {
        $self = new self;

        $self['bytes'] = $bytes;
        $self['completed'] = $completed;
        $self['failed'] = $failed;

        return $self;
    }

    /**
     * Bytes specifies successfully uploaded bytes.
     */
    public function withBytes(int $bytes): self
    {
        $self = clone $this;
        $self['bytes'] = $bytes;

        return $self;
    }

    /**
     * Completed specifies successfully completed Uploads.
     */
    public function withCompleted(int $completed): self
    {
        $self = clone $this;
        $self['completed'] = $completed;

        return $self;
    }

    /**
     * Failed specifies recorded failed Uploads.
     */
    public function withFailed(int $failed): self
    {
        $self = clone $this;
        $self['failed'] = $failed;

        return $self;
    }
}
