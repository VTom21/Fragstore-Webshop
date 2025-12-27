<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);
$userMessage = $input['message'] ?? '';

$API_KEY = 'AIzaSyD9ICw1bd5jzsqDLqiFO4x6RJd0CzDONcE';
$API_URL = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$API_KEY";

$data = [
    "prompt" => ["text" => $userMessage],
    "temperature" => 0.7,
    "maxOutputTokens" => 150
];

$options = [
    "http" => [
        "header" => "Content-Type: application/json\r\n",
        "method" => "POST",
        "content" => json_encode($data),
    ],
];

$context = stream_context_create($options);
$response = @file_get_contents($API_URL, false, $context);

// Log raw response
file_put_contents("gemini_log.txt", $response.PHP_EOL, FILE_APPEND);

if ($response === FALSE) {
    echo json_encode(['error' => 'Failed to contact Gemini API']);
} else {
    echo $response;
}
?>
