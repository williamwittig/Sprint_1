<?php
class QuarterPlan {
	private $_qtr;
	private $_year;
	private $_student;
	private $_courseOne;
	private $_courseOneCredit;
	private $_courseTwo;
	private $_courseTwoCredit;
	private $_courseThree;
	private $_courseThreeCredit;
	private $_courseFour;
	private $_courseFourCredit;
	private $_quarterNotes;

	/**
	 * @param $_qtr
	 * @param $_year
	 * @param $_student
	 * @param $_courseOne
	 * @param $_courseOneCredit
	 * @param $_courseTwo
	 * @param $_courseTwoCredit
	 * @param $_courseThree
	 * @param $_courseThreeCredit
	 * @param $_courseFour
	 * @param $_courseFourCredit
	 * @param $_quarterNotes
	 */
	public function __construct($_qtr,$_year,$_student,$_courseOne,$_courseOneCredit,
		$_courseTwo,$_courseTwoCredit,$_courseThree,$_courseThreeCredit,$_courseFour,
		$_courseFourCredit,$_quarterNotes) {
		$this->_qtr=$_qtr;
		$this->_year=$_year;
		$this->_student=$_student;
		$this->_courseOne=$_courseOne;
		$this->_courseOneCredit=$_courseOneCredit;
		$this->_courseTwo=$_courseTwo;
		$this->_courseTwoCredit=$_courseTwoCredit;
		$this->_courseThree=$_courseThree;
		$this->_courseThreeCredit=$_courseThreeCredit;
		$this->_courseFour=$_courseFour;
		$this->_courseFourCredit=$_courseFourCredit;
		$this->_quarterNotes=$_quarterNotes;
	}

	/**
	 * @return mixed
	 */
	public function getQtr() {
		return $this->_qtr;
	}

	/**
	 * @param mixed $qtr
	 */
	public function setQtr($qtr): void {
		$this->_qtr=$qtr;
	}

	/**
	 * @return mixed
	 */
	public function getYear() {
		return $this->_year;
	}

	/**
	 * @param mixed $year
	 */
	public function setYear($year): void {
		$this->_year=$year;
	}

	/**
	 * @return mixed
	 */
	public function getStudent() {
		return $this->_student;
	}

	/**
	 * @param mixed $student
	 */
	public function setStudent($student): void {
		$this->_student=$student;
	}

	/**
	 * @return mixed
	 */
	public function getCourseOne() {
		return $this->_courseOne;
	}

	/**
	 * @param mixed $courseOne
	 */
	public function setCourseOne($courseOne): void {
		$this->_courseOne=$courseOne;
	}

	/**
	 * @return mixed
	 */
	public function getCourseOneCredit() {
		return $this->_courseOneCredit;
	}

	/**
	 * @param mixed $courseOneCredit
	 */
	public function setCourseOneCredit($courseOneCredit): void {
		$this->_courseOneCredit=$courseOneCredit;
	}

	/**
	 * @return mixed
	 */
	public function getCourseTwo() {
		return $this->_courseTwo;
	}

	/**
	 * @param mixed $courseTwo
	 */
	public function setCourseTwo($courseTwo): void {
		$this->_courseTwo=$courseTwo;
	}

	/**
	 * @return mixed
	 */
	public function getCourseTwoCredit() {
		return $this->_courseTwoCredit;
	}

	/**
	 * @param mixed $courseTwoCredit
	 */
	public function setCourseTwoCredit($courseTwoCredit): void {
		$this->_courseTwoCredit=$courseTwoCredit;
	}

	/**
	 * @return mixed
	 */
	public function getCourseThree() {
		return $this->_courseThree;
	}

	/**
	 * @param mixed $courseThree
	 */
	public function setCourseThree($courseThree): void {
		$this->_courseThree=$courseThree;
	}

	/**
	 * @return mixed
	 */
	public function getCourseThreeCredit() {
		return $this->_courseThreeCredit;
	}

	/**
	 * @param mixed $courseThreeCredit
	 */
	public function setCourseThreeCredit($courseThreeCredit): void {
		$this->_courseThreeCredit=$courseThreeCredit;
	}

	/**
	 * @return mixed
	 */
	public function getCourseFour() {
		return $this->_courseFour;
	}

	/**
	 * @param mixed $courseFour
	 */
	public function setCourseFour($courseFour): void {
		$this->_courseFour=$courseFour;
	}

	/**
	 * @return mixed
	 */
	public function getCourseFourCredit() {
		return $this->_courseFourCredit;
	}

	/**
	 * @param mixed $courseFourCredit
	 */
	public function setCourseFourCredit($courseFourCredit): void {
		$this->_courseFourCredit=$courseFourCredit;
	}

	/**
	 * @return mixed
	 */
	public function getQuarterNotes() {
		return $this->_quarterNotes;
	}

	/**
	 * @param mixed $quarterNotes
	 */
	public function setQuarterNotes($quarterNotes): void {
		$this->_quarterNotes=$quarterNotes;
	}


}