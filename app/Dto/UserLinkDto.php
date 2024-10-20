<?php

namespace App\Dto;

readonly class UserLinkDto
{
    public function __construct(
        private string $link,
        private string $ip,
        private string $userAgent
    ) {
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }
}
