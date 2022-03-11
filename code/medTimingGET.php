<?php

$url = "localhost/pilly/medTiming.php";


function medTimingGET(){
    global $url;
    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_URL, $url);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($cURLConnection);
    curl_close($cURLConnection);
    return $result;
}

?>