<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 function getTelegramUserData() {
    if (isset($_COOKIE['tg_user'])) {
        $auth_data_json = urldecode($_COOKIE['tg_user']);
        $auth_data = json_decode($auth_data_json, true);
        return $auth_data;
    }
    return false;
}

if ($_GET['logout']) {
  setcookie('tg_user', '');
  header('Location: index.php');
}

$tg_user = getTelegramUserData();

if ($tg_user !== false) {

    var_dump($tg_user);

} else { ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Widget Example</title>
</head>
<body><center>
    <h1>Hello, anonymous!</h1>
    <script async src="https://telegram.org/js/telegram-widget.js?2" data-telegram-login="codex_az_bot" data-size="large" data-auth-url="callback.php"></script>
</center></body>
</html>

<?php } ?>