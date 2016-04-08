<?php
/**
 * Telegram Bot access token и URL.
 */
$access_token = '217117994:AAEC_vlWicWGVm0H973Z2XEjvevoInmy4cs';
$api = 'https://api.telegram.org/bot' . $access_token;
$BOT_NAME = 'kapser_bot';

/**
 * Задаём основные переменные.
 */
$output = json_decode(file_get_contents('php://input'), TRUE);
$chat_id = $output['message']['chat']['id'];
$first_name = $output['message']['chat']['first_name'];
$message = $output['message']['text'];

function sendMessage($chat_id, Hello) {
  
}
