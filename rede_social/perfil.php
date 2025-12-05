<?php

require_once __DIR__ . '/config/bootstrap.php';
if (empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
$profileController = new ProfileController($pdo);
$userModel = new User($pdo);
$user = $userModel->findById($_SESSION['user_id']);
$res = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $res = $profileController->update($_SESSION['user_id'], $_POST, $_FILES);
    header('Location: perfil.php');
    exit;
}
require __DIR__ . '/views/profile/perfil.php';
