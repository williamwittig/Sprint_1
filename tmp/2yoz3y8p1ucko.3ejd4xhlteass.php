<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
		  integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<title>Education Plan</title>
</head>
<body>
	<!--NAVBAR-->
	<nav class="navbar navbar-expand-lg navbar-light bg-light p-3">
		<a class="navbar-brand" href="home.html">Home</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="">New Education Plan</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Previous Education Plan</a>
				</li>
			</ul>
		</div>

		<div class="float-centered m-3">
			<span class="mt-2">Last Saved: 12:02pm</span>
		</div>
	</nav>

	<div class="container mt-2 mb-5 pb-5">
		<div class="row justify-content-center mb-5 pb-5">
			<div class="col text-center">
				<h1 class="pt-5 pb-3">Educational Planning Worksheet</h1>
				<h5>Student ID: <?= ($SESSION['idNum1']) ?></h5>
				<hr>
				<form class="col-lg-8 offset-lg-2" action="#" method="post">
					<!--Student Info-->
					<h4 class="mt-4">Student Information</h4>
					<div class="input-group m-2">
						<!-- declaration for first field -->
						<input type="text" class="form-control input-sm" name="fName" placeholder="First Name" />
						<!-- declaration for second field -->
						<input type="text" class="form-control input-sm" name="lName" placeholder="Student Last Name" />
					</div>

					<div class="input-group m-2">
						<!-- declaration for first field -->
						<input type="text" class="form-control input-sm" name="idNum"  placeholder="Student ID Number" />
					</div>

					<div class="input-group m-2">
						<!-- declaration for first field -->
						<input type="text" class="form-control input-sm" name="startQtr"  placeholder="Intended Quarter to Start" />
						<!-- declaration for second field -->
						<input type="text" class="form-control input-sm" name="startYear"  placeholder="Intended Year to Start" />
					</div>

					<div class="input-group m-2">
						<!-- declaration for first field -->
						<input type="text" class="form-control input-sm" name="gradQtr"  placeholder="Intended Quarter to Graduate" />
						<!-- declaration for second field -->
						<input type="text" class="form-control input-sm" name="gradYear"  placeholder="Intended Year to Graduate" />
					</div>

					<h4 class="mt-4">Degree/Diploma Information</h4>
					<div class="input-group m-2">
						<!-- declaration for first field -->
						<input type="text" class="form-control input-sm" name="program"  placeholder="Program Name" />
						<!-- declaration for second field -->
						<input type="text" class="form-control input-sm" name="major"  placeholder="Planned Major at University" />
					</div>

					<h3 class="m-4 mt-5">Academic Schedule</h3>

					<hr>

					<div>
						<h4 class="d-inline">Fall Quarter</h4>
						<input type="text" class="form-control d-inline input-sm w-25" name="fallYear"
							   placeholder="Year" />
					</div>

					<div class="input-group m-2" id="fallQtr">
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" name="fallClassOne" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" name="fallOneCredits" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" name="fallClassTwo" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" name="fallTwoCredits" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" name="fallClassThree" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" name="fallThreeCredits" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" name="fallClassFour" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" name="fallFourCredits" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<textarea type="text" class="form-control input-sm w-50 inputlg" name="fallNotes" placeholder="Notes" ></textarea>
						</div>
					</div>

					<div>
						<h4 class="d-inline">Winter Quarter</h4>
						<input type="text" class="form-control d-inline input-sm w-25" name="winterYear"
							   placeholder="Year" />
					</div>

					<div class="input-group m-2" id="winterQtr">
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" name="winterClassOne" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" name="winterOneCredits" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" name="winterClassTwo" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" name="winterTwoCredits" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" name="winterClassThree" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" name="winterThreeCredits" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" name="winterClassFour" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" name="winterFourCredits" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<textarea type="text" class="form-control input-sm w-50 inputlg" name="winterNotes" placeholder="Notes" ></textarea>
						</div>
					</div>

					<div>
						<h4 class="d-inline">Spring Quarter</h4>
						<input type="text" class="form-control d-inline input-sm w-25" name="springYear"
							   placeholder="Year" />
					</div>

					<div class="input-group m-2" id="springQtr">
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" name="springClassOne" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" name="springOneCredits" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" name="springClassTwo" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" name="springTwoCredits" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" name="springClassThree" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" name="springThreeCredits" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" name="springClassFour" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" name="springFourCredits" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<textarea type="text" class="form-control input-sm w-50 inputlg" name="springNotes" placeholder="Notes" ></textarea>
						</div>
					</div>

					<div>
						<h4 class="d-inline">Summer Quarter</h4>
						<input type="text" class="form-control d-inline input-sm w-25" name="summerYear"
							   placeholder="Year" />
					</div>

					<div class="input-group m-2 mb-4" id="summerQtr">
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" name="summerClassOne" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" name="summerOneCredits" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" name="summerClassTwo" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" name="summerTwoCredits" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" name="summerClassThree" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" name="summerThreeCredits" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" name="summerClassFour" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" name="summerFourCredits" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<textarea type="text" class="form-control input-sm w-50 inputlg" name="summerNotes" placeholder="Notes" ></textarea>
						</div>
					</div>
					<hr>
					<div class="float-centered mt-3">
						<button class="btn btn-primary" type="submit">SAVE EDUCATION PLAN</button>
					</div>
				</form>
			</div>
		</div>
	</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
		integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
		crossorigin="anonymous"></script>
</body>
</html>