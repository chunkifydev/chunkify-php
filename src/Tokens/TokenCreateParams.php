<?php

declare(strict_types=1);

namespace Chunkify\Tokens;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Tokens\TokenCreateParams\Scope;

/**
 * Create a new access token for either account-wide or project-specific access. Project tokens require a valid project slug.
 *
 * @see Chunkify\Services\TokensService::create()
 *
 * @phpstan-type TokenCreateParamsShape = array{
 *   scope: Scope|value-of<Scope>, name?: string|null, projectID?: string|null
 * }
 */
final class TokenCreateParams implements BaseModel
{
    /** @use SdkModel<TokenCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Scope specifies the scope of the token, which must be either "team" or "project".
     *
     * @var value-of<Scope> $scope
     */
    #[Required(enum: Scope::class)]
    public string $scope;

    /**
     * Name is the name of the token, which can be up to 64 characters long.
     */
    #[Optional]
    public ?string $name;

    /**
     * ProjectId is required if the scope is set to "project".
     */
    #[Optional('project_id')]
    public ?string $projectID;

    /**
     * `new TokenCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TokenCreateParams::with(scope: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TokenCreateParams)->withScope(...)
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
     * @param Scope|value-of<Scope> $scope
     */
    public static function with(
        Scope|string $scope,
        ?string $name = null,
        ?string $projectID = null
    ): self {
        $self = new self;

        $self['scope'] = $scope;

        null !== $name && $self['name'] = $name;
        null !== $projectID && $self['projectID'] = $projectID;

        return $self;
    }

    /**
     * Scope specifies the scope of the token, which must be either "team" or "project".
     *
     * @param Scope|value-of<Scope> $scope
     */
    public function withScope(Scope|string $scope): self
    {
        $self = clone $this;
        $self['scope'] = $scope;

        return $self;
    }

    /**
     * Name is the name of the token, which can be up to 64 characters long.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * ProjectId is required if the scope is set to "project".
     */
    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }
}
