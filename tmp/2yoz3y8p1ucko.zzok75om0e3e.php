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
	<nav class="navbar navbar-expand-lg navbar-light bg-light p-3">
		<a class="navbar-brand" href="views/home.html">Home</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">New Education Plan</a>
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
				<hr>
				<form class="col-lg-8 offset-lg-2" action="#" method="post">
					<h4 class="mt-4">Student Information</h4>
					<div class="input-group m-2">
						<!-- declaration for first field -->
						<input type="text" class="form-control input-sm" placeholder="First Name" />
						<!-- declaration for second field -->
						<input type="text" class="form-control input-sm" placeholder="Student Last Name" />
					</div>

					<div class="input-group m-2">
						<!-- declaration for first field -->
						<input type="text" class="form-control input-sm" placeholder="Student ID Number" />
					</div>

					<div class="input-group m-2">
						<!-- declaration for first field -->
						<input type="text" class="form-control input-sm" placeholder="Intended Quarter to Start" />
						<!-- declaration for second field -->
						<input type="text" class="form-control input-sm" placeholder="Intended Year to Start" />
					</div>

					<div class="input-group m-2">
						<!-- declaration for first field -->
						<input type="text" class="form-control input-sm" placeholder="Intended Quarter to Graduate" />
						<!-- declaration for second field -->
						<input type="text" class="form-control input-sm" placeholder="Intended Year to Graduate" />
					</div>

					<h4 class="mt-4">Degree/Diploma Information</h4>
					<div class="input-group m-2">
						<!-- declaration for first field -->
						<input type="text" class="form-control input-sm" placeholder="Program Name" />
						<!-- declaration for second field -->
						<input type="text" class="form-control input-sm" placeholder="Planned Major at University" />
					</div>

					<h3 class="m-4 mt-5">Academic Schedule</h3>

					<hr>

					<h4 class="m-4 mt-4 mb-2">Fall Quarter</h4>
					<div class="input-group m-2" id="fallQtr">
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<textarea type="text" class="form-control input-sm w-50 inputlg" placeholder="Notes" ></textarea>
						</div>
					</div>

					<h4 class="m-4 mb-2">Winter Quarter</h4>
					<div class="input-group m-2" id="winterQtr">
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<textarea type="text" class="form-control input-sm w-50 inputlg" placeholder="Notes" ></textarea>
						</div>
					</div>

					<h4 class="m-4 mb-2">Spring Quarter</h4>
					<div class="input-group m-2" id="springQtr">
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<textarea type="text" class="form-control input-sm w-50 inputlg" placeholder="Notes" ></textarea>
						</div>
					</div>

					<h4 class="m-4 mb-2">Summer Quarter</h4>
					<div class="input-group m-2 mb-4" id="summerQtr">
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<input type="text" class="form-control input-sm w-50" placeholder="Class Name" />
							<!-- declaration for second field -->
							<input type="text" class="form-control input-sm" placeholder="Credits" />
						</div>
						<div class="input-group m-2 mb-0">
							<!-- declaration for first field -->
							<textarea type="text" class="form-control input-sm w-50 inputlg" placeholder="Notes" ></textarea>
						</div>
					</div>
					<hr>
					<div class="float-centered mt-3">
						<a class="d-block p-3">
							<button class="btn btn-primary" type="submit">SAVE EDUCATION PLAN</button>
						</a>
						<span class="mt-2">Last Saved: 12:02pm</span>
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