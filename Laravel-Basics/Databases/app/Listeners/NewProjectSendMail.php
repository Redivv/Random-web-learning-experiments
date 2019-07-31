<?php

namespace App\Listeners;

use App\Events\NewProject;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Mail\ProjectCreated;

class NewProjectSendMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewProject  $event
     * @return void
     */
    public function handle(NewProject $event)           // przekazujemy instancję nasłuchiwanego eventu i robimy co chcieliśmy
    {
        \Mail::to($event->project->owner->email)->send(     // tworzymy maila - do kogo->wyślij(co - nowy ProjectCreated)
            new ProjectCreated($event->project)
        );
    }
}
