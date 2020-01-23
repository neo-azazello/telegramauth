<?php

require_once('TelegramClass.php');
$telegram = new Telegram;

try {
    $data = $telegram->checkTelegramAuthorization($_GET);
    $telegram->saveTelegramUserData($data);
    } catch (Exception $e) {
}
