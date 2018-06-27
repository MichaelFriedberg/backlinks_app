<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'url'
    ];

    /**
     * Set up some model events
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function($site) {
            $site->generateName();

            if (! $site->exists) {
                $site->generateApiToken();
            }
        });
    }

    /**
     * Belongs to user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Sanitize url
     *
     * @param $url
     * @return string
     */
    public function sanitizeUrl($url)
    {
        $url = trim($url);

        $parsedUrl = parse_url($url);

        $url = '';

        if (array_key_exists('scheme', $parsedUrl))  {
            $url .= $parsedUrl['scheme'] . '://';
        }

        if (array_key_exists('host', $parsedUrl))  {
            $url .= $parsedUrl['host'];
        }

        return $url;
    }

    /**
     * Check if the url is reachable
     *
     * @return bool
     */
    public function urlReachable()
    {
        $handle = curl_init($this->url);

        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($handle,  CURLOPT_TIMEOUT, 3);

        /* Get the HTML or whatever is linked in $url. */
        $response = curl_exec($handle);

        /* Check for 404 (file not found). */
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        curl_close($handle);

        if ($httpCode == 200) {
            return true;
        }

        return false;
    }

    /**
     * Get host of the url
     *
     * @return bool|mixed
     */
    public function getUrlHost()
    {
        return parse_url($this->url, PHP_URL_HOST);
    }

    /**
     * Set the api token
     */
    public function generateApiToken()
    {
        $this->api_token = strtolower(str_random(40));
    }

    /**
     * Set the name
     */
    public function generateName()
    {
        $this->name = $this->getUrlHost();
    }

    /**
     * Has many link status
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function statuses()
    {
        return $this->hasMany(SiteStatus::class);
    }

    /**
     * Has one latest status
     *
     * @return mixed
     */
    public function latestStatus()
    {
        return $this->hasOne(SiteStatus::class)->latest();
    }

    /**
     * Count number of times status was checked today
     *
     * @return mixed
     */
    public function countStatusChecksToday()
    {
        return $this->statuses()
            ->where(\DB::raw('DATE(created_at)'), Carbon::now()->format('Y-m-d'))
            ->count();
    }

    /**
     * Update moz score for this site
     * @return int
     */
    public function updateMozScore()
    {
        $moz = new Mozscape;

        $this->moz_score = $moz->getDomainAuthority($this->url);

        $this->update();

        return $this->moz_score;
    }

    /**
     * Get days active since
     *
     * @param Carbon $date
     * @return mixed
     */
    public function daysActiveSince(Carbon $date)
    {
        $days = $this->statuses()
            ->where(\DB::raw('DATE(site_statuses.created_at)'), '>=', $date->format('Y-m-d'))
            ->where('status', 1)
            ->groupBy(\DB::raw('DATE(site_statuses.created_at)'))
            ->get();

        return $days->count();
    }

    /**
     * Days active for the last month
     *
     * @return mixed
     */
    public function daysActiveLastMonth()
    {
        $since = Carbon::now()->subDays(30);

        return $this->daysActiveSince($since);
    }
}
