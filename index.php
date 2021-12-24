<?php

header('Content-type: application/json');

$section = $_GET['query'];
$params = explode('/', $section);

$type = $params[0];
$protocol = $params[1];
$id = $params[2];

$method = $_SERVER['REQUEST_METHOD'];

if($method === 'GET')
{
    switch($type)
    {
        case "proxy":
        {
            require 'proxy.php';
            require 'proxy_function.php';

            if(!isset($protocol) && intval($protocol) == 0)
            {
                get_proxies($proxy_db);
                return 0;
            }

            if(intval($protocol))
            {
                get_proxy($proxy_db, intval($protocol));
                return 0;
            }
            else
            {
                if(!isset($id))
                {
                    switch($protocol)
                    {
                        case 'http':
                            get_http_proxies($proxy_db);
                            break;
                        case 'socks4':
                            get_socks4_proxies($proxy_db);
                            break;
                        case 'socks5':
                            get_socks5_proxies($proxy_db);
                            break;
                    }
                    return 0;
                }
                else if(intval($id))
                {
                    switch($protocol)
                    {
                        case 'http':
                            get_http_proxy($proxy_db, $id);
                            break;
                        case 'socks4':
                            get_socks4_proxy($proxy_db, $id);
                            break;
                        case 'socks5':
                            get_socks5_proxy($proxy_db, $id);
                            break;
                    }
                    return 0;
                }
            }
        }
        break;
        case 'valid':
        {
            require 'valid.php';
            require 'valid_function.php';

            if(!isset($protocol) && intval($protocol) == 0)
            {
                get_valids($valid_db);
                return 0;
            }

            if(intval($protocol))
            {
                get_valid($valid_db, intval($protocol));
                return 0;
            }
            else
            {
                if(!isset($id))
                {
                    switch($protocol)
                    {
                        case 'http':
                            get_http_valids($valid_db);
                            break;
                        case 'socks4':
                            get_socks4_valids($valid_db);
                            break;
                        case 'socks5':
                            get_socks5_valids($valid_db);
                            break;
                    }
                    return 0;
                }
                else if(intval($id))
                {
                    switch($protocol)
                    {
                        case 'http':
                            get_http_valid($valid_db, $id);
                            break;
                        case 'socks4':
                            get_socks4_valid($valid_db, $id);
                            break;
                        case 'socks5':
                            get_socks5_valid($valid_db, $id);
                            break;
                    }
                    return 0;
                }
            }
        }
        break;
    }
}

?>
