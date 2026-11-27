<?php

declare(strict_types=1);

namespace Chunkify\Projects\Project\PlayerAppearance;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Dark specifies the player colours in dark mode.
 *
 * @phpstan-type DarkShape = array{
 *   accent: string, primary: string, secondary: string
 * }
 */
final class Dark implements BaseModel
{
    /** @use SdkModel<DarkShape> */
    use SdkModel;

    /**
     * Accent specifies the colour of progress and active controls.
     */
    #[Required]
    public string $accent;

    /**
     * Primary specifies the colour of text and control icons.
     */
    #[Required]
    public string $primary;

    /**
     * Secondary specifies the colour of player buttons.
     */
    #[Required]
    public string $secondary;

    /**
     * `new Dark()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Dark::with(accent: ..., primary: ..., secondary: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Dark)->withAccent(...)->withPrimary(...)->withSecondary(...)
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
        string $accent,
        string $primary,
        string $secondary
    ): self {
        $self = new self;

        $self['accent'] = $accent;
        $self['primary'] = $primary;
        $self['secondary'] = $secondary;

        return $self;
    }

    /**
     * Accent specifies the colour of progress and active controls.
     */
    public function withAccent(string $accent): self
    {
        $self = clone $this;
        $self['accent'] = $accent;

        return $self;
    }

    /**
     * Primary specifies the colour of text and control icons.
     */
    public function withPrimary(string $primary): self
    {
        $self = clone $this;
        $self['primary'] = $primary;

        return $self;
    }

    /**
     * Secondary specifies the colour of player buttons.
     */
    public function withSecondary(string $secondary): self
    {
        $self = clone $this;
        $self['secondary'] = $secondary;

        return $self;
    }
}
