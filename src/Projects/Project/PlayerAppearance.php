<?php

declare(strict_types=1);

namespace Chunkify\Projects\Project;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Projects\Project\PlayerAppearance\Dark;
use Chunkify\Projects\Project\PlayerAppearance\HiddenControl;
use Chunkify\Projects\Project\PlayerAppearance\Light;
use Chunkify\Projects\Project\PlayerAppearance\Mode;

/**
 * Player colours and controls used by Chunkify-hosted playback pages, such as embeds.
 *
 * @phpstan-import-type DarkShape from \Chunkify\Projects\Project\PlayerAppearance\Dark
 * @phpstan-import-type LightShape from \Chunkify\Projects\Project\PlayerAppearance\Light
 *
 * @phpstan-type PlayerAppearanceShape = array{
 *   dark: Dark|DarkShape,
 *   hiddenControls: list<HiddenControl|value-of<HiddenControl>>,
 *   light: Light|LightShape,
 *   mode: Mode|value-of<Mode>,
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
    public Dark $dark;

    /**
     * HiddenControls lists the player buttons to hide.
     * Other buttons appear when the browser and video support them.
     *
     * @var list<value-of<HiddenControl>> $hiddenControls
     */
    #[Required('hidden_controls', list: HiddenControl::class)]
    public array $hiddenControls;

    /**
     * Light specifies the player colours in light mode.
     */
    #[Required]
    public Light $light;

    /**
     * Mode specifies which palette the player uses. auto follows the viewer's system setting.
     *
     * @var value-of<Mode> $mode
     */
    #[Required(enum: Mode::class)]
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
     * @param Dark|DarkShape $dark
     * @param list<HiddenControl|value-of<HiddenControl>> $hiddenControls
     * @param Light|LightShape $light
     * @param Mode|value-of<Mode> $mode
     */
    public static function with(
        Dark|array $dark,
        array $hiddenControls,
        Light|array $light,
        Mode|string $mode,
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
     * @param Dark|DarkShape $dark
     */
    public function withDark(Dark|array $dark): self
    {
        $self = clone $this;
        $self['dark'] = $dark;

        return $self;
    }

    /**
     * HiddenControls lists the player buttons to hide.
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
     * Light specifies the player colours in light mode.
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
