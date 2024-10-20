<?php

namespace App\Services\Link;

use App\Dto\UserLinkDto;
use App\Events\StatisticEvent;
use App\Models\Link;
use Illuminate\Support\Str;

readonly class LinkService
{
    public function createLink(string $link, int $userId = null): string
    {
        $shortLink = $this->generateUniqueShortLink();

        Link::query()->create([
            'original_link' => $link,
            'short_link' => $shortLink,
            'user_id' => $userId
        ]);

        return config('app.url') . '/' . $shortLink;
    }

    public function getOriginalLink(UserLinkDto $userLinkDto): ?Link
    {
        $link = Link::query()->where('short_link', $userLinkDto->getLink())->first();

        if ($link) {
            event(new StatisticEvent($link->id, $userLinkDto->getIp(), $userLinkDto->getUserAgent()));

            return $link;
        }

        return null;
    }

    /**
     * По хорошему здесь должно быть время жизни ссылки
     */
    private function generateUniqueShortLink(): string
    {
        do {
            $shortLink = Str::random(6);
        } while (Link::query()->where('short_link', $shortLink)->exists());

        return $shortLink;
    }

}
