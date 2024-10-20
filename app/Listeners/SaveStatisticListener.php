<?php

namespace App\Listeners;

use App\Events\StatisticEvent;
use App\Models\Statistic;

class SaveStatisticListener
{
    public function handle(StatisticEvent $event): void
    {
        Statistic::query()->create([
            'link_id' => $event->linkId,
            'ip_address' => $event->ipAddress,
            'user_agent' => $event->userAgent,
            'created_at' => now()
        ]);
    }
}
