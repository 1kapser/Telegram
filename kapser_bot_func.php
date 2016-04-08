<?php
$bot_id = 'AAEC_vlWicWGVm0H973Z2XEjvevoInmy4cs';
$chat_id ='217117994';
$url = 'https://api.telegram.org/bot' . $bot_id .

'/sendMessage?text='.urlencode($text).
'&chat_id='.intval($chat_id);
$result = file_get_contents($url);
$result = json_decode($result, true);
var_dump($result['result']); 
