<?php

namespace App;

use App\Exceptions\ErrorGettingMozScoreException;

class Mozscape
{
    protected $accessId;
    protected $secretKey;
    protected $rateLimit;

    /**
     * Mozscape constructor.
     * @param null $accessId
     * @param null $secretKey
     */
    public function __construct($accessId = null, $secretKey = null)
    {
        $this->accessId = $accessId ?: env('MOZ_ACCESS_ID');
        $this->secretKey = $secretKey ?: env('MOZ_SECRET_KEY');
    }

    /**
     * Get Domain Authority score
     * @param $url
     * @return int
     * @throws ErrorGettingMozScoreException
     */
    public function getDomainAuthority($url)
    {
        // Add up all the bit flags you want returned.
        // Learn more here: https://moz.com/help/guides/moz-api/mozscape/api-reference/url-metrics
        $cols = "68719476736"; // Domain authority

        // Put it all together and you get your request URL.
        // This example uses the Mozscape URL Metrics API.
        $requestUrl = "http://lsapi.seomoz.com/linkscape/url-metrics/".urlencode($url)."?Cols=".$cols."&AccessID=".$this->accessId."&Expires=".$this->expires()."&Signature=".$this->signature();

        $response = $this->makeRequest($requestUrl);

        if (isset($response['http']) && $response['http'] != '200') {
            // It may be rate limit
            sleep($this->rateLimit);

            $response = $this->makeRequest($requestUrl);
        }

        if (empty($response)) {
            throw new ErrorGet('Response empty');
        }

        if (! isset($response['pda'])) {
            throw new ErrorGettingMozScoreException('Field "pda" not found in response data.');
        }

        return (int) $response['pda'];
    }

    /**
     * Get API expires
     *
     * @return int
     */
    protected function expires()
    {
        // Set your expires times for several minutes into the future.
        // An expires time excessively far in the future will not be honored by the Mozscape API.
        return time() + 300;
    }

    /**
     * Generate signature
     *
     * @return string
     */
    protected function signature()
    {
        // Put each parameter on a new line.
        $stringToSign = $this->accessId."\n".$this->expires();

        // Get the "raw" or binary output of the hmac hash.
        $binarySignature = hash_hmac('sha1', $stringToSign, $this->secretKey, true);

        // Base64-encode it and then url-encode that.
        $urlSafeSignature = urlencode(base64_encode($binarySignature));

        return $urlSafeSignature;
    }

    /**
     * Make a request to url
     * @param $url
     * @return mixed
     */
    protected function makeRequest($url)
    {
        $curl_handle = curl_init();

        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 15);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);

        $buffer = curl_exec($curl_handle);

        $httpCode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);

        curl_close($curl_handle);

        $response = json_decode($buffer, true);
        $response['http'] = $httpCode;

        return $response;
    }
}