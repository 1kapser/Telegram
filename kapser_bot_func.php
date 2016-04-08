<?php
/**
 * Telegram Bot access token è URL.
 */
$access_token = '217117994:AAEC_vlWicWGVm0H973Z2XEjvevoInmy4cs';
$api = 'https://api.telegram.org/bot' . $access_token;
$BOT_NAME = 'kapser_bot';
/**
def help_message(arguments, message):
    response = {'chat_id': message['chat']['id']}
    result = ["Hey, %s!" % message["from"].get("first_name"),
              "\rI can accept only these commands:"]
    for command in CMD:
        result.append(command)
    response['text'] = "\n\t".join(result)
    return response
