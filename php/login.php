<?php

include '..\cls\global_class.php';
include '..\cls\global_db.php';

include '..\txt\error_list.php';
include '..\txt\pattern_list.php';

$result['status'] = 'success';

$file_db = '..\db\db.json';

$login = new CheckData;
$login->data_post = $_POST['login'];
$login->err_null = $array_err['err_login_null'];
$login->err_space = $array_err['err_space'];
$login->err_pattern = $array_err['err_login_pattern'];
$login->check_pattern = $array_pattern['login_pattern'];
$login->checkPost();

if ($login->err != '') {
    $result['status'] = 'error';
    $result['error']['login'] = $login->err;
}

$password = new CheckData;
$password->data_post = $_POST['password'];
$password->err_null = $array_err['err_password_null'];
$password->err_space = $array_err['err_space'];
$password->err_pattern = $array_err['err_password_pattern'];
$password->check_pattern = $array_pattern['password_pattern'];
$password->checkPost();

if ($password->err != '') {
    $result['status'] = 'error';
    $result['error']['password'] = $password->err;
}

$login_user = new DBLogin;
$login_user->array_object_err = $result['error'];
$login_user->filename = $file_db;
$login_user->err_login_pass = $array_err['err_login_pass'];
$login_user->err_login_db = $array_err['err_login_db'];
$login_user->err_db = $array_err['err_db'];
$login_user->log_in_json();

if ($login_user->err != '') {
    $result['status'] = 'error';
    $result['error']['login'] = $login_user->err;
} elseif ($login->err != '') {
    $result['status'] = 'error';
    $result['error']['login'] = $login->err;
}

ob_clean();

echo json_encode($result);