<?php

date_default_timezone_set('UTC');

function callAPI($header, $method, $url, $data){
    $curl = curl_init();
    switch ($method){
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
            break;
        case "DELETE":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    $result = curl_exec($curl);
    if(!$result){
        return 0;
    }

    curl_close($curl);
    return $result;
}

if(!isset($_GET['jenisAPI']) || 
    !isset($_GET['consid']) || 
    !isset($_GET['secret']) || 
    !isset($_GET['username']) || 
    !isset($_GET['password']) || 
    !isset($_GET['method']) ||
    !isset($_GET['url']) || 
    !isset($_GET['withParam']) || 
    !isset($_GET['params'])) {
    echo 'Dibuat Oleh <a href="https://github.com/morizbebenk" target="_blank">Moriz</a>';
    die('');
} else {
    $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));

    $jenisAPI = $_GET['jenisAPI'];
    $consid = $_GET['consid'];
    $secret = $_GET['secret'];

    $username = $_GET['username'];
    $password = $_GET['password'];
    $kdAplikasi = '095';

    $method = $_GET['method'];
    $url = $_GET['url'];
    $withParam = $_GET['withParam'];
    $params = $_GET['params'];

    if ($withParam == 0) {
        $params = null;
    }

    $data = $consid . '&' . $tStamp;
    $signature = hash_hmac('sha256', $data, $secret, true);
    $encodedSignature = base64_encode($signature);
    $encodedAuthorization = base64_encode($username . ':' . $password . ':' . $kdAplikasi);

    if ($jenisAPI == 'vclaim') {
        $headers = array(
            "X-cons-id:" . $consid,
            "X-timestamp: " . $tStamp,
            "X-signature: " . $encodedSignature,
            "Content-Type:Application/x-www-form-urlencoded"
        );
    } else {
        $headers = array(
            "X-cons-id:" . $consid,
            "X-timestamp: " . $tStamp,
            "X-signature: " . $encodedSignature,
            "X-authorization: Basic " . $encodedAuthorization,
            "Content-Type:Application/x-www-form-urlencoded"
        );
    }

    echo callAPI($headers, $method, $url, $params);
}