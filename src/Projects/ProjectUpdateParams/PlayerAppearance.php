<?php

declare(strict_types=1);

namespace Chunkify\Projects\ProjectUpdateParams;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Projects\ProjectUpdateParams\PlayerAppearance\Dark;
use Chunkify\Projects\ProjectUpdateParams\PlayerAppearance\HiddenControl;
use Chunkify\Projects\ProjectUpdateParams\PlayerAppearance\Light;
use Chunkify\Projects\ProjectUpdateParams\PlayerAppearance\Mode;

/**
 * Player colours and controls for Chunkify-hosted playback pages, such as embeds. Replaces the whole object. Omitted fields reset to their defaults. Existing embeds use the new values.
 *
 * @phpstan-import-type DarkShape from \Chunkify\Projects\ProjectUpdateParams\PlayerAppearance\Dark
 * @phpstan-import-type LightShape from \Chunkify\Projects\ProjectUpdateParams\PlayerAppearance\Light
 *
 * @phpstan-type PlayerAppearanceShape = array{
 *   dark?: null|Dark|DarkShape,
 *   hiddenControls?: list<HiddenControl|value-of<HiddenControl>>|null,
 *   light?: null|Light|LightShape,
 *   mode?: null|Mode|value-of<Mode>,
 * }
 */
final class PlayerAppearance implements BaseModel
{
    /** @use SdkModel<PlayerAppearanceShape> */
    use SdkModel;

    /**
     * Dark specifies the player colours in dark mode. Omit to use the default dark colours.
     */
    #[Optional]
    public ?Dark $dark;

    /**
     * HiddenControls lists the player buttons to hide. Defaults to an empty list.
     * Other buttons appear when the browser and video support them.
     *
     * @var list<value-of<HiddenControl>>|null $hiddenControls
     */
    #[Optional('hidden_controls', list: HiddenControl::class)]
    public ?array $hiddenControls;

    /**
     * Light specifies the player colours in light mode. Omit to use the default light colours.
     */
    #[Optional]
    public ?Light $light;

    /**
     * Mode specifies which palette the player uses. auto follows the viewer's system setting.
     * An embed can override it with its theme URL parameter. Defaults to auto.
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
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
     * @param Dark|DarkShape|null $dark
     * @param list<HiddenControl|value-of<HiddenControl>>|null $hiddenControls
     * @param Light|LightShape|null $light
     * @param Mode|value-of<Mode>|null $mode
     */
    public static function with(
        Dark|array|null $dark = null,
        ?array $hiddenControls = null,
        Light|array|null $light = null,
        Mode|string|null $mode = null,
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
     * @param Dark|DarkShape $dark
     */
    public function withDark(Dark|array $dark): self
    {
        $self = clone $this;
        $self['dark'] = $dark;

        return $self;
    }

    /**
     * HiddenControls lists the player buttons to hide. Defaults to an empty list.
     * Other buttons appear when the browser and video support them.
     *
     * @param list<HiddenControl|value-of<HiddenControl>> $hiddenControls
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
     * @param Light|LightShape $light
     */
    public function withLight(Light|array $light): self
    {
        $self = clone $this;
        $self['light'] = $light;

        return $self;
    }

    /**
     * Mode specifies which palette the player uses. auto follows the viewer's system setting.
     * An embed can override it with its theme URL parameter. Defaults to auto.
     *
     * @param Mode|value-of<Mode> $mode
     */
    public function withMode(Mode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }
}
