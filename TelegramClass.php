<?php

class Telegram {

  const BOT_TOKEN = '1012964913:AAEO2FJjZZwLnRDjaMLoLKBwsh1bop0T8k0';

  public function checkTelegramAuthorization($auth_data) {

    $check_hash = $auth_data['hash'];
    unset($auth_data['hash']);
    $data_check_arr = [];

    foreach ($auth_data as $key => $value) {
      $data_check_arr[] = $key . '=' . $value;
    }

    sort($data_check_arr);

    $data_check_string = implode("\n", $data_check_arr);
    $secret_key = hash('sha256', self::BOT_TOKEN, true);
    $hash = hash_hmac('sha256', $data_check_string, $secret_key);

    if (strcmp($hash, $check_hash) !== 0) {
      throw new Exception('Data is NOT from Telegram');
    }

    if ((time() - $auth_data['auth_date']) > 86400) {
      throw new Exception('Data is outdated');
    }

    return $auth_data;
  }

  public function saveTelegramUserData($auth_data) {
    $auth_data_json = json_encode($auth_data);
    setcookie('tg_user', $auth_data_json);
  }


}
