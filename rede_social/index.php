<?php

require_once __DIR__ . '/config/bootstrap.php';

$auth = new authcontroller($pdo);
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $res = $auth->login($_POST);
    if (!empty($res['error'])) {
        $errors[] = $res['error'];
    } else {
        header('Location: feed.php');
        exit;
    }
}

require __DIR__ . '/views/auth/login.php';
