<?php

$loader = require __DIR__.'/vendor/autoload.php';

$API_KEY = '217117994:AAEC_vlWicWGVm0H973Z2XEjvevoInmy4cs';
$BOT_NAME = 'kapser_bot';

try {
    $telegram = new Longman\TelegramBot\Telegram($API_KEY, $BOT_NAME);

    echo $telegram->setWebHook('https://api.telegram.org/217117994:AAEC_vlWicWGVm0H973Z2XEjvevoInmy4cs/setWebhook?url=https://kapser.herokuapp.com/kapser.php');
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    echo $e->getMessage();
}