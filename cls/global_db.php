<?php

class NewUserDB {
	public $err;
	public $filename;
	public $check_key;
	public $check_value;
	public function checkCopyData() {
		if (is_null($this->err)) {
			if (file_exists($this->filename)) {
				$this->file = file_get_contents($this->filename);
				$this->DBarray = json_decode($this->file,TRUE);
				foreach ($this->DBarray as $this->DBdata => $this->DBaccount) {
					foreach ($this->DBaccount as $this->DBkey => $this->DBvalue) {
						if (strcasecmp($this->DBkey, $this->check_key) == 0 && strcasecmp($this->DBvalue, $this->check_value) == 0) {
							$this->err = $this->err_copy;
							break;
						}
					}
				}
			} 
		}
	}
	
	public $array_object_err = array();
	public function addNewUserDB() {
		if (empty($this->array_object_err)) {
			if (file_exists($this->filename)){
				$file = file_get_contents($this->filename);
				$DBarray = json_decode($file,TRUE);
			}
			$hash_password = md5($_POST['password'] . $_POST['login']);
			$DBarray[$_POST['login']] = array(
			'login'	=> $_POST['login'],
			'password'	=> $hash_password,
			'email'	=> $_POST['email'],
			'name'	=> $_POST['name']
			);
			file_put_contents($this->filename, json_encode($DBarray));
		}
	}
}

class DBLogin {
	public $filename;
	public $array_object_err = array();
	public function log_in_json() {
		if (empty($this->array_object_err)) {
			if (file_exists($this->filename)) {
				$file = file_get_contents($this->filename);
				$DBarray = json_decode($file,TRUE);
				if ($DBarray[$_POST['login']]) {
					$hash_password = md5($_POST['password'] . $_POST['login']);
					$strCaseLogin = strcasecmp($_POST['login'], $DBarray[$_POST['login']]['login']);
					$strCasePassword = strcasecmp($hash_password, $DBarray[$_POST['login']]['password']);
					if ($strCaseLogin == 0 && $strCasePassword == 0){
						$name_user = $DBarray[$_POST['login']]['name'];

						setcookie ("login", $_POST['login'], time() + 36000, $path = '\');
						setcookie ("name", $name_user, time() + 36000, $path = '\');
					} else {
						$this->err = $this->err_login_pass;
					}
				} else {
					$this->err = $this->err_login_db;
				}
			} else{
				$this->err = $this->err_db;
			} 
		} 
	}
}

?>