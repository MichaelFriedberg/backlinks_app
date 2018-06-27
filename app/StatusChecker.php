<?php

namespace App;

class StatusChecker
{
    protected $site;
    protected $links;
    protected $status;

    /**
     * LinkChecker constructor.
     * @param Site $site
     */
    public function __construct(Site $site)
    {
        $this->site = $site;

        $this->links = Link::all();
    }

    /**
     * Run link checker
     *
     * @return bool
     */
    public function run()
    {
        $html = $this->getHtml();

        $this->status = $this->htmlHasLinks($html);

        $this->log();

        return $this->status;
    }

    /**
     * Get HTML of site
     *
     * @return mixed
     */
    protected function getHtml()
    {
        $handle = curl_init($this->site->url);

        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($handle,  CURLOPT_TIMEOUT, 10);

        $response = curl_exec($handle);

        curl_close($handle);

        return $response;
    }

    /**
     * Check if html content contains the link
     *
     * @param $html
     * @return bool
     */
    protected function htmlHasLinks($html)
    {
        $hrefs = $this->getHrefsFromHtml($html);

        foreach ($this->links as $link) {
            if (! in_array($link->url, $hrefs)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get hrefs from html
     *
     * @param $html
     * @return array
     */
    protected function getHrefsFromHtml($html)
    {
        // Suppress warnings from imperfect html content
        libxml_use_internal_errors(true);

        $dom = new \DOMDocument;
        $dom->loadHTML($html);

        $hrefs = [];

        $anchors = $dom->getElementsByTagName('a');

        foreach ($anchors as $anchor) {
            $hrefs[] = $anchor->getAttribute('href');
        }

        return $hrefs;
    }

    /**
     * Log link check status
     *
     * @return LinkStatus
     */
    protected function log()
    {
        $status = $this->status ? 1 : 0;

        $siteStatus = new SiteStatus;
        $siteStatus->site_id = $this->site->id;
        $siteStatus->status = $status;
        $siteStatus->save();

        return $siteStatus;
    }

    /**
     * Get status
     *
     * @return mixed
     */
    public function status()
    {
        return $this->status;
    }
}