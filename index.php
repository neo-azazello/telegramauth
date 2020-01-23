<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('TelegramClass.php');
$telegram = new Telegram;

try {

    $tg_user = $telegram->getTelegramUserData();

    if($tg_user == false) {
        $data = $telegram->checkTelegramAuthorization($_GET);
        $telegram->saveTelegramUserData($data);
    }

} catch (Exception $e) {

  die ($e->getMessage());
}


//////////////////////////////

if ($_GET['logout']) {
  setcookie('tg_user', '');
  header('Location: index.php');
}

if ($tg_user !== false) {

    print_r($tg_user);

} else { ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Widget Example</title>
</head>
<body><center>
    <h1>Hello, anonymous!</h1>
    <script async src="https://telegram.org/js/telegram-widget.js?2" data-telegram-login="codex_az_bot" data-size="large" data-auth-url="index.php"></script>
</center></body>
</html>

<?php } ?>