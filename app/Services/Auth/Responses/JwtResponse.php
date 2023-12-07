<?php

namespace App\Services\Auth\Responses;

class JwtResponse
{
    private string $accessToken;

    private string $tokenType;

    private int $expireIn;

    /**
     * @param string $accessToken
     * @param string $tokenType
     * @param int $expireIn
     */
    public function __construct(string $accessToken, string $tokenType, int $expireIn)
    {
        $this->accessToken = $accessToken;
        $this->tokenType = $tokenType;
        $this->expireIn = $expireIn;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    /**
     * @return int
     */
    public function getExpireIn(): int
    {
        return $this->expireIn;
    }
}