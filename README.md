# restproxy-api-list
PHP library for working with our API (restproxy.com proxy api list)

# How to use (PHP example)
```php
$api = new \RestProxyApi\RestProxyApi();
$request = $api
    ->setApiKey('YOUR API KEY')
    ->setLimit(10)
    ->setPage(1)
    ->setOrder(\RestProxyApi\RestProxyApi::ORDER_BEST)
    ->setProtocol(array(
        \RestProxyApi\RestProxyApi::PROTOCOL_HTTP,
        \RestProxyApi\RestProxyApi::PROTOCOL_HTTPS,
    ))
    ->setSupport(array(
        \RestProxyApi\RestProxyApi::SUPPORT_GET,
        \RestProxyApi\RestProxyApi::SUPPORT_REFERER,
    ))
    ->setProxyType(array(
        \RestProxyApi\RestProxyApi::PROXY_TYPE_ELITE
    ))
    ->setResponseTime(array(
        \RestProxyApi\RestProxyApi::RESPONSE_TIME_FAST,
        \RestProxyApi\RestProxyApi::RESPONSE_TIME_MEDIUM,
    ))
    ->setCountryCode(array('US', 'RU', 'CA'))
    ->setTest(0);


echo '<pre>';
echo $request->getRequest() . PHP_EOL;

$response = $request->callApi();

if ($response->haveError()) {
    echo $response->getMessage();
    die;
}

echo 'Page 1' . PHP_EOL;
foreach ($response->getProxies() as $proxy) {
    echo $proxy->ip . ':' . $proxy->port . PHP_EOL;
}

if ($response->getHasNextPage()) {
    $request->setPage(2);
    $response = $request->callApi();
}

echo 'Page 2' . PHP_EOL;
if ($response->haveError()) {
    echo $response->getMessage();
    die;
}

foreach ($response->getProxies() as $proxy) {
    echo $proxy->ip . ':' . $proxy->port . PHP_EOL;
}
```

