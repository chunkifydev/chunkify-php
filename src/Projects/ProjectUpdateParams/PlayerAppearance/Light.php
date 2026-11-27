<?php

declare(strict_types=1);

namespace Chunkify\Projects\ProjectUpdateParams\PlayerAppearance;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Light specifies the player colours in light mode. Omit to use the default light colours.
 *
 * @phpstan-type LightShape = array{
 *   accent: string, primary: string, secondary: string
 * }
 */
final class Light implements BaseModel
{
    /** @use SdkModel<LightShape> */
    use SdkModel;

    /**
     * Accent specifies the colour of progress and active controls, as #rrggbb.
     */
    #[Required]
    public string $accent;

    /**
     * Primary specifies the colour of text and control icons, as #rrggbb.
     */
    #[Required]
    public string $primary;

    /**
     * Secondary specifies the colour of player buttons, as #rrggbb.
     */
    #[Required]
    public string $secondary;

    /**
     * `new Light()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Light::with(accent: ..., primary: ..., secondary: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Light)->withAccent(...)->withPrimary(...)->withSecondary(...)
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
     * Accent specifies the colour of progress and active controls, as #rrggbb.
     */
    public function withAccent(string $accent): self
    {
        $self = clone $this;
        $self['accent'] = $accent;

        return $self;
    }

    /**
     * Primary specifies the colour of text and control icons, as #rrggbb.
     */
    public function withPrimary(string $primary): self
    {
        $self = clone $this;
        $self['primary'] = $primary;

        return $self;
    }

    /**
     * Secondary specifies the colour of player buttons, as #rrggbb.
     */
    public function withSecondary(string $secondary): self
    {
        $self = clone $this;
        $self['secondary'] = $secondary;

        return $self;
    }
}
