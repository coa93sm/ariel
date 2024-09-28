<?php

require_once 'app/config/config.php';
require_once 'app/classes/User.php';

$user=new User($conn);
$user->logout();

header('Location: login.php');
exit();
?>