<?php

class Message{
	private $messageId;
	private $userId;
	private $title;
	private $content;
	private $created;
	private $updated;

	public function getMessageId() {
		return $this->messageId;
	}

	public function setMessageId($id) {
		$this->messageId = $id;
	}

	public function getUserId() {
		return $this->userId;
	}

	public function setUserId($userId) {
		$this->userId = $userId;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getContent() {
		return $this->content;
	}

	public function setContent($content) {
		$this->content = $content;
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