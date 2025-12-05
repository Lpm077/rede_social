<?php

require_once __DIR__ . '/config/bootstrap.php';
if (empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
$searchController = new SearchController($pdo);
$results = [];
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['q'])) {
    $results = $searchController->search($_GET['q']);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_follow'])) {
    $searchController->toggleFollow($_SESSION['user_id'], intval($_POST['following_id']));
    header('Location: pesquisa.php?q=' . urlencode($_POST['last_q'] ?? ''));
    exit;
}
require __DIR__ . '/views/search/pesquisa.php';
