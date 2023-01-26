<?php

include 'classes/schedule.php';

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
	}

	function home() {
		$view=new Template();
		echo $view->render('views/home.html');
	}

	function educationPlan() {
		// Get the token from the URL
		$url = parse_url($_SERVER['REQUEST_URI']);
		$token = $url['query'];

		// If the user input a token, retrieve the schedule
		if ($token!='' && $this->hasToken($token)) {
			// echo "Retrieving schedule...<br>";
			$this->getSchedule($token);
		}
		// If the user did not input a token, generate a new one
		else {
			// echo "Generating new token...<br>";
			$token = $this->generateStudentToken();
			$_SESSION['schedule'] = new Schedule($token, "", "",
				"", "", "", "");
		}

		// Rendering the education plan page
		$view=new Template();
		echo $view->render('views/education_plan.html');

		// Saving the schedule to the database
		if ($_SERVER['REQUEST_METHOD']==='POST') {
			if ($this->hasToken($_SESSION['schedule']->getToken())) {
				$this->updateSchedule($token, $_POST['advisor'], $_POST['fallQtr'],
					$_POST['winterQtr'], $_POST['springQtr'], $_POST['summerQtr'],
					$this->getTime());
			}
			else {
				$this->saveNewSchedule($token, $_POST['advisor'], $_POST['fallQtr'],
					$_POST['winterQtr'], $_POST['springQtr'], $_POST['summerQtr'],
					$this->getTime());
			}

			$this->addTokenToURL($token);
		}
		return "";
	}

    function admin() {
        $view=new Template();
        echo $view->render('views/admin.html');
    }

	function getTime() {
		date_default_timezone_set('America/Los_Angeles');
		return date('h:i:s a', time());
	}

	function hasQuery() {
		$url = parse_url($_SERVER['REQUEST_URI']);
		return $url['query']!='';
	}

	function addTokenToURL($token) {
		if (!$this->hasQuery()) {
			$url=$_SERVER['REQUEST_URI'];
			$url=$url."?".$token;
			header("Location: $url");
		}
	}

	function generateStudentToken() {
//		return random_int(100000, 999999);
		$token = $this->randHash();
		while (!$this->isUniqueToken($token)) {
			$token = $this->randHash();
		}
		return $token;
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

	function randHash() {
		$token = md5(uniqid(rand(), true));
		return substr($token, -6);
	}

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

    function test() {
        $view=new Template();
        echo $view->render('views/test.php');
    }
}