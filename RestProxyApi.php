<?php
/**
 * Created by RestProxy https://restproxy.com
 * Version 1.1
 */

namespace RestProxyApi;

/**
 * Class RestProxyApi
 *
 * @package RestProxyApi
 */
class RestProxyApi
{
    /**
     * System constants
     */
    const ENDPOINT = 'https://restproxy.com/api/proxies.json';

    /**
     * Order constants
     */
    const ORDER_BEST    = 'best';
    const ORDER_NEW     = 'new';
    const ORDER_RANDOM  = 'random';

    /**
     * Response time constants
     */
    const RESPONSE_TIME_SLOW    = 'slow';
    const RESPONSE_TIME_MEDIUM  = 'medium';
    const RESPONSE_TIME_FAST    = 'fast';

    /**
     * Proxy type constants
     */
    const PROXY_TYPE_ELITE       = 'elite';
    const PROXY_TYPE_ANONYMOUS   = 'anonymous';
    const PROXY_TYPE_TRANSPARENT = 'transparent';

    /**
     * Protocol constants
     */
    const PROTOCOL_HTTP   = 'http';
    const PROTOCOL_HTTPS  = 'https';
    const PROTOCOL_SOCKS4 = 'socks4';
    const PROTOCOL_SOCKS5 = 'socks5';

    /**
     * Support constants
     */
    const SUPPORT_GET       = 'get';
    const SUPPORT_POST      = 'post';
    const SUPPORT_COOKIE    = 'cookie';
    const SUPPORT_REFERER   = 'referer';
    const SUPPORT_USERAGENT = 'useragent';

    /**
     * @var string
     */
    protected $apiKey = 'YOUR API KEY';

    /**
     * @var int
     */
    protected $limit = 1;

    /**
     * @var int
     */
    protected $page = 1;

    /**
     * @var int
     */
    protected $test = 1;

    /**
     * @var string
     */
    protected $order = RestProxyApi::ORDER_BEST;

    /**
     * @var array
     */
    protected $responseTime = array();

    /**
     * @var array
     */
    protected $proxyType = array();

    /**
     * @var array
     */
    protected $protocol = array();

    /**
     * @var array
     */
    protected $support = array();

    /**
     * @var array
     */
    protected $countryCode = array();

    /**
     * @return RestProxyApiResponse
     */
    public function callApi()
    {
        $content = RestProxyApiLoader::getContent($this->createRequest());
        $response = new RestProxyApiResponse($content);

        return $response;
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return $this->createRequest();
    }

    /**
     * @return string
     */
    protected function createRequest()
    {
        return RestProxyApi::ENDPOINT
            . '?api_key='       . $this->getApiKey()
            . '&limit='         . $this->getLimit()
            . '&page='          . $this->getPage()
            . '&order='         . $this->getOrder()
            . '&country_code='  . $this->getCountryCode()
            . '&response_time=' . $this->getResponseTime()
            . '&type='          . $this->getProxyType()
            . '&protocols='     . $this->getProtocol()
            . '&supports='      . $this->getSupport()
            . '&test='          . $this->getTest();
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     * @return RestProxyApi
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return RestProxyApi
     */
    public function setLimit($limit)
    {
        $this->limit = ($limit <= 0) ? 1 : $limit;
        $this->limit = ($this->limit > 1000) ? 1000 : $this->limit;

        return $this;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return RestProxyApi
     */
    public function setPage($page)
    {
        $this->page = ($page <= 0) ? 1 : $page;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string $order
     * @return RestProxyApi
     */
    public function setOrder($order)
    {
        $this->order = (in_array($order, array(
            RestProxyApi::ORDER_BEST,
            RestProxyApi::ORDER_NEW,
            RestProxyApi::ORDER_RANDOM
        ))) ? $order : RestProxyApi::ORDER_BEST;

        return $this;
    }

    /**
     * @return int
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param int $test
     * @return RestProxyApi
     */
    public function setTest($test)
    {
        $this->test = ((int) $test === 1) ? 1 : 0;

        return $this;
    }

    /**
     * @return string
     */
    public function getResponseTime()
    {
        return implode(',', $this->responseTime);
    }

    /**
     * @param array $responseTime
     * @return RestProxyApi
     */
    public function setResponseTime($responseTime)
    {
        if (is_array($responseTime)) {
            $this->responseTime = array();
            foreach ($responseTime as $value) {
                if (in_array($value, array(
                    RestProxyApi::RESPONSE_TIME_FAST,
                    RestProxyApi::RESPONSE_TIME_MEDIUM,
                    RestProxyApi::RESPONSE_TIME_SLOW,
                ))) {
                    $this->responseTime[] = $value;
                }
            }
        } else {
            $this->responseTime = (in_array($responseTime, array(
                RestProxyApi::RESPONSE_TIME_FAST,
                RestProxyApi::RESPONSE_TIME_MEDIUM,
                RestProxyApi::RESPONSE_TIME_SLOW,
            ))) ? array($responseTime) : array();
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getProxyType()
    {
        return implode(',', $this->proxyType);
    }

    /**
     * @param array $proxyType
     * @return RestProxyApi
     */
    public function setProxyType($proxyType)
    {
        if (is_array($proxyType)) {
            $this->proxyType = array();
            foreach ($proxyType as $value) {
                if (in_array($value, array(
                    RestProxyApi::PROXY_TYPE_ELITE,
                    RestProxyApi::PROXY_TYPE_ANONYMOUS,
                    RestProxyApi::PROXY_TYPE_TRANSPARENT,
                ))) {
                    $this->proxyType[] = $value;
                }
            }
        } else {
            $this->proxyType = (in_array($proxyType, array(
                RestProxyApi::PROXY_TYPE_ELITE,
                RestProxyApi::PROXY_TYPE_ANONYMOUS,
                RestProxyApi::PROXY_TYPE_TRANSPARENT,
            ))) ? array($proxyType) : array();
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return implode(',', $this->protocol);
    }

    /**
     * @param array $protocol
     * @return RestProxyApi
     */
    public function setProtocol($protocol)
    {
        if (is_array($protocol)) {
            $this->protocol = array();
            foreach ($protocol as $value) {
                if (in_array($value, array(
                    RestProxyApi::PROTOCOL_HTTP,
                    RestProxyApi::PROTOCOL_HTTPS,
                    RestProxyApi::PROTOCOL_SOCKS4,
                    RestProxyApi::PROTOCOL_SOCKS5,
                ))) {
                    $this->protocol[] = $value;
                }
            }
        } else {
            $this->protocol = (in_array($protocol, array(
                RestProxyApi::PROTOCOL_HTTP,
                RestProxyApi::PROTOCOL_HTTPS,
                RestProxyApi::PROTOCOL_SOCKS4,
                RestProxyApi::PROTOCOL_SOCKS5,
            ))) ? array($protocol) : array();
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getSupport()
    {
        return implode(',', $this->support);
    }

    /**
     * @param array $support
     * @return RestProxyApi
     */
    public function setSupport($support)
    {
        if (is_array($support)) {
            $this->support = array();
            foreach ($support as $value) {
                if (in_array($value, array(
                    RestProxyApi::SUPPORT_GET,
                    RestProxyApi::SUPPORT_POST,
                    RestProxyApi::SUPPORT_COOKIE,
                    RestProxyApi::SUPPORT_REFERER,
                    RestProxyApi::SUPPORT_USERAGENT,
                ))) {
                    $this->support[] = $value;
                }
            }
        } else {
            $this->support = (in_array($support, array(
                RestProxyApi::SUPPORT_GET,
                RestProxyApi::SUPPORT_POST,
                RestProxyApi::SUPPORT_COOKIE,
                RestProxyApi::SUPPORT_REFERER,
                RestProxyApi::SUPPORT_USERAGENT,
            ))) ? array($support) : array();
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return implode(',', $this->countryCode);
    }

    /**
     * @param array $countryCode
     * @return RestProxyApi
     */
    public function setCountryCode($countryCode)
    {
        if (is_array($countryCode)) {
            $this->countryCode = $countryCode;
        } else {
            $this->countryCode = array($countryCode);
        }

        return $this;
    }

}