<?php

require_once __DIR__ . '/config/bootstrap.php';
if (empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
$feed = new FeedController($pdo);
$userModel = new User($pdo);
$user = $userModel->findById($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['new_post'])) {
        $r = $feed->createPost($_SESSION['user_id'], $_POST['new_post']);
     
    } elseif (isset($_POST['toggle_like']) && isset($_POST['post_id'])) {
        $feed->toggleLike($_SESSION['user_id'], intval($_POST['post_id']));
    }
    header('Location: feed.php');
    exit;
}

$posts = $feed->list($_SESSION['user_id']);
require __DIR__ . '/views/feed/feed.php';
