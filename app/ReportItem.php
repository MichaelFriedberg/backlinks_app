<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportItem extends Model
{
    const MIN_DAYS_ACTIVE = 27;

    /**
     * Belongs to report
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    /**
     * Generate for site
     *
     * @param Site $site
     * @return $this
     */
    public function generate(Site $site)
    {
        $this->site = $site->name;
        $this->days_active = $site->daysActiveLastMonth();
        $this->score = $site->moz_score;
        $this->amount = $this->calculate();

        return $this;
    }

    /**
     * Calculate balance for this report item
     *
     * @return int
     */
    protected function calculate()
    {
        if ($this->days_active < static::MIN_DAYS_ACTIVE) {
            return 0;
        }

        return PricePoint::forScore($this->score);
    }
}
