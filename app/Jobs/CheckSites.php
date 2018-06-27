<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Site;
use Illuminate\Queue\SerializesModels;

class CheckSites extends Job
{
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sites = Site::all();

        foreach ($sites as $site) {
            dispatch(new CheckSite($site));
        }
    }
}
