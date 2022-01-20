<?php

class CheckData {
	public $err;
	public $data_post;
	public $err_null;
	public $err_pattern;
	public $check_pattern;
	
	public function checkPost() {
		$this->data_post_space = str_replace(" ", "", $this->data_post);
		if (empty($this->data_post)) {
			$this->err = $this->err_null;
		} elseif (strcasecmp($this->data_post, $this->data_post_space) != 0) {
			$this->err = $this->err_space;
		} elseif (!preg_match($this->check_pattern, $this->data_post)) {
			$this->err = $this->err_pattern;
		}
	}

	public $err_confirm_post;
	public $data_conf_post;
	public function checkConfirmPost() {
		if (empty($this->data_conf_post)) {
			$this->err = $this->err_null;
		} elseif ($this->data_post != $this->data_conf_post) {
			$this->err = $this->err_confirm_post;
		}
	}

	public $data_email;
	public function checkEmail() {
		if (empty($this->data_email)) {
			$this->err = $this->err_null;
		} elseif (!filter_var($this->data_email, FILTER_VALIDATE_EMAIL)) {
			$this->err = $this->err_pattern;
		}
	}
}

class Page {
	public function checkCookie() {
		if(isset($_COOKIE['login']))	{
			setcookie("login", "", time() - 1, '\');
			setcookie("name","", time() - 1, '\');
			
		  	setcookie("login", $_COOKIE['login'], time() + 36000, $path = '\');
			setcookie ("name", $_COOKIE['name'], time() + 36000, $path = '\');
		  
		  $this->user_status = "login";
		
		  if(isset($_POST['logout'])) {
			setcookie("login", "");	
			setcookie("name", "");
			$this->user_status = "logout";
		  }
		} else {
		  $this->user_status = "logout";
		}
	}

	public function getPage() {
		if($this->user_status == "login") {
			$this->strResult = file_get_contents($this->page);
			echo $this->strResult;
		  } elseif ($this->user_status == "logout") {
			$this->strResult = file_get_contents($this->page_err);
			echo $this->strResult;
		  }
	}
}

?>