<?php
class Schedule {
	public $_token;
	public $_advisor;
	public $_fallQtr;
	public $_winterQtr;
	public $_springQtr;
	public $_summerQtr;
	public $_lastSaved;

	public function __construct($token, $advisor, $fallQtr, $winterQtr, $springQtr, $summerQtr, $lastSaved) {
		$this->_token = $token;
		$this->_advisor = $advisor;
		$this->_fallQtr = $fallQtr;
		$this->_winterQtr = $winterQtr;
		$this->_springQtr = $springQtr;
		$this->_summerQtr = $summerQtr;
		$this->_lastSaved = $lastSaved;
	}

	public function getToken() {
		return $this->_token;
	}

	public function getAdvisor() {
		return $this->_advisor;
	}

	public function getFallQtr() {
		return $this->_fallQtr;
	}

	public function getWinterQtr() {
		return $this->_winterQtr;
	}

	public function getSpringQtr() {
		return $this->_springQtr;
	}

	public function getSummerQtr() {
		return $this->_summerQtr;
	}

	public function getLastSaved() {
		return $this->_lastSaved;
	}

	public function setToken($token) {
		$this->_token = $token;
	}

	public function setAdvisor($advisor) {
		$this->_advisor = $advisor;
	}

	public function setFallQtr($fallQtr) {
		$this->_fallQtr = $fallQtr;
	}

	public function setWinterQtr($winterQtr) {
		$this->_winterQtr = $winterQtr;
	}

	public function setSpringQtr($springQtr) {
		$this->_springQtr = $springQtr;
	}

	public function setSummerQtr($summerQtr) {
		$this->_summerQtr = $summerQtr;
	}

	public function setLastSaved($lastSaved) {
		$this->_lastSaved = $lastSaved;
	}
}
