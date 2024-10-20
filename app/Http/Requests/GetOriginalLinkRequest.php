<?php

namespace App\Http\Requests;

use App\Dto\UserLinkDto;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetOriginalLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    private function getShortLink(): string
    {
        $shortLink = $this->route('shortLink');

        if (!$this->isValidShortLink($shortLink)) {
            throw new NotFoundHttpException();
        }

        return $shortLink;
    }

    private function isValidShortLink(string $shortLink): bool
    {
        return preg_match('/^[a-zA-Z0-9]{6}$/', $shortLink) === 1;
    }

    public function toDto(): UserLinkDto
    {
        return new UserLinkDto(
            link: $this->getShortLink(),
            ip: $this->ip(),
            userAgent: $this->header('User-Agent')
        );
    }

}
