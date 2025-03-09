<?php
header('Content-Type: application/json');

function getTranslation($text, $targetLang) {
    $url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=" . $targetLang . "&dt=t&q=" . urlencode($text);
    $response = file_get_contents($url);
    $response = json_decode($response, true);
    return $response[0][0][0];
}

$input = json_decode(file_get_contents('php://input'), true);
$text = $input['text'];
$targetLang = $input['targetLang'];

if (!empty($text)) {
    $translatedText = getTranslation($text, $targetLang);
    echo json_encode(['translatedText' => $translatedText]);
} else {
    echo json_encode(['error' => 'No text provided']);
}
?>