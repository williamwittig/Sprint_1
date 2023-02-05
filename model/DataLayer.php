<?php


namespace DataLayer;
class DataLayer {
	private $_dbh;

	/**
	 * DataLayer Constructor. Initializes PDO and enables error reporting
	 */
	function __construct() {
		//TODO: Move try-catch from config.php to here
		require_once $_SERVER['DOCUMENT_ROOT'].'/../config.php';

		$this->_dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$this->_dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,FALSE);
	}

	/**
	 * Method to check if a token exists in the database.
	 */
	function hasToken($token) {
		$sql = "SELECT studentToken 
				FROM studentSchedule";
		$statement = $this->_dbh->prepare($sql);
		$statement->bindParam(':token', $token);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		foreach ($statement as $row) {
			if ($row['studentToken']===$token) {
				return true;
			}
		}
		return false;
	}

	function isUniqueToken($token) {
		$sql = "SELECT studentToken 
				FROM studentSchedule";
		$statement = $this->_dbh->prepare($sql);
		$statement->bindParam(':token', $token);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$result = $statement->fetch();

		if ($result==null) {
			return true;
		}

		foreach ($result as $row) {
			if ($row===$token) {
				return false;
			}
		}
		return true;
	}

	/**
	 * Method to retrive a student's schedule given a token.
	 */
	function getSchedule($token) {
		$sql = "SELECT * 
				FROM studentSchedule
				WHERE studentToken = :token";
		$statement = $this->_dbh->prepare($sql);
		$statement->bindParam(':token', $token);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$result = $statement->fetch();

		// Create schedule object
		$schedule = new Schedule($result['studentToken'], $result['advisor'],
			$result['fallQtr'], $result['winterQtr'], $result['springQtr'],
			$result['summerQtr'], $result['lastSaved']);
		$_SESSION['schedule'] = $schedule;
	}

	function saveStudent($student) {

		// 1. Define the query
		$sql="INSERT INTO studentInfo (`fName`, `lName`, `studentIDNum`, 
                         `quarterStart`, `yearStart`, `quarterGraduate`, `yearGraduate`, 
                         `programName`, `plannedMajor`) 
					VALUES (:fName, :lName, :idNum, :startQtr, :startYear, 
					        :gradQtr, :gradYear, :program, :major)";

		// 2. Prepare the statement
		$statement=$this->_dbh->prepare($sql);

		// 3. Bind parameters
		$fName=$student->getFName();
		$lName=$student->getLName();
		$idNum=$student->getIdNum();
		$startQtr=$student->getStartQtr();
		$startYear=$student->getStartYear();
		$gradQtr=$student->getGradQtr();
		$gradYear=$student->getGradYear();
		$program=$student->getProgram();
		$major=$student->getMajor();
		$statement->bindParam(':fName',$fName,PDO::PARAM_STR);
		$statement->bindParam(':lName',$lName,PDO::PARAM_STR);
		$statement->bindParam(':idNum',$idNum,PDO::PARAM_STR);
		$statement->bindParam(':startQtr',$startQtr,PDO::PARAM_STR);
		$statement->bindParam(':startYear',$startYear,PDO::PARAM_STR);
		$statement->bindParam(':gradQtr',$gradQtr,PDO::PARAM_STR);
		$statement->bindParam(':gradYear',$gradYear,PDO::PARAM_STR);
		$statement->bindParam(':program',$program,PDO::PARAM_STR);
		$statement->bindParam(':major',$major,PDO::PARAM_STR);

		// 4. Execute the statement
		$statement->execute();

		//5. Process the result
		$id=$this->_dbh->lastInsertId();
		echo "Row inserted: $id";
		return $id;
	}

	function updateSchedule($studentToken, $advisor, $fallQtr, $winterQtr, $springQtr,
		$summerQtr, $lastSaved) {

		$sql = "UPDATE studentSchedule
				SET advisor = :advisor, fallQtr = :fallQtr, winterQtr = :winterQtr,
				springQtr = :springQtr, summerQtr = :summerQtr, lastSaved = :lastSaved
				WHERE studentToken = :studentToken";
		$statement = $this->_dbh->prepare($sql);
		$statement->bindParam(':studentToken', $studentToken);
		$statement->bindParam(':advisor', $advisor);
		$statement->bindParam(':fallQtr', $fallQtr);
		$statement->bindParam(':winterQtr', $winterQtr);
		$statement->bindParam(':springQtr', $springQtr);
		$statement->bindParam(':summerQtr', $summerQtr);
		$statement->bindParam(':lastSaved', $lastSaved);
		$statement->execute();
	}

	function saveNewSchedule($studentToken, $advisor, $fallQtr, $winterQtr, $springQtr,
		$summerQtr, $lastSaved) {
		$sql = "INSERT INTO studentSchedule (studentToken, advisor, fallQtr, winterQtr,
				springQtr, summerQtr, lastSaved)
				VALUES (:studentToken, :advisor, :fallQtr, :winterQtr, :springQtr,
				:summerQtr, :lastSaved)";
		$statement = $this->_dbh->prepare($sql);
		$statement->bindParam(':studentToken', $studentToken);
		$statement->bindParam(':advisor', $advisor);
		$statement->bindParam(':fallQtr', $fallQtr);
		$statement->bindParam(':winterQtr', $winterQtr);
		$statement->bindParam(':springQtr', $springQtr);
		$statement->bindParam(':summerQtr', $summerQtr);
		$statement->bindParam(':lastSaved', $lastSaved);
		$statement->execute();
	}

	function getAllSchedules() {
		$sql = "SELECT * FROM studentSchedule";
		$statement = $this->_dbh->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
}