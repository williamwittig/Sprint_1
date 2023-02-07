<?php
class Schedule {
	private $_token;
	private $_advisor;
	private $_schoolYears;
	private $_lastSaved;

	/**
	 * Constructor for a Schedule or Plan.
	 * @param string $token Unique identifier for the plan
	 * @param string $advisor who created plan with student
	 * @param int $lastSaved time the plan was last saved
	 * @param array $schoolYears map of years to SchoolYear obejects
	 */
	public function __construct($token, $advisor, $lastSaved, $schoolYears) {
		$this->_token = $token;
		$this->_advisor = $advisor;
		$this->_lastSaved = $lastSaved;
		$this->_schoolYears = $schoolYears;
	}

	
	// Getters

	public function getToken() {
		return $this->_token;
	}

	public function getAdvisor() {
		return $this->_advisor;
	}

	public function getLastSaved() {
		return $this->_lastSaved;
	}

	/**
	 * Method to get a Map of the school years associated with this plan.
	 * @return array of years to SchoolYear objects
	 */
	public function getSchoolYears() {
		return $this->_schoolYears;
	}

	/**
	 * Method to get a single school year.
	 * @param int $year school year to retrieve
	 * @return SchoolYear object encapsulating school year data. 
	 * Empty SchoolYear is returned if $year is not stored.
	 */
	public function getSchoolYear($year) {
		// Return school year if found, or new empty year if not found
		return $this->_schoolYears[$year] = new SchoolYear($year);
	}


	// Setters

	public function setToken($token) {
		$this->_token = $token;
	}

	public function setAdvisor($advisor) {
		$this->_advisor = $advisor;
	}

	public function setLastSaved($lastSaved) {
		$this->_lastSaved = $lastSaved;
	}

	/**
	 * Method to store all school years at once.
	 * @param array $schoolYears School years stored as a map of the year to the SchoolYear object
	 */
	public function setSchoolYears($schoolYears) {
		$this->_schoolYears = $schoolYears;
	}

	/**
	 * Method to store or update a single year.
	 * @param SchoolYear $schoolYear object ecapsulating school year data
	 */
	public function setSchoolYear($schoolYear) {
		$this->_schoolYears[$schoolYear.getYear()] = $schoolYear;
	}
}
