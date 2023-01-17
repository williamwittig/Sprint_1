<?php

class Controller {
	private $_f3;
	private $_dbh;

	/**
	 * This method constructs a controllers object
	 * @param $f3
	 */
	function __construct($f3) {
		$this->_f3=$f3;

		require_once $_SERVER['DOCUMENT_ROOT'].'/../config.php';
		$this->_dbh = $dbh;
		$this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->_dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		// Connect to the database
		$username="wwittigg_grcuser";
		$password="Merc2016";
		$hostname="localhost";
		$database="wwittigg_grc";
		$cnxn=@mysqli_connect($hostname,$username,$password,$database)
		or die("<p>Oops! Something went wrong.</p>");


		$_SESSION['idNum1']="100000";

	}

	function home() {
		$view=new Template();
		echo $view->render('views/home.html');
	}

	function educationPlan() {
		//		var_dump($_SESSION);
		$this->viewID();

		$view=new Template();
		echo $view->render('/views/education_plan.html');


		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$fName = $_POST['fName'];
			$lName = $_POST['lName'];
			$idNum = $_POST['idNum'];
			$startQtr = $_POST['startQtr'];
			$startYear = $_POST['startYear'];
			$gradQtr = $_POST['gradQtr'];
			$gradYear = $_POST['gradYear'];
			$program = $_POST['program'];
			$major = $_POST['major'];

			$fallYear = $_POST['fallYear'];
			$fallClass1 = $_POST['fallClassOne'];
			$fallCredit1 = $_POST['fallOneCredits'];
			$fallClass2 = $_POST['fallClassTwo'];
			$fallCredit2 = $_POST['fallTwoCredits'];
			$fallClass3 = $_POST['fallClassThree'];
			$fallCredit3 = $_POST['fallThreeCredits'];
			$fallClass4 = $_POST['fallClassFour'];
			$fallCredit4 = $_POST['fallFourCredits'];

			$winterYear = $_POST['winterYear'];
			$winterClass1 = $_POST['winterClassOne'];
			$winterCredit1 = $_POST['winterOneCredits'];
			$winterClass2 = $_POST['winterClassTwo'];
			$winterCredit2 = $_POST['winterTwoCredits'];
			$winterClass3 = $_POST['winterClassThree'];
			$winterCredit3 = $_POST['winterThreeCredits'];
			$winterClass4 = $_POST['winterClassFour'];
			$winterCredit4 = $_POST['winterFourCredits'];

			$springYear = $_POST['springYear'];
			$springClass1 = $_POST['springClassOne'];
			$springCredit1 = $_POST['springOneCredits'];
			$springClass2 = $_POST['springClassTwo'];
			$springCredit2 = $_POST['springTwoCredits'];
			$springClass3 = $_POST['springClassThree'];
			$springCredit3 = $_POST['springThreeCredits'];
			$springClass4 = $_POST['springClassFour'];
			$springCredit4 = $_POST['springFourCredits'];

			$summerYear = $_POST['summerYear'];
			$summerClass1 = $_POST['summerClassOne'];
			$summerCredit1 = $_POST['summerOneCredits'];
			$summerClass2 = $_POST['summerClassTwo'];
			$summerCredit2 = $_POST['summerTwoCredits'];
			$summerClass3 = $_POST['summerClassThree'];
			$summerCredit3 = $_POST['summerThreeCredits'];
			$summerClass4 = $_POST['summerClassFour'];
			$summerCredit4 = $_POST['summerFourCredits'];

			$this->saveStudent($fName, $lName, $idNum, $startQtr, $startYear,
				$gradQtr, $gradYear, $program, $major);
			$this->saveSchedule($idNum, 'Fall', $fallYear,
				$fallClass1, $fallCredit1,
				$fallClass2, $fallCredit2,
				$fallClass3, $fallCredit3,
				$fallClass4, $fallCredit4);
			$this->saveSchedule($idNum, 'Winter', $winterYear,
				$winterClass1, $winterCredit1,
				$winterClass2, $winterCredit2,
				$winterClass3, $winterCredit3,
				$winterClass4, $winterCredit4);
			$this->saveSchedule($idNum, 'Spring', $springYear,
				$springClass1, $springCredit1,
				$springClass2, $springCredit2,
				$springClass3, $springCredit3,
				$springClass4, $springCredit4);
			$this->saveSchedule($idNum, 'Summer', $summerYear,
				$summerClass1, $summerCredit1,
				$summerClass2, $summerCredit2,
				$summerClass3, $summerCredit3,
				$summerClass4, $summerCredit4);
		}

		return "";
		// session_destroy();
	}

	function saveSchedule($idNum, $season, $year,
		$classOne, $classOneCredit,
		$classTwo, $classTwoCredit,
		$classThree, $classThreeCredit,
		$classFour, $classFourCredit) {

		$sql = "INSERT INTO studentSchedule (`idNum`, `season`, `year`, 
                             `classOne`, `classOneCredits`, 
                             `classTwo`, `classTwoCredits`, 
                             `classThree`, `classThreeCredits`, 
                             `classFour`, `classFourCredits`)
                         VALUES (:idNum, :season, :year, 
                                 :classOne, :classOneCredit, 
                                 :classTwo, :classTwoCredit, 
                                 :classThree, :classThreeCredit, 
                                 :classFour, :classFourCredit)";

		// Prepare the statement
		$statement = $this->_dbh->prepare($sql);
		// Bind the parameters
		$statement->bindParam(':idNum', $idNum, PDO::PARAM_STR);
		$statement->bindParam(':season', $season, PDO::PARAM_STR);
		$statement->bindParam(':year', $year, PDO::PARAM_STR);
		$statement->bindParam(':classOne', $classOne, PDO::PARAM_STR);
		$statement->bindParam(':classOneCredit', $classOneCredit, PDO::PARAM_STR);
		$statement->bindParam(':classTwo', $classTwo, PDO::PARAM_STR);
		$statement->bindParam(':classTwoCredit', $classTwoCredit, PDO::PARAM_STR);
		$statement->bindParam(':classThree', $classThree, PDO::PARAM_STR);
		$statement->bindParam(':classThreeCredit', $classThreeCredit, PDO::PARAM_STR);
		$statement->bindParam(':classFour', $classFour, PDO::PARAM_STR);
		$statement->bindParam(':classFourCredit', $classFourCredit, PDO::PARAM_STR);
		// Execute
		$statement->execute();
	}

	function saveStudent($fName, $lName, $idNum, $startQtr, $startYear,
		$gradQtr, $gradYear, $program, $major) {
		// Create a query
		$sql = "INSERT INTO studentInfo (`fName`, `lName`, `studentIDNum`, 
                         `quarterStart`, `yearStart`, `quarterGraduate`, 
                         `yearGraduate`, `programName`, `plannedMajor`)
				VALUES (:fName, :lName, :idNum, :startQtr, :startYear, 
				        :gradQtr, :gradYear, :program, :major);";

		// Prepare the statement
		$statement = $this->_dbh->prepare($sql);
		// Bind the parameters
		$statement->bindParam(':fName', $fName, PDO::PARAM_STR);
		$statement->bindParam(':lName', $lName, PDO::PARAM_STR);
		$statement->bindParam(':idNum', $idNum, PDO::PARAM_STR);
		$statement->bindParam(':startQtr', $startQtr, PDO::PARAM_STR);
		$statement->bindParam(':startYear', $startYear, PDO::PARAM_STR);
		$statement->bindParam(':gradQtr', $gradQtr, PDO::PARAM_STR);
		$statement->bindParam(':gradYear', $gradYear, PDO::PARAM_STR);
		$statement->bindParam(':program', $program, PDO::PARAM_STR);
		$statement->bindParam(':major', $major, PDO::PARAM_STR);
		// Execute
		$statement->execute();
	}

	function viewID() {
		// Getting the highest number in the database
		//1. Define the query
		$sql = "SELECT MAX(id) FROM idNum";
		//2. Prepare the statement
		$statement = $this->_dbh->prepare($sql);
		// 4. Execute the prepared statement
		$statement->execute();
		// 5. Process the result
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		$_SESSION['idNum1'] = $result[0]['MAX(id)'];

		// Insert new ID num when new student is added
		$sql = "INSERT INTO idNum (id) VALUES ($_SESSION[idNum1]+1)";
		//2. Prepare the statement
		$statement = $this->_dbh->prepare($sql);
		// 4. Execute the prepared statement
		$statement->execute();
		// 5. Process the result
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
}