<?php


require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../controllers/authcontroller.php';

session_start();

define('BASE_PATH', __DIR__ . '/../');
define('UPLOADS_PATH', BASE_PATH . 'public/uploads/');


$db_host = 'localhost';
$db_name = 'rede_social';
$db_user = 'root';
$db_pass = '';


try {
    $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8mb4", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Exception $e) {
    
    die('Erro na conexão com o banco: ' . $e->getMessage());
}


spl_autoload_register(function ($class) {
    $paths = [__DIR__ . '/../models/', __DIR__ . '/../controllers/'];
    foreach ($paths as $p) {
        $file = $p . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
