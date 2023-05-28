<?php
require_once './includes/init.php';
User::logout();
header('location: index.php');