<?php
/**
 * Created by RestProxy https://restproxy.com
 * Version 1.1
 */

namespace RestProxyApi;

/**
 * Class RestProxyApiLoader
 *
 * @package RestProxyApi
 */
class RestProxyApiLoader
{
    /**
     * @param string $url
     * @param int    $timeout
     * @param string $method
     * @param array  $data
     * @param string $referer
     * @return mixed
     */
    public static function getContent($url, $timeout = 30, $method = 'get', $data = array(), $referer = '')
    {
        $ch = \curl_init();

        $options = array(
            CURLOPT_URL            => $url,
            CURLOPT_HEADER         => true,
            CURLOPT_TIMEOUT        => $timeout,
            CURLOPT_CONNECTTIMEOUT => $timeout,
            CURLOPT_RETURNTRANSFER => true
        );

        if ($method == 'post') {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = $data;
        }
        if ($referer) {
            $options[CURLOPT_REFERER] = $referer;
        }
        \curl_setopt_array($ch, $options);

        $content = \curl_exec($ch);
        if (strstr($content, "Content-Encoding: gzip"))
        {
            $content = preg_replace("/(.*)Content\-Encoding: gzip\s+/isU", "", $content);
            $content = gzinflate(substr($content, 13));
        } else {
            $content = substr($content, 13);
        }

        \curl_close($ch);
        return $content;
    }
} 