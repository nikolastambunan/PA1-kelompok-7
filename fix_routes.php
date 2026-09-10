<?php
$content = file_get_contents(__DIR__ . '/routes/web.php');
// Remove null bytes
$content = preg_replace('/[\x00]/', '', $content);
// Remove any weird encoding string related to the chat route
$content = preg_replace('/R o u t e : : p o s t.*/s', '', $content);
$content = preg_replace('/Route::post\(\'\/api\/chat\'.*/s', '', $content);
$content = trim($content);
$content .= "\n\nRoute::post('/api/chat', [App\Http\Controllers\ChatController::class, 'sendMessage']);\n";
file_put_contents(__DIR__ . '/routes/web.php', $content);
echo "Fixed routes/web.php";
