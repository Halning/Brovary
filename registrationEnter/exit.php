

<?php

header("content-type:text/html;charset=utf-8");
session_start();
$username = htmlspecialchars($_COOKIE['username']);

if (isset($_SESSION['name'])) {
    unset($_SESSION['name']);
    unset($_SESSION['username']);
    unset($_SESSION['avatar']);
    session_destroy();
}

