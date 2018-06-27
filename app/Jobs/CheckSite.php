<?php

namespace App\Jobs;

use App\Events\SiteNotActive;
use App\Jobs\Job;
use App\Site;
use App\StatusChecker;
use Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckSite extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $site;

    /**
     * Create a new job instance.
     *
     * @param Site $site
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $checker = new StatusChecker($this->site);

        $status = $checker->run();

        // We want it to check the link 3 times if it failed
        // Check the site again in 60 minutes
        if (! $status) {
            if ($this->site->countStatusChecksToday() < 3) {
                $job = (new static($this->site))->delay(60 * 60);

                dispatch($job);
            } else {
                Event::fire(new SiteNotActive($this->site));
            }
        }
    }
}
