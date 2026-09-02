<?php
// Test Groq API with qwen model
$apiKey = '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';

$data = json_encode([
    'model' => 'qwen/qwen3.6-27b',
    'messages' => [
        ['role' => 'user', 'content' => 'Halo, berapa jam dari Medan ke Meat Toba?']
    ],
    'max_tokens' => 200
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.groq.com/openai/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json'
]);

$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
if ($curlError) echo "cURL Error: $curlError\n";

$json = json_decode($result, true);
if (isset($json['choices'][0]['message']['content'])) {
    echo "Reply: " . $json['choices'][0]['message']['content'] . "\n";
} else {
    echo "Raw: $result\n";
}
