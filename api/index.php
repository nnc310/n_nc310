<?php
// 特定のキー（例: my-site-counter）を指定してカウントを1増やす
$json = file_get_contents('https://api.countapi.xyz/hit/my-unique-site-id/visits');
$data = json_decode($json, true);

// JSON形式で現在のカウントを返す
header('Content-Type: application/json');
echo json_encode(['count' => $data['value']]);
?>