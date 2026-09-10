<?php
$content = file_get_contents(__DIR__ . '/.env');
$content = preg_replace('/GROQ_API_KEY=.*/s', '', $content);
$content = trim($content);
$content .= "\n\nGROQ_API_KEY=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\n";
file_put_contents(__DIR__ . '/.env', $content);
echo "Fixed .env with new key";
