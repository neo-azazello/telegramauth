<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('TelegramClass.php');
$telegram = new Telegram();

try {

  $data = $telegram->checkTelegramAuthorization($_GET);
  $telegram->saveTelegramUserData($data);

} catch (Exception $e) {

  die ($e->getMessage());
}

$tg_user = $telegram->getTelegramUserData();


//////////////////////////////

if ($_GET['logout']) {
  setcookie('tg_user', '');
  header('Location: index.php');
}

if ($tg_user !== false) {

  $first_name = htmlspecialchars($tg_user['first_name']);
  $last_name = htmlspecialchars($tg_user['last_name']);

  if (isset($tg_user['username'])) {
    $username = htmlspecialchars($tg_user['username']);
    $html = "<h1>Hello, <a href=\"https://t.me/{$username}\">{$first_name} {$last_name}</a>!</h1>";
  } else {
    $html = "<h1>Hello, {$first_name} {$last_name}!</h1>";
  }

  if (isset($tg_user['photo_url'])) {
    $photo_url = htmlspecialchars($tg_user['photo_url']);
    $html .= "<img src=\"{$photo_url}\">";
  }

  $html .= "<p><a href=\"?logout=1\">Log out</a></p>";

} else {

  $html = <<<HTML
<h1>Hello, anonymous!</h1>
<script async src="https://telegram.org/js/telegram-widget.js?2" data-telegram-login="codex_az_bot" data-size="large" data-auth-url="index.php"></script>
HTML;
}


  echo <<<HTML
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <title>Login Widget Example</title>
      </head>
      <body><center>{$html}</center></body>
    </html>
    HTML;
