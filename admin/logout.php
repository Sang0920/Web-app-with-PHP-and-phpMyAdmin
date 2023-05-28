<?php
require_once '../classes/User.php';
User::logout();
header('location: ../index.php');