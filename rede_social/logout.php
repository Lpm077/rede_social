<?php
require_once __DIR__ . '/config/bootstrap.php';
$auth = new AuthController($pdo);
$auth->logout();
header('Location: index.php');
exit;
