<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\OpportunityClosed' => [
            'App\Listeners\OpportunityClosedListener',
        ],
        'App\Events\OpportunityCanceled' => [
            'App\Listeners\OpportunityCanceledListener',
        ],
        'App\Events\OpportunityProgressUpdated' => [
            'App\Listeners\OpportunityProgressUpdatedListener',
        ],
        'App\Events\OpportunityLead' => [
            'App\Listeners\OpportunityLeadListener',
        ],
        'App\Events\MessageSent' => [
            'App\Listeners\MessageSentListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
