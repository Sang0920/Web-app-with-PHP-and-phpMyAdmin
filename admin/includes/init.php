<?php
spl_autoload_register(function ($classname) {
    require_once "../../classes/{$classname}.php";
});

$user = $_COOKIE['user'];
$user = unserialize($user);
if (!isset($user) || $user->roleid != 1) {
    die("Access denied.");
}

$pdo = (new Database())->getConn();

$one_week = time() + (7 * 24 * 60 * 60);
