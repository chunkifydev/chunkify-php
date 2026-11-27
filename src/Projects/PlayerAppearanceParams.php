<?php

declare(strict_types=1);

namespace Chunkify\Projects;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type PlayerPaletteParamsShape from \Chunkify\Projects\PlayerPaletteParams
 *
 * @phpstan-type PlayerAppearanceParamsShape = array{
 *   dark?: null|PlayerPaletteParams|PlayerPaletteParamsShape,
 *   hiddenControls?: list<PlayerControl|value-of<PlayerControl>>|null,
 *   light?: null|PlayerPaletteParams|PlayerPaletteParamsShape,
 *   mode?: null|PlayerThemeMode|value-of<PlayerThemeMode>,
 * }
 */
final class PlayerAppearanceParams implements BaseModel
{
    /** @use SdkModel<PlayerAppearanceParamsShape> */
    use SdkModel;

    /**
     * Dark specifies the player colours in dark mode. Omit to use the default dark colours.
     */
    #[Optional]
    public ?PlayerPaletteParams $dark;

    /**
     * HiddenControls lists the player buttons to hide. Defaults to an empty list.
     * Other buttons appear when the browser and video support them.
     *
     * @var list<value-of<PlayerControl>>|null $hiddenControls
     */
    #[Optional('hidden_controls', list: PlayerControl::class)]
    public ?array $hiddenControls;

    /**
     * Light specifies the player colours in light mode. Omit to use the default light colours.
     */
    #[Optional]
    public ?PlayerPaletteParams $light;

    /**
     * Mode specifies which palette the player uses. auto follows the viewer's system setting.
     * An embed can override it with its theme URL parameter. Defaults to auto.
     *
     * @var value-of<PlayerThemeMode>|null $mode
     */
    #[Optional(enum: PlayerThemeMode::class)]
    public ?string $mode;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param PlayerPaletteParams|PlayerPaletteParamsShape|null $dark
     * @param list<PlayerControl|value-of<PlayerControl>>|null $hiddenControls
     * @param PlayerPaletteParams|PlayerPaletteParamsShape|null $light
     * @param PlayerThemeMode|value-of<PlayerThemeMode>|null $mode
     */
    public static function with(
        PlayerPaletteParams|array|null $dark = null,
        ?array $hiddenControls = null,
        PlayerPaletteParams|array|null $light = null,
        PlayerThemeMode|string|null $mode = null,
    ): self {
        $self = new self;

        null !== $dark && $self['dark'] = $dark;
        null !== $hiddenControls && $self['hiddenControls'] = $hiddenControls;
        null !== $light && $self['light'] = $light;
        null !== $mode && $self['mode'] = $mode;

        return $self;
    }

    /**
     * Dark specifies the player colours in dark mode. Omit to use the default dark colours.
     *
     * @param PlayerPaletteParams|PlayerPaletteParamsShape $dark
     */
    public function withDark(PlayerPaletteParams|array $dark): self
    {
        $self = clone $this;
        $self['dark'] = $dark;

        return $self;
    }

    /**
     * HiddenControls lists the player buttons to hide. Defaults to an empty list.
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
     * Light specifies the player colours in light mode. Omit to use the default light colours.
     *
     * @param PlayerPaletteParams|PlayerPaletteParamsShape $light
     */
    public function withLight(PlayerPaletteParams|array $light): self
    {
        $self = clone $this;
        $self['light'] = $light;

        return $self;
    }

    /**
     * Mode specifies which palette the player uses. auto follows the viewer's system setting.
     * An embed can override it with its theme URL parameter. Defaults to auto.
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
