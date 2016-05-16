<?php
/**
 * Created by RestProxy https://restproxy.com
 * Version 1.1
 */

namespace RestProxyApi;

/**
 * Class RestProxyApiResponse
 *
 * @package RestProxyApi
 */
class RestProxyApiResponse
{
    /**
     * @var string
     */
    protected $response = '';

    /**
     * @var string
     */
    protected $status = '';

    /**
     * @var string
     */
    protected $message = '';

    /**
     * @var string
     */
    protected $requestId = '';

    /**
     * @var int
     */
    protected $limit = 0;

    /**
     * @var int
     */
    protected $quotaRemaining = 0;

    /**
     * @var int
     */
    protected $page = 0;

    /**
     * @var boolean
     */
    protected $hasNextPage = false;

    /**
     * @var array
     */
    protected $proxies = array();

    /**
     * @var array
     */
    protected $filters = array();

    /**
     * @param $response
     */
    public function __construct($response)
    {
        $this->response = $response;
        $this->prepare();
    }

    /**
     * Prepare response object
     */
    protected function prepare()
    {
        $content = explode("\r\n\r\n", $this->response);
        $result = json_decode($content[1]);
        if ($result) {
            $this->status = $result->status;
            $this->message = $result->message;
            $this->requestId = $result->request_id;
            if ($this->status === 'ok') {
                $data = $result->data;
                $this->proxies = $data->proxies;
                $this->filters = $data->filters;
                $this->limit = $data->limit;
                $this->page = $data->page;
                $this->quotaRemaining = $data->quota_remaining;
                $this->hasNextPage = $data->has_next_page;
            }
        }
    }

    /**
     * @return bool
     */
    public function haveError()
    {
        return $this->status !== 'ok';
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getQuotaRemaining()
    {
        return $this->quotaRemaining;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return boolean
     */
    public function getHasNextPage()
    {
        return $this->hasNextPage;
    }

    /**
     * @return array
     */
    public function getProxies()
    {
        return $this->proxies;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }
} 