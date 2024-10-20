<?php

namespace App\Providers;

use App\Events\StatisticEvent;
use App\Listeners\SaveStatisticListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Event::listen(StatisticEvent::class, SaveStatisticListener::class);
    }
}
