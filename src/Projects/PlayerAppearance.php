<?php

declare(strict_types=1);

namespace Chunkify\Projects;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type PlayerPaletteShape from \Chunkify\Projects\PlayerPalette
 *
 * @phpstan-type PlayerAppearanceShape = array{
 *   dark: PlayerPalette|PlayerPaletteShape,
 *   hiddenControls: list<PlayerControl|value-of<PlayerControl>>,
 *   light: PlayerPalette|PlayerPaletteShape,
 *   mode: PlayerThemeMode|value-of<PlayerThemeMode>,
 * }
 */
final class PlayerAppearance implements BaseModel
{
    /** @use SdkModel<PlayerAppearanceShape> */
    use SdkModel;

    /**
     * Dark specifies the player colours in dark mode.
     */
    #[Required]
    public PlayerPalette $dark;

    /**
     * HiddenControls lists the player buttons to hide.
     * Other buttons appear when the browser and video support them.
     *
     * @var list<value-of<PlayerControl>> $hiddenControls
     */
    #[Required('hidden_controls', list: PlayerControl::class)]
    public array $hiddenControls;

    /**
     * Light specifies the player colours in light mode.
     */
    #[Required]
    public PlayerPalette $light;

    /**
     * Mode specifies which palette the player uses. auto follows the viewer's system setting.
     *
     * @var value-of<PlayerThemeMode> $mode
     */
    #[Required(enum: PlayerThemeMode::class)]
    public string $mode;

    /**
     * `new PlayerAppearance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PlayerAppearance::with(dark: ..., hiddenControls: ..., light: ..., mode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PlayerAppearance)
     *   ->withDark(...)
     *   ->withHiddenControls(...)
     *   ->withLight(...)
     *   ->withMode(...)
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
     * @param PlayerPalette|PlayerPaletteShape $dark
     * @param list<PlayerControl|value-of<PlayerControl>> $hiddenControls
     * @param PlayerPalette|PlayerPaletteShape $light
     * @param PlayerThemeMode|value-of<PlayerThemeMode> $mode
     */
    public static function with(
        PlayerPalette|array $dark,
        array $hiddenControls,
        PlayerPalette|array $light,
        PlayerThemeMode|string $mode,
    ): self {
        $self = new self;

        $self['dark'] = $dark;
        $self['hiddenControls'] = $hiddenControls;
        $self['light'] = $light;
        $self['mode'] = $mode;

        return $self;
    }

    /**
     * Dark specifies the player colours in dark mode.
     *
     * @param PlayerPalette|PlayerPaletteShape $dark
     */
    public function withDark(PlayerPalette|array $dark): self
    {
        $self = clone $this;
        $self['dark'] = $dark;

        return $self;
    }

    /**
     * HiddenControls lists the player buttons to hide.
     * Other buttons appear when the browser and video support them.
     *
     * @param list<PlayerControl|value-of<PlayerControl>> $hiddenControls
     */
    public function withHiddenControls(array $hiddenControls): self
    {
        $self = clone $this;
        $self['hiddenControls'] = $hiddenControls;

        return $self;
    }

    /**
     * Light specifies the player colours in light mode.
     *
     * @param PlayerPalette|PlayerPaletteShape $light
     */
    public function withLight(PlayerPalette|array $light): self
    {
        $self = clone $this;
        $self['light'] = $light;

        return $self;
    }

    /**
     * Mode specifies which palette the player uses. auto follows the viewer's system setting.
     *
     * @param PlayerThemeMode|value-of<PlayerThemeMode> $mode
     */
    public function withMode(PlayerThemeMode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }
}
