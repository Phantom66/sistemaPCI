<?php

namespace PCI\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event listener mappings for the application.
     * @var array
     */
    protected $listen = [
        'PCI\Events\NewUserRegistration' => [
            'PCI\Listeners\EmailUserConfirmation',
        ],
        'PCI\Events\ConfirmationCodeRequest' => [
            'PCI\Listeners\EmailUserConfirmation',
        ],
        'PCI\Events\NewPetitionCreation' => [
            'PCI\Listeners\Email\EmailPetitionEventToAttendants',
            'PCI\Listeners\Email\EmailPetitionEventToDepotOwner',
        ],
    ];

    /**
     * Register any other events for your application.
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
        //
    }
}
