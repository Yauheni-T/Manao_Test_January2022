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

$check_login = new NewUserDB;
$check_login->err = $login->err;
$check_login->filename = $file_db;
$check_login->check_key = 'login';
$check_login->check_value = $login->data_post;
$check_login->err_copy = $array_err['err_login_copy'];
$check_login->checkCopyData();

if ($check_login->err != '') {
    $result['status'] = 'error';
    $result['error']['login'] = $check_login->err;
} elseif ($login->err != '') {
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

$confirm_password = new CheckData;
$confirm_password->data_post = $_POST['password'];
$confirm_password->data_conf_post = $_POST['confirm_password'];
$confirm_password->err_null = $array_err['err_conf_pass_null'];
$confirm_password->err_confirm_post = $array_err['err_confirm_password'];
$confirm_password->checkConfirmPost();

if ($confirm_password->err != '') {
    $result['status'] = 'error';
    $result['error']['confirm_password'] = $confirm_password->err;
}

$email = new CheckData;
$email->data_email = $_POST['email'];
$email->err_null = $array_err['err_email_null'];
$email->err_space = $array_err['err_space'];
$email->err_pattern = $array_err['err_email_pattern'];
$email->checkEmail();

$check_email = new NewUserDB;
$check_email->err = $email->err;
$check_email->filename = $file_db;
$check_email->check_key = 'email';
$check_email->check_value = $email->data_email;
$check_email->err_copy = $array_err['err_email_copy'];
$check_email->checkCopyData();

if ($check_email->err != '') {
    $result['status'] = 'error';
    $result['error']['email'] = $check_email->err;
} elseif ($email->err != '') {
    $result['status'] = 'error';
    $result['error']['email'] = $email->err;
}

$name = new CheckData;
$name->data_post = $_POST['name'];
$name->err_null = $array_err['err_username_null'];
$name->err_space = $array_err['err_space'];
$name->err_pattern = $array_err['err_username_pattern'];
$name->check_pattern = $array_pattern['username_pattern'];
$name->checkPost();

if ($name->err != '') {
    $result['status'] = 'error';
    $result['error']['name'] = $name->err;
}

$bd_json_rw = new NewUserDB;
$bd_json_rw->array_object_err = $result['error'];
$bd_json_rw->filename = $file_db;
$bd_json_rw->addNewUserDB();

ob_clean();

echo json_encode($result);