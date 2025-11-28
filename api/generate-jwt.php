<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$user_id = $input['user_id'] ?? null;

// Если user_id не передан — создаём уникальный ID (например для гостей)
if (!$user_id || $user_id === "{user_id}") {
    $user_id = "guest_" . bin2hex(random_bytes(4));
}

$secretKey = "pk_XZgrFHcjaHiSoXVUVBCMZ7B0KRlWZTP6";   // твой секрет
$app_id = "app_zF1BHmYti2oRMyGf";
$org_id = "198";

$payload = [
    "organization_id" => $org_id,
    "user_id" => $user_id,
    "app_id" => $app_id,
    "exp" => time() + 3600
];

$jwt = JWT::encode($payload, $secretKey, 'HS256');

echo json_encode([
    "token" => $jwt,
    "user_id" => $user_id
]);

