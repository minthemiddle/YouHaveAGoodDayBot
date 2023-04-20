<?php

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/settings.php';

use Telegram\Bot\Api;
date_default_timezone_set('Europe/Berlin');

// Create a new bot instance
$bot = new Api($botToken);

// Send a message to the specified chat ID
function sendMessage($chatId, $text)
{
    global $bot;
    $bot->sendMessage(['chat_id' => $chatId, 'text' => $text]);
}

// Set the messages
$message_intentions = <<<EOT
Gib deinem Tag eine Richtung

Denke über den bevorstehenden Tag nach.

- Was ist heute am wichtigsten?
- Was bedeutet das für meine Einstellung, Aufmerksamkeit und Handlungen?
- Welche konkreten Ziele sollte ich mir für den Tag setzen?
EOT;

$message_ideal = <<<EOT
Stell dir das Ideal vor

- Nimm dir einen Moment Zeit, um dir das Wichtigste für heute vorzustellen 
- Stell dir vor, wie du es richtig gut machst.
EOT;

$message_peak = <<<EOT
Plan dein Highlight

- Entscheide dich, worauf du dich heute am meisten freust!
- Auch wenn es sehr klein ist
- Klein wird groß, wenn du daran denkst
EOT;

$message_connect = <<<EOT
Nimm Kontakt auf

- Nimm dir Zeit für mindestens eine kurze Interaktion mit jemandem, den du magst.
- Es kann mit einem Freund sein, auch aus der Ferne, oder ein herzlicher Austausch mit einem Fremden.
EOT;

$messages = array(
    array('time' => '08:00', 'text' => $message_intentions),
    array('time' => '08:02', 'text' => $message_ideal),
    array('time' => '08:04', 'text' => $message_peak),
    array('time' => '12:30', 'text' => $message_connect)
);

echo date('H:i');

foreach ($messages as $message) {
    // Check if it's time to send the message
    if (date('H:i') == $message['time']) {
        // Send the message
        sendMessage($chatId, $message['text']);
    }
}