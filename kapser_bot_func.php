<?php
$bot_id = 'AAH7GEHZZNE5mr3ABQT0X3BZ5ezIGi2rTQg';
$chat_id ='195600014';
$url = 'https://api.telegram.org/bot' . $bot_id .

'/sendMessage?text='.urlencode($text).
'&chat_id='.intval($chat_id);
$result = file_get_contents($url);
$result = json_decode($result, true);
var_dump($result['result']); 
