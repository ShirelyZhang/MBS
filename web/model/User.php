<?php

class User{
	private $userId;
	private $nickname;
	private $password;
	private $created;
	private $updated;

	public function getUserId() {
		return $this->userId;
	}

	public function setUserId($userId) {
		$this->userId = $userId;
	}

	public function getNickname() {
		return $this->nickname;
	}

	public function setNickname($nickname) {
		$this->nickname = $nickname;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = md5($password);
	}

	public function getCreated() {
		return $this->created;
	}

	public function setCreated($created) {
		$this->created = $created;
	}

	public function getUpdated() {
		return $this->updated;
	}

	public function setUpdated($updated) {
		$this->updated = $updated;
	}
}