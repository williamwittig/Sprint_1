<?php


namespace DataLayer;
class DataLayer {
	private $_dbh;

	function __construct() {
		//TODO: Move try-catch from config.php to here
		require_once $_SERVER['DOCUMENT_ROOT'].'/../config.php';

		// Connect to the database
		$username = "wwittigg_grcuser";
		$password = "Merc2016";
		$hostname = "localhost";
		$database = "wwittigg_grc";

		$cnxn = @mysqli_connect($hostname, $username, $password, $database)
		or die("<p>Oops! Something went wrong.</p>");

		$this->_dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$this->_dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,FALSE);
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
}