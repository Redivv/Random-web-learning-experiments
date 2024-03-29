<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewProject
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $project;        // wiadomo - wcześniejsza deklaracja atrybutu - musi być publiczny aby listener miał dostęp

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($project)           // konstruktor przypisuje przekazaną zmienną pod atrybut
    {
        $this->project = $project;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
