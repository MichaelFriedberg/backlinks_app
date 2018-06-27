<?php

namespace App\Events;

use App\Events\Event;
use App\Report;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReportGenerated extends Event
{
    use SerializesModels;

    public $report;

    /**
     * Create a new event instance.
     *
     * @param Report $report
     */
    public function __construct(Report $report)
    {
        //
        $this->report = $report;
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
