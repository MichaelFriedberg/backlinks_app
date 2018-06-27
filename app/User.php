<?php

namespace App;

use App\Contracts\ReceivesPaypalPayments;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements ReceivesPaypalPayments
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Has many sites
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sites()
    {
        return $this->hasMany(Site::class);
    }

    /**
     * Has many reports
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Get report for this month
     *
     * @return Report
     */
    public function getReportForThisMonth()
    {
        $report = $this->reports()
            ->where(\DB::raw('YEAR(created_at)'), date('Y'))
            ->where(\DB::raw('MONTH(created_at)'), date('m'))
            ->latest()
            ->first();

        return $report ?: $this->generateReport();
    }

    /**
     * Make a report
     *
     * @return $this|null
     */
    public function generateReport()
    {
        $report = new Report;
        $report->generate($this);

        return $report->fresh();
    }

    /**
     * @return mixed
     */
    public function getPaypalEmail()
    {
        return $this->paypal_email;
    }
}
