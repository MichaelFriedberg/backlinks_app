<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewSiteAdded extends Event
{
    use SerializesModels;


    public $site;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($site)
    {


        $this->website = $site;

        //
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
