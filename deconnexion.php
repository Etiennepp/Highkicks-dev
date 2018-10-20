<?php 
session_start();
unset($_SESSION['connected_id']);
if (isset($_COOKIE['rememberme_hk'])) {
    unset($_COOKIE['rememberme_hk']);
    setcookie('rememberme_hk', null, -1, '/');
}
$url_redirect = 'Location: '.$_GET['url'];
header($url_redirect);
?>