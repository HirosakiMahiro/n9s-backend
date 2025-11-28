<?php
// Подключаем библиотеку для работы с JWT
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;

// Устанавливаем заголовок, чтобы вернуть данные в формате JSON
header('Content-Type: application/json');

// Получаем данные из POST запроса
$input = json_decode(file_get_contents('php://input'), true);

// Проверяем, что поле user_id присутствует
$user_id = isset($input['user_id']) ? $input['user_id'] : null;

if (!$user_id) {
    echo json_encode(['error' => 'user_id required']);
    exit;
}

// Настроим параметры для JWT
$secretKey = 'SuperSecretKey_ChangeMe123!';  // Ваш секретный ключ для подписания
$app_id = "app_zF1BHmYti2oRMyGf";             // ID вашего приложения
$organization_id = "198";                    // ID вашей организации

// Время истечения токена (1 час)
$expiration = time() + 3600;

// Формируем payload для JWT
$payload = [
    "organization_id" => $organization_id,
    "user_id" => $user_id,
    "exp" => $expiration,
    "app_id" => $app_id
];

// Генерация JWT
$jwt = JWT::encode($payload, $secretKey, 'HS256');

// Отправляем результат в формате JSON
echo json_encode([
    "token" => $jwt,
    "user_id" => $user_id
]);
?>
