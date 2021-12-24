<?php

function get_proxies($proxy_db)
{
    $http_proxies = mysqli_query($proxy_db, "SELECT ipv4, port FROM `http`");
    $socks4_proxies = mysqli_query($proxy_db, "SELECT ipv4, port FROM `socks4`");
    $socks5_proxies = mysqli_query($proxy_db, "SELECT ipv4, port FROM `socks5`");

    $proxy_list = [];

    while($http_proxy = mysqli_fetch_assoc($http_proxies))
    {
        $http_proxy['type'] = 'http';
        $proxy_list[] = $http_proxy;
    }

    while($socks4_proxy = mysqli_fetch_assoc($socks4_proxies))
    {
        $socks4_proxy['type'] = 'socks4';
        $proxy_list[] = $socks4_proxy;
    }

    while($socks5_proxy = mysqli_fetch_assoc($socks5_proxies))
    {
        $socks5_proxy['type'] = 'socks5';
        $proxy_list[] = $socks5_proxy;
    }

    shuffle($proxy_list);
    echo json_encode($proxy_list);
}

function get_proxy($proxy_db, $id)
{
    $http = mysqli_query($proxy_db, "SELECT ipv4, port FROM `http` WHERE `id` = '$id'");
    $socks4 = mysqli_query($proxy_db, "SELECT ipv4, port FROM `socks4` WHERE `id` = '$id'");
    $socks5 = mysqli_query($proxy_db, "SELECT ipv4, port FROM `socks5` WHERE `id` = '$id'");

    $proxy_list = [];


    # HTTP
    if(mysqli_num_rows($http)) // IF rows > 0 : then success : failure otherwise
    {
        $array = mysqli_fetch_assoc($http);
        $proxy = ["status" => true];
        $proxy['ipv4'] = $array['ipv4'];
        $proxy['port'] = $array['port'];
        $proxy['type'] = 'http';
        $proxy_list[] = $proxy;
    }
    else
    {
        $res = [
            "status" => false,
            "message" => "HTTP Proxy not found",
            "type" => "http"];
        $proxy_list[] = $res;
    }

    # SOCKS4
    if(mysqli_num_rows($socks4)) // IF rows > 0 : then success : failure otherwise
    {
        $array = mysqli_fetch_assoc($socks4);
        $proxy = ["status" => true];
        $proxy['ipv4'] = $array['ipv4'];
        $proxy['port'] = $array['port'];
        $proxy['type'] = 'socks4';
        $proxy_list[] = $proxy;
    }
    else
    {
        $res = [
            "status" => false,
            "message" => "SOCKS4 Proxy not found",
            "type" => "socks4"];
        $proxy_list[] = $res;
    }

    if(mysqli_num_rows($socks5)) // IF rows > 0 : then success : failure otherwise
    {
        $array = mysqli_fetch_assoc($socks5);
        $proxy = ["status" => true];
        $proxy['ipv4'] = $array['ipv4'];
        $proxy['port'] = $array['port'];
        $proxy['type'] = 'socks5';
        $proxy_list[] = $proxy;
    }
    else
    {
        $res = [
            "status" => false,
            "message" => "SOCKS5 Proxy not found",
            "type" => "socks5"];
        $proxy_list[] = $res;
    }

    # Check if all fetches returned status false and set response code to 404
    # PHP uses empty strings as false values in associative arrays
    if($proxy_list[0]['status'] == "" && $proxy_list[1]['status'] == "" && $proxy_List[2]['status'] == "")
    {
        http_response_code(404);
    }

    echo json_encode($proxy_list);
}

function get_http_proxies($proxy_db)
{
    $http_proxies = mysqli_query($proxy_db, "SELECT ipv4, port FROM `http`");

    $proxy_list = [];

    while($http_proxy = mysqli_fetch_assoc($http_proxies))
    {
        $proxy_list[] = $http_proxy;
    }

    shuffle($proxy_list);
    echo json_encode($proxy_list);
}

function get_socks4_proxies($proxy_db)
{
    $socks4_proxies = mysqli_query($proxy_db, "SELECT ipv4, port FROM `socks4`");

    $proxy_list = [];

    while($socks4_proxy = mysqli_fetch_assoc($socks4_proxies))
    {
        $proxy_list[] = $socks4_proxy;
    }

    shuffle($proxy_list);
    echo json_encode($proxy_list);
}

function get_socks5_proxies($proxy_db)
{
    $socks5_proxies = mysqli_query($proxy_db, "SELECT ipv4, port FROM `socks5`");

    $proxy_list = [];

    while($socks5_proxy = mysqli_fetch_assoc($socks5_proxies))
    {
        $proxy_list[] = $socks5_proxy;
    }

    shuffle($proxy_list);
    echo json_encode($proxy_list);
}

function get_http_proxy($proxy_db, $id)
{
    $http_proxy = mysqli_query($proxy_db, "SELECT ipv4, port FROM `http` WHERE `id` = '$id'");

    if(mysqli_num_rows($http_proxy))
    {
        $proxy = mysqli_fetch_assoc($http_proxy);
        echo json_encode($proxy);
    }
    else
    {
        $res = [
        "status" => false,
        "message" => "HTTP Proxy not found"];
        http_response_code(404);
        echo json_encode($res);
    }
}

function get_socks4_proxy($proxy_db, $id)
{
    $socks4_proxy = mysqli_query($proxy_db, "SELECT ipv4, port FROM `socks4` WHERE `id` = '$id'");

    if(mysqli_num_rows($socks4_proxy))
    {
        $proxy = mysqli_fetch_assoc($socks4_proxy);
        echo json_encode($proxy);
    }
    else
    {
        $res = [
        "status" => false,
        "message" => "SOCKS4 Proxy not found"];
        http_response_code(404);
        echo json_encode($res);
    }
}

function get_socks5_proxy($proxy_db, $id)
{
    $socks5_proxy = mysqli_query($proxy_db, "SELECT ipv4, port FROM `socks5` WHERE `id` = '$id'");
    if(mysqli_num_rows($socks5_proxy))
    {
        $proxy = mysqli_fetch_assoc($socks5_proxy);
        echo json_encode($proxy);
    }
    else
    {
        $res = [
        "status" => false,
        "message" => "SOCKS5 Proxy not found"];
        http_response_code(404);
        echo json_encode($res);
    }
}

?>
