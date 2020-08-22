<?php
include __DIR__ . '/CJSON.php';
$pageFile = __DIR__ . '/page';
if(!file_exists($pageFile)) {
    file_put_contents($pageFile, file_get_contents('https://wdms.epa.gov.tw/idms/public/ctrlcase.aspx'));
}
$json = new CJSON();
$page = file_get_contents($pageFile);
$pos = strpos($page, '[{\'CSID\'');
$posEnd = strpos($page, 'PutGMPoint', $pos);
file_put_contents(dirname(__DIR__) . '/data.json', json_encode($json->decode(substr($page, $pos, $posEnd - $pos - 2)), JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE));