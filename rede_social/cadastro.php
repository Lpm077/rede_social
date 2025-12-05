<?php

require_once __DIR__ . '/config/bootstrap.php';
$auth = new authcontroller($pdo);
$result = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $auth->register($_POST, $_FILES);
    if (!empty($result['success'])) {
       
        header('Location: index.php?registered=1');
        exit;
    }
}

require __DIR__ . '/views/auth/register.php';
