<?php
class Student {
	private $_fName;
	private $_lName;
	private $_idNum;
	private $_startQtr;
	private $_startYear;
	private $_gradQtr;
	private $_gradYear;
	private $_program;
	private $_major;

	/**
	 * @param $_fName
	 * @param $_lName
	 * @param $_idNum
	 * @param $_startQtr
	 * @param $_startYear
	 * @param $_gradQtr
	 * @param $_gradYear
	 * @param $_program
	 * @param $_major
	 */
	public function __construct($_fName,$_lName,$_idNum,$_startQtr,$_startYear,$_gradQtr,
		$_gradYear,$_program,$_major) {
		$this->_fName=$_fName;
		$this->_lName=$_lName;
		$this->_idNum=$_idNum;
		$this->_startQtr=$_startQtr;
		$this->_startYear=$_startYear;
		$this->_gradQtr=$_gradQtr;
		$this->_gradYear=$_gradYear;
		$this->_program=$_program;
		$this->_major=$_major;
	}

	/**
	 * @return mixed
	 */
	public function getFName(): string {
		return $this->_fName;
	}

	/**
	 * @param mixed $fName
	 */
	public function setFName($fName): void {
		$this->_fName=$fName;
	}

	/**
	 * @return mixed
	 */
	public function getLName(): string {
		return $this->_lName;
	}

	/**
	 * @param mixed $lName
	 */
	public function setLName($lName): void {
		$this->_lName=$lName;
	}

	/**
	 * @return mixed
	 */
	public function getIdNum(): string {
		return $this->_idNum;
	}

	/**
	 * @param mixed $idNum
	 */
	public function setIdNum($idNum): void {
		$this->_idNum=$idNum;
	}

	/**
	 * @return mixed
	 */
	public function getStartQtr(): string {
		return $this->_startQtr;
	}

	/**
	 * @param mixed $startQtr
	 */
	public function setStartQtr($startQtr): void {
		$this->_startQtr=$startQtr;
	}

	/**
	 * @return mixed
	 */
	public function getStartYear(): string {
		return $this->_startYear;
	}

	/**
	 * @param mixed $startYear
	 */
	public function setStartYear($startYear): void {
		$this->_startYear=$startYear;
	}

	/**
	 * @return mixed
	 */
	public function getGradQtr(): string {
		return $this->_gradQtr;
	}

	/**
	 * @param mixed $gradQtr
	 */
	public function setGradQtr($gradQtr): void {
		$this->_gradQtr=$gradQtr;
	}

	/**
	 * @return mixed
	 */
	public function getGradYear(): string {
		return $this->_gradYear;
	}

	/**
	 * @param mixed $gradYear
	 */
	public function setGradYear($gradYear): void {
		$this->_gradYear=$gradYear;
	}

	/**
	 * @return mixed
	 */
	public function getProgram(): string {
		return $this->_program;
	}

	/**
	 * @param mixed $program
	 */
	public function setProgram($program): void {
		$this->_program=$program;
	}

	/**
	 * @return mixed
	 */
	public function getMajor(): string {
		return $this->_major;
	}

	/**
	 * @param mixed $major
	 */
	public function setMajor($major): void {
		$this->_major=$major;
	}
}