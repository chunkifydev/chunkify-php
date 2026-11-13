<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Assets\AssetActionResult\OutputType;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Reference to the output created or reused by a completed action.
 *
 * @phpstan-type AssetActionResultShape = array{
 *   outputID: string, outputType: OutputType|value-of<OutputType>, reused: bool
 * }
 */
final class AssetActionResult implements BaseModel
{
    /** @use SdkModel<AssetActionResultShape> */
    use SdkModel;

    /**
     * ID of the caption, static rendition, or thumbnail request produced by the action.
     */
    #[Required('output_id')]
    public string $outputID;

    /**
     * Type of output referenced by output_id. Caption generation and translation both produce caption outputs.
     *
     * @var value-of<OutputType> $outputType
     */
    #[Required('output_type', enum: OutputType::class)]
    public string $outputType;

    /**
     * Whether the action reused an existing output instead of creating one.
     */
    #[Required]
    public bool $reused;

    /**
     * `new AssetActionResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetActionResult::with(outputID: ..., outputType: ..., reused: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetActionResult)->withOutputID(...)->withOutputType(...)->withReused(...)
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
     * @param OutputType|value-of<OutputType> $outputType
     */
    public static function with(
        string $outputID,
        OutputType|string $outputType,
        bool $reused
    ): self {
        $self = new self;

        $self['outputID'] = $outputID;
        $self['outputType'] = $outputType;
        $self['reused'] = $reused;

        return $self;
    }

    /**
     * ID of the caption, static rendition, or thumbnail request produced by the action.
     */
    public function withOutputID(string $outputID): self
    {
        $self = clone $this;
        $self['outputID'] = $outputID;

        return $self;
    }

    /**
     * Type of output referenced by output_id. Caption generation and translation both produce caption outputs.
     *
     * @param OutputType|value-of<OutputType> $outputType
     */
    public function withOutputType(OutputType|string $outputType): self
    {
        $self = clone $this;
        $self['outputType'] = $outputType;

        return $self;
    }

    /**
     * Whether the action reused an existing output instead of creating one.
     */
    public function withReused(bool $reused): self
    {
        $self = clone $this;
        $self['reused'] = $reused;

        return $self;
    }
}
