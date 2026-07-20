<?php

declare(strict_types=1);

namespace Chunkify\Tokens;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Tokens\Token\Scope;

/**
 * @phpstan-type TokenShape = array{
 *   id: string,
 *   token: string,
 *   createdAt: \DateTimeInterface,
 *   name: string,
 *   projectID: string,
 *   scope: Scope|value-of<Scope>,
 * }
 */
final class Token implements BaseModel
{
    /** @use SdkModel<TokenShape> */
    use SdkModel;

    /**
     * Unique identifier of the token.
     */
    #[Required]
    public string $id;

    /**
     * The actual token value (only returned on creation).
     */
    #[Required]
    public string $token;

    /**
     * Timestamp when the token was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Name given to the token.
     */
    #[Required]
    public string $name;

    /**
     * ID of the project this token belongs to.
     */
    #[Required('project_id')]
    public string $projectID;

    /**
     * Access scope of the token.
     *
     * @var value-of<Scope> $scope
     */
    #[Required(enum: Scope::class)]
    public string $scope;

    /**
     * `new Token()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Token::with(
     *   id: ..., token: ..., createdAt: ..., name: ..., projectID: ..., scope: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Token)
     *   ->withID(...)
     *   ->withToken(...)
     *   ->withCreatedAt(...)
     *   ->withName(...)
     *   ->withProjectID(...)
     *   ->withScope(...)
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
        string $id,
        string $token,
        \DateTimeInterface $createdAt,
        string $name,
        string $projectID,
        Scope|string $scope,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['token'] = $token;
        $self['createdAt'] = $createdAt;
        $self['name'] = $name;
        $self['projectID'] = $projectID;
        $self['scope'] = $scope;

        return $self;
    }

    /**
     * Unique identifier of the token.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The actual token value (only returned on creation).
     */
    public function withToken(string $token): self
    {
        $self = clone $this;
        $self['token'] = $token;

        return $self;
    }

    /**
     * Timestamp when the token was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Name given to the token.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * ID of the project this token belongs to.
     */
    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    /**
     * Access scope of the token.
     *
     * @param Scope|value-of<Scope> $scope
     */
    public function withScope(Scope|string $scope): self
    {
        $self = clone $this;
        $self['scope'] = $scope;

        return $self;
    }
}
