<?php
/**
 * Telegram Bot access token è URL.
 */
$access_token = '217117994:AAEC_vlWicWGVm0H973Z2XEjvevoInmy4cs';
$api = 'https://api.telegram.org/bot' . $access_token;

/**
 * Çàäà¸ì îñíîâíûå ïåðåìåííûå.
 */
$output = json_decode(file_get_contents('php://input'), TRUE);
$chat_id = $output['message']['chat']['id'];
$first_name = $output['message']['chat']['first_name'];
$message = $output['message']['text'];

/**
 * Emoji äëÿ ëó÷øåãî âèçóàëüíîãî îôîðìëåíèÿ.
 */
$emoji = array(
  'preload' => json_decode('"\uD83D\uDE03"'), // Óëûáî÷êà.
  'weather' => array(
    'clear' => json_decode('"\u2600"'), // Ñîëíöå.
    'clouds' => json_decode('"\u2601"'), // Îáëàêà.
    'rain' => json_decode('"\u2614"'), // Äîæäü.
    'snow' => json_decode('"\u2744"'), // Ñíåã.
  ),
);

/**
 * Ïîëó÷àåì êîìàíäû îò ïîëüçîâàòåëÿ.
 */
switch($message) {
  // API ïîãîäû ïðåäîñòàâëåíî OpenWeatherMap.
  // @see http://openweathermap.org
  case '/pogoda':
    // Îòïðàâëÿåì ïðèâåòñòâåííûé òåêñò.
    $preload_text = 'Îäíó ñåêóíäó, ' . $first_name . ' ' . $emoji['preload'] . ' ß óòî÷íÿþ äëÿ âàñ ïîãîäó..';
    sendMessage($chat_id, $preload_text);
    // App ID äëÿ OpenWeatherMap.
    $appid = '500776';
    // ID äëÿ ãîðîäà/ðàéîíà/ìåñòíîñòè (åñòü âñå ãîðîäà ÐÔ).
    $id = '500776'; // Äëÿ ïðèìåðà: Ïåòåðáóðã, ñåâåð ãîðîäà.
    // Ïîëó÷àåì JSON-îòâåò îò OpenWeatherMap.
    $pogoda = json_decode(file_get_contents('http://api.openweathermap.org/data/2.5/weather?appid=' . $appid . '&id=' . $id . '&units=metric&lang=ru'), TRUE);
    // Îïðåäåëÿåì òèï ïîãîäû èç îòâåòà è âûâîäèì ñîîòâåòñòâóþùèé Emoji.
    if ($pogoda['weather'][0]['main'] === 'Clear') { $weather_type = $emoji['weather']['clear'] . ' ' . $pogoda['weather'][0]['description']; }
    elseif ($pogoda['weather'][0]['main'] === 'Clouds') { $weather_type = $emoji['weather']['clouds'] . ' ' . $pogoda['weather'][0]['description']; }
    elseif ($pogoda['weather'][0]['main'] === 'Rain') { $weather_type = $emoji['weather']['rain'] . ' ' . $pogoda['weather'][0]['description']; }
    elseif ($pogoda['weather'][0]['main'] === 'Snow') { $weather_type = $emoji['weather']['snow'] . ' ' . $pogoda['weather'][0]['description']; }
    else $weather_type = $pogoda['weather'][0]['description'];
    // Òåìïåðàòóðà âîçäóõà.
    if ($pogoda['main']['temp'] > 0) { $temperature = '+' . sprintf("%d", $pogoda['main']['temp']); }
    else { $temperature = sprintf("%d", $pogoda['main']['temp']); }
    // Íàïðàâëåíèå âåòðà.
    if ($pogoda['wind']['deg'] >= 0 && $pogoda['wind']['deg'] <= 11.25) { $wind_direction = 'ñåâåðíûé'; }
    elseif ($pogoda['wind']['deg'] > 11.25 && $pogoda['wind']['deg'] <= 78.75) { $wind_direction = 'ñåâåðî-âîñòî÷íûé, '; }
    elseif ($pogoda['wind']['deg'] > 78.75 && $pogoda['wind']['deg'] <= 101.25) { $wind_direction = 'âîñòî÷íûé, '; }
    elseif ($pogoda['wind']['deg'] > 101.25 && $pogoda['wind']['deg'] <= 168.75) { $wind_direction = 'þãî-âîñòî÷íûé, '; }
    elseif ($pogoda['wind']['deg'] > 168.75 && $pogoda['wind']['deg'] <= 191.25) { $wind_direction = 'þæíûé, '; }
    elseif ($pogoda['wind']['deg'] > 191.25 && $pogoda['wind']['deg'] <= 258.75) { $wind_direction = 'þãî-çàïàäíûé, '; }
    elseif ($pogoda['wind']['deg'] > 258.75 && $pogoda['wind']['deg'] <= 281.25) { $wind_direction = 'çàïàäíûé, '; }
    elseif ($pogoda['wind']['deg'] > 281.25 && $pogoda['wind']['deg'] <= 348.75) { $wind_direction = 'ñåâåðî-çàïàäíûé, '; }
    else { $wind_direction = ' '; }
    // Ôîðìèðîâàíèå îòâåòà.
    $weather_text = 'Ñåé÷àñ ' . $weather_type . '. Òåìïåðàòóðà âîçäóõà: ' . $temperature . '°C. Âåòåð ' . $wind_direction . sprintf("%u", $pogoda['wind']['speed']) . ' ì/ñåê.';
    // Îòïðàâêà îòâåòà ïîëüçîâàòåëþ Telegram.
    sendMessage($chat_id, $weather_text);
    break;
  default:
    break;
}

/**
 * Ôóíêöèÿ îòïðàâêè ñîîáùåíèÿ sendMessage().
 */
function sendMessage($chat_id, $message) {
  file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message));
}
