<?php

namespace Knops\BolcomClient\Model;

final class AccessToken
{
    public function __construct(
        private string $accessToken,
        private string $tokenType,
        private int $expiresIn,
        private array $scopes,
    ) {}

    public static function fromObject(object $object): self
    {
        return new self(
            $object->access_token, $object->token_type, $object->expires_in, explode(',', $object->scope)
        );
    }

    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getScopes(): array
    {
        return $this->scopes;
    }
}