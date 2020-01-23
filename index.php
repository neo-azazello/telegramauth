<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('Auth.php');
$auth = new Auth;
$is_authed = $auth->getTelegramUserData();


if (isset($_GET['logout'])) {
  setcookie('tg_user', '');
  header('Location: index.php');
}


if ($is_authed !== false) {

    var_dump($is_authed);
    echo "<a href='?logout=1'>Logout</a>";
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