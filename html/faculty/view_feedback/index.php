<!doctype html>
<html lang="en">

<head>
	<link rel="icon" href="../../../images/iiita_logo.png">
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../../css/style.css">
	<!-- Bootstrap CSS -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.js"
		integrity="sha512-VW8/i4IZkHxdD8OlqNdF7fGn3ba0+lYqag+Uy4cG6BtJ/LIr8t23s/vls70pQ41UasHH0tL57GQfKDApqc9izA=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<title>View Feedback</title>
	<style>
		.carousel-control-prev-icon {
			width: 5%;
			position: absolute;
			left: 0;
			margin-left: 0;
			background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
		}

		.carousel-control-next-icon {
			width: 5%;
			position: absolute;
			right: 0;
			margin-right: 0;
			background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
		}

		.carousel-control-prev-icon {
			width: 24px;
			height: 24px;
		}

		.carousel-control-next-icon {
			width: 24px;
			height: 24px;
		}
	</style>
</head>

<body>
	<script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
	<?php
	require('../../../php/gen_id.php');
	session_start();
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800 * 2)) {
		session_unset();
		session_destroy();
		erase_cookies();
		echo "
        <script>
        function logout() {
            alert('You have been logged in for more than 1 hours, Timeout!');
            window.location.replace('../../../');
        };
        logout();
        </script>";
	}

	?>
	<?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'faculty') {
		session_unset();
		session_destroy();
		erase_cookies();
		echo "<script> alert('You are not authorised to this page'); window.location.replace('../../../')</script>";
	}
	?>
	<div class="container-fluid fixed-top" style="margin:0;padding:0;">
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
			<div class="container-fluid">
				<a class="navbar-brand" href="../../../"><img src="../../../images/iiita_logo.png" alt="IIITA"
						width="60vw" height=auto class="align-text-middle"
						style='display:block;margin: 0 auto;max-width: 100%;'></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active text-success" aria-current="page" href="../../../"
								style="font-size:1.5rem;text-align:center">Welcome to Student Feedback Portal</a>
						</li>
					</ul>
					<form class="d-flex">
						<a href="../../../php/logout.php"><button class="btn btn-outline-primary" id="liveAlertn"
								type="button">Log
								Out</button></a>
					</form>
				</div>
			</div>
		</nav>
		<nav class="bg-white py-1"
			style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
			aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item" style="text-decoration: none;"><a href="../../../">Home</a></li>
				<li class="breadcrumb-item" style="text-decoration: none;"><a href="../login.php">Log In</a></li>
				<li class="breadcrumb-item" style="text-decoration: none;"><a href="../">Faculty</a></li>
				<li class="breadcrumb-item active" aria-current="page">View Feedback</li>
			</ol>
		</nav>
	</div>
	<div style='display:flex;align-items:center;justify-content: center;margin-top:200px' class="container-sm">
		<label for='course_id'>Select Course</label>
		<select class="form-select form-select-md" id='course_id' name='course_id' aria-label=".form-select-sm example"
			style='width:15%;margin:1%;'>
			<option selected disabled>Select Course</option>
		</select>
		<label for='sec_id'>Select Section</label>
		<select class="form-select form-select-md" id='sec_id' name='sec_id' aria-label=".form-select-sm example"
			style='width:15%;margin:1%;'>
			<option selected disabled>Select Section</option>
		</select>
		<label for='semester'>Select Semester</label>
		<select class="form-select form-select-md" id='semester' name='semester' aria-label=".form-select-sm example"
			style='width:15%;margin:1%;'>
			<option selected disabled>Select Semester</option>
		</select>
		<button id='reset' class='btn btn-primary' style='margin:1%;'>Reset</button>
	</div>
	<div id="carouselExampleIndicators" class="carousel slide" data-interval="false">
		<div class="carousel-indicators">
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
				aria-current="true" aria-label="Slide 1" style='background-color:#33ffff'></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"
				style='background-color:#33ffff'></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"
				style='background-color:#33ffff'></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"
				style='background-color:#33ffff'></button>
		</div>
		<div class="carousel-inner mt-4" data-interval="false">
			<div class="carousel-item active">
				<div style=' display:flex;border-style:ridge;width:90%;margin:auto;overflow:scroll;'>
					<div style='width:100%;margin:4%;padding:0;height:200px' id='div1'>
						<canvas id="myChart1" style='width:inherit;'></canvas>
					</div>
					<div style='width:100%;margin:4%;padding:0;height:200px' id='div2'>
						<canvas id="myChart2" style='width:inherit;'></canvas>
					</div>

				</div>
				<div style='display:flex;border-style:ridge;width:90%;margin:auto;overflow:scroll'>
					<div style='width:100%;margin:4%;padding:0;height:200px' id='div3'>
						<canvas id="myChart3" style='width:inherit;'></canvas>
					</div>
					<div style='width:100%;margin:4%;padding:0;height:200px' id='div4'>
						<canvas id="myChart4" style='width:inherit;'></canvas>
					</div>
				</div>
			</div>
			<div class="carousel-item">
				<div style='display:flex;border-style:ridge;width:90%;margin:auto;overflow:scroll'>
					<div style='width:100%;margin:4%;padding:0;height:300px;margin-left:10%' id='div5'>
						<canvas id="myChart5" style='width:inherit;'></canvas>
					</div>
					<div style='width:100%;margin:4%;padding:0;height:300px' id='div6'>
						<canvas id="myChart6" style='width:inherit;height:300px'></canvas>
					</div>
				</div>
			</div>
			<div class="carousel-item">
				<div class="container py-5"
					style='display:block;padding-left:3%;padding-right:3%;padding-top:0px;padding-bottom:0px;margin:0px;'>
					<div class="row d-flex justify-content-center" style=''>
						<div class="col-md-10 col-xl-8 text-center">
							<h3 class="fw-bold mb-4">Highest Rated Feedbacks</h3>
						</div>
					</div>
					<div class="row text-center">
						<div class="col-md-4 mb-4 mb-md-0">
							<div class="card">
								<div class="container-fluid bg-primary">
									<h5 class="font-weight-bold my-3 text-white" id='course_highest1'>N/A</h5>
									<h6 class="font-weight-bold my-3 text-white" id='semester_highest1'>N/A</h6>
								</div>
								<div class="card-body py-4 mt-2">

									<ul class="list-unstyled d-flex justify-content-center">
										<li><i class="fa-solid fa-star rating_highest1" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest1" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest1" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest1" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest1" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest1" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest1" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest1" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest1" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-regular fa-star rating_highest1" style="color: #fef058;"></i>
										</li>
									</ul>
									<p class="mb-2" id='comment_highest1'>
										<i class="fas fa-quote-left pe-2"></i>
										N/A
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4 mb-4 mb-md-0">
							<div class="card">
								<div class="container-fluid bg-primary">
									<h5 class="font-weight-bold my-3 text-white" id='course_highest2'>N/A</h5>
									<h6 class="font-weight-bold my-3 text-white" id='semester_highest2'>N/A</h6>
								</div>
								<div class="card-body py-4 mt-2">

									<ul class="list-unstyled d-flex justify-content-center">
										<li><i class="fa-solid fa-star rating_highest2" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest2" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest2" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest2" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest2" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest2" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest2" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest2" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest2" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-regular fa-star rating_highest2" style="color: #fef058;"></i>
										</li>
									</ul>
									<p class="mb-2" id='comment_highest2'>
										<i class="fas fa-quote-left pe-2"></i>
										N/A dafsjhvbnasjvhfjdsmbgn f dafjbs dnaf dnsa fbdw fmn m sdfn fandfm sna zfn
										fnsd nsa fjd vmsd fmn
										snaz n adfn sd
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4 mb-4 mb-md-0">
							<div class="card">
								<div class="container-fluid bg-primary">
									<h5 class="font-weight-bold my-3 text-white" id='course_highest3'>N/A</h5>
									<h6 class="font-weight-bold my-3 text-white" id='semester_highest3'>N/A</h6>
								</div>
								<div class="card-body py-4 mt-2">

									<ul class="list-unstyled d-flex justify-content-center">
										<li><i class="fa-solid fa-star rating_highest3" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest3" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest3" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest3" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest3" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest3" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest3" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest3" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest3" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-regular fa-star rating_highest3" style="color: #fef058;"></i>
										</li>
									</ul>
									<p class="mb-2" id='comment_highest3'>
										<i class="fas fa-quote-left pe-2"></i>
										N/A
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="carousel-item">
				<div class="container py-5"
					style='display:block;padding-left:3%;padding-right:3%;padding-top:0px;padding-bottom:0px;margin:0px;'>
					<div class="row d-flex justify-content-center" style=''>
						<div class="col-md-10 col-xl-8 text-center">
							<h3 class="fw-bold mb-4">Lowest Rated Feedbacks</h3>
						</div>
					</div>
					<div class="row text-center">
						<div class="col-md-4 mb-4 mb-md-0">
							<div class="card">
								<div class="container-fluid bg-primary">
									<h5 class="font-weight-bold my-3 text-white" id='course_highest4'>N/A</h5>
									<h6 class="font-weight-bold my-3 text-white" id='semester_highest4'>N/A</h6>
								</div>
								<div class="card-body py-4 mt-2">

									<ul class="list-unstyled d-flex justify-content-center">
										<li><i class="fa-solid fa-star rating_highest4" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest4" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest4" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest4" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest4" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest4" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest4" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest4" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest4" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-regular fa-star rating_highest4" style="color: #fef058;"></i>
										</li>
									</ul>
									<p class="mb-2" id='comment_highest4'>
										<i class="fas fa-quote-left pe-2"></i>
										N/A
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4 mb-4 mb-md-0">
							<div class="card">
								<div class="container-fluid bg-primary">
									<h5 class="font-weight-bold my-3 text-white" id='course_highest5'>N/A</h5>
									<h6 class="font-weight-bold my-3 text-white" id='semester_highest5'>N/A</h6>
								</div>
								<div class="card-body py-4 mt-2">

									<ul class="list-unstyled d-flex justify-content-center">
										<li><i class="fa-solid fa-star rating_highest5" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest5" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest5" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest5" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest5" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest5" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest5" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest5" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest5" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-regular fa-star rating_highest5" style="color: #fef058;"></i>
										</li>
									</ul>
									<p class="mb-2" id='comment_highest5'>
										<i class="fas fa-quote-left pe-2"></i>
										N/A
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4 mb-4 mb-md-0">
							<div class="card">
								<div class="container-fluid bg-primary">
									<h5 class="font-weight-bold my-3 text-white" id='course_highest6'>N/A</h5>
									<h6 class="font-weight-bold my-3 text-white" id='semester_highest6'>N/A</h6>
								</div>
								<div class="card-body py-4 mt-2">

									<ul class="list-unstyled d-flex justify-content-center">
										<li><i class="fa-solid fa-star rating_highest6" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest6" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest6" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest6" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest6" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest6" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest6" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest6" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-solid fa-star rating_highest6" style="color: #fef058;"></i>
										</li>
										<li><i class="fa-regular fa-star rating_highest6" style="color: #fef058;"></i>
										</li>
									</ul>
									<p class="mb-2" id='comment_highest6'>
										<i class="fas fa-quote-left pe-2"></i>
										N/A
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
			data-bs-slide="prev" style='width:2%'>
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
			data-bs-slide="next" style='width:2%'>
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div>
	<?php
	require_once('../../../php/connection.php');
	try {
		$sql = "select * from p1_feedback natural join (select * from p1_teaches where id='" . $_SESSION['id'] . "') e1 where p1_feedback.freeze=1;";
		$result = $con->query($sql);
		$arr = [];
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			array_push($arr, $row);
		}
		$var = json_encode($arr);
		echo "<script>var data=$var;</script>";
		$sql = "select course_id,sec_id,semester from p1_teaches where id='" . $_SESSION['id'] . "';";
		$result = $con->query($sql);
		$arr = [];
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			array_push($arr, $row);
		}
		$var = json_encode($arr);
		echo "<script>
      var courseSet=new Set();
      var sectionSet=new Set();
      var semesterSet=new Set();
      var temp=$var;
      for(var k in temp){
        courseSet.add(temp[k].course_id);
        sectionSet.add(temp[k].sec_id);
        semesterSet.add(temp[k].semester);
      }
      </script>";
		$sql = "select * from p1_gives;";
		$result = $con->query($sql);
		$arr = [];
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			array_push($arr, $row);
		}
		$var = json_encode($arr);
		echo "<script>
    var anon_id=$var;
    var mapper={};
    for(var k=0;k<anon_id.length;k++){
      mapper[anon_id[k].feedback_id]=anon_id[k].anon_id;
    }
    </script>";
		$sql = "select p1_takes.anon_id,p1_teaches.ID,p1_teaches.course_id,p1_teaches.sec_id,p1_teaches.semester from (select * from p1_takes inner join p1_represents on p1_takes.id=p1_represents.stud_id) p1_takes inner join (select * from p1_teaches where ID='" . $_SESSION['id'] . "') p1_teaches on p1_takes.course_id=p1_teaches.course_id and p1_takes.sec_id=p1_teaches.sec_id and p1_takes.semester=p1_teaches.semester;";
		$result = $con->query($sql);
		$arr = [];
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			array_push($arr, $row);
		}
		$var = json_encode($arr);
		echo "<script>
      var enrollment_data=$var;
      </script>";
	} catch (Exception $e) {
		echo "<script>alert('There has been some error on this page, please contact administrator!');window.location.replace('../');</script>";
	}
	?>
	<div id="top" class='table-responsive '>
		<table class='table sortable' id='feedbackTable'>
			<thead class='p-3 mb-2 bg-primary text-white'>
				<th scope='col' style='width: 25%;text-align: center;'>Given by</th>
				<th scope='col' style='width: 25%;text-align: center;'>Course</th>
				<th scope='col' style='width: 25%;text-align: center;'>Section</th>
				<th scope='col' style='width: 25%;text-align: center;'>Semester</th>
				<th scope='col' style='width: 25%;text-align: center;'>Rating</th>
				<th scope='col' style='width: 25%;text-align: center;'></th>
			</thead>
			<tbody id='table-body'>
			</tbody>
		</table>
	</div>

	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script>
		var tbody = document.getElementById('table-body');
		var new_data = [];
		var new_data2 = new Set();
		var distinct_users = new Set();


		function setWorst(reviews) {
			for (var i = 1; i <= 3; i++) {
				if (i > reviews.length) {
					document.getElementById('course_highest' + (i + 3)).textContent = "N/A";
					document.getElementById('semester_highest' + (i + 3)).textContent = "N/A";
					document.getElementById('comment_highest' + (i + 3)).textContent = "N/A";
					var arr = Array.from(document.getElementsByClassName('rating_highest' + (i + 3)));
					for (var j = 0; j < arr.length; j++) {
						arr[j].setAttribute('class', 'fa-regular fa-star rating_highest' + (i + 3));
					}
					continue;
				}
				document.getElementById('course_highest' + (i + 3)).textContent = reviews[i - 1].course_id;
				document.getElementById('semester_highest' + (i + 3)).textContent = reviews[i - 1].semester;
				document.getElementById('comment_highest' + (i + 3)).textContent = reviews[i - 1].comment;
				var arr = Array.from(document.getElementsByClassName('rating_highest' + (i + 3)));
				for (var j = 0; j < arr.length; j++) {
					if (parseInt(reviews[i - 1].rating) >= j + 1) arr[j].setAttribute('class', 'fa-solid fa-star rating_highest' + (i + 3));
					else arr[j].setAttribute('class', 'fa-regular fa-star rating_highest' + (i + 3));
				}
			}
		}

		function setBest(reviews) {
			for (var i = 1; i <= 3; i++) {
				if (i > reviews.length) {
					console.log("ok");
					document.getElementById('course_highest' + (i)).textContent = "N/A";
					document.getElementById('semester_highest' + (i)).textContent = "N/A";
					document.getElementById('comment_highest' + (i)).textContent = "N/A";
					var arr = Array.from(document.getElementsByClassName('rating_highest' + (i)));
					for (var j = 0; j < arr.length; j++) {
						arr[j].setAttribute('class', 'fa-regular fa-star rating_highest' + (i));
					}
					continue;
				}
				document.getElementById('course_highest' + (i)).textContent = reviews[i - 1].course_id;
				document.getElementById('semester_highest' + (i)).textContent = reviews[i - 1].semester;
				document.getElementById('comment_highest' + (i)).textContent = reviews[i - 1].comment;
				var arr = Array.from(document.getElementsByClassName('rating_highest' + (i)));
				for (var j = 0; j < arr.length; j++) {
					if (parseInt(reviews[i - 1].rating) >= j + 1) arr[j].setAttribute('class', 'fa-solid fa-star rating_highest' + (i));
					else arr[j].setAttribute('class', 'fa-regular fa-star rating_highest' + (i));
				}
			}
		}

		function resetReviews() {
			var worstReview = new_data;
			worstReview = worstReview.sort((a, b) => { return parseInt(a.rating) - parseInt(b.rating) }).slice(0, 3);
			var bestReview = new_data;
			bestReview = bestReview.sort((a, b) => { return -(parseInt(a.rating) - parseInt(b.rating)) }).slice(0, 3);
			setWorst(worstReview);
			setBest(bestReview);
		}

		function create_table() {
			new_data.length = 0;
			new_data2 = new Set();
			distinct_users = new Set();
			for (var key in data) {
				//Create each row
				if (course_id.value != 'All' && data[key].course_id != course_id.value) continue;
				if (sec_id.value != 'All' && data[key].sec_id != sec_id.value) continue;
				if (semester.value != 'All' && data[key].semester != semester.value) continue;
				distinct_users.add(mapper[data[key].feedback_id]);
				new_data.push(data[key]);
				var row = document.createElement('tr');
				row.setAttribute('class', 'item');
				row.innerHTML += `<td>${mapper[data[key].feedback_id]}</td>`;
				row.innerHTML += `<td>${data[key].course_id}</td>`;
				row.innerHTML += `<td>${data[key].sec_id}</td>`;
				row.innerHTML += `<td>${data[key].semester}</td>`;
				row.innerHTML += `<td>${data[key].rating}</td>`;
				row.innerHTML += `<td><form action='specific_feedback.php' method='POST'style='width:100%;'>
		<input type='hidden' value='${mapper[data[key].feedback_id]}' name='User'>
		<button name='feedback'class="btn btn-primary" type="submit" value='${data[key].feedback_id}'>View</button>
		</form></td>`;
				tbody.insertBefore(row, tbody.firstChild);
			}
			for (var key in enrollment_data) {
				if (course_id.value != 'All' && enrollment_data[key].course_id != course_id.value) continue;
				if (sec_id.value != 'All' && enrollment_data[key].sec_id != sec_id.value) continue;
				if (semester.value != 'All' && enrollment_data[key].semester != semester.value) continue;
				new_data2.add(enrollment_data[key].anon_id);
			}
		}
		create_table();
	</script>
	<script>
		var course_id = document.getElementById('course_id');
		var sec_id = document.getElementById('sec_id');
		var semester = document.getElementById('semester');

		function empty(node) {
			while (node.firstChild) {
				node.removeChild(node.lastChild);
			}
		}

		function addOption(value, node) {
			var temp_child = (document.createElement('option'));
			temp_child.setAttribute('value', value);
			temp_child.appendChild(document.createTextNode(value));
			node.appendChild(temp_child);

		}

		function setall(x) {
			empty(x);
			var temp_child = (document.createElement('option'));
			temp_child.setAttribute('value', 'All');
			temp_child.appendChild(document.createTextNode('All'));
			x.appendChild(temp_child);
		}

		function reset() {
			empty(tbody);
			setall(course_id);
			setall(sec_id);
			setall(semester);
			for (var k of courseSet) {
				addOption(k, course_id);
			}
			for (var k of sectionSet) {
				addOption(k, sec_id);
			}
			for (var k of semesterSet) {
				addOption(k, semester);
			}
		}
		reset();
		create_table();

		function addSectionOptions() {
			const initial = sec_id.value;
			empty(sec_id);
			setall(sec_id);
			var set = new Set();
			for (var k in data) {
				var pos = true;
				if (course_id.value == 'All' || data[k].course_id == course_id.value);
				else pos = false;
				if (semester.value == 'All' || data[k].semester == semester.value);
				else pos = false;
				if (pos) set.add(data[k].sec_id);
			}
			for (var k of set) {
				addOption(k, sec_id);
			}
			for (var childs of sec_id.childNodes) {
				if (childs.value == initial) {
					childs.selected = true;
					return;
				}
			}
			sec_id.firstChild.selected = true;
		}

		function addCourseOptions() {
			const initial = course_id.value;
			empty(course_id);
			setall(course_id);
			var set = new Set();
			for (var k in data) {
				var pos = true;
				if (sec_id.value == 'All' || data[k].sec_id == sec_id.value);
				else pos = false;
				if (semester.value == 'All' || data[k].semester == semester.value);
				else pos = false;
				if (pos) set.add(data[k].course_id);
			}
			for (var k of set) {
				addOption(k, course_id);
			}
			for (var childs of course_id.childNodes) {
				if (childs.value == initial) {
					childs.selected = true;
					return;
				}
			}
			course_id.firstChild.selected = true;
		}

		function addSemesterOptions() {
			const initial = semester.value;
			empty(semester);
			setall(semester);
			var set = new Set();
			for (var k in data) {
				var pos = true;
				if (sec_id.value == 'All' || data[k].sec_id == sec_id.value);
				else pos = false;
				if (course_id.value == 'All' || data[k].course_id == course_id.value);
				else pos = false;
				if (pos) set.add(data[k].semester);
			}
			for (var k of set) {
				addOption(k, semester);
			}
			for (var childs of semester.childNodes) {
				if (childs.value == initial) {
					childs.selected = true;
					return;
				}
			}
			semester.firstChild.selected = true;
		}

		for (var k1 of ['change', 'click']) {
			for (var k2 of [semester, sec_id, course_id]) {
				k2.addEventListener(k1, () => {
					empty(tbody);
					addCourseOptions();
					addSectionOptions();
					addSemesterOptions();
					create_table();
				})
			}
		}

		var ratings = new Map();
		var evaluations = new Map();
		var exams = new Map();
		var assignment = new Map();
		let canvas1 = document.getElementById('myChart1');
		let canvas2 = document.getElementById('myChart2');
		let canvas3 = document.getElementById('myChart3');
		let canvas4 = document.getElementById('myChart4');
		let canvas5 = document.getElementById('myChart5');
		let canvas6 = document.getElementById('myChart6');
		var myChart1 = null,
			myChart2 = null,
			myChart3 = null,
			myChart4 = null;

		//function for sum
		const calculateSum = (arr) => {
			return arr.reduce((total, current) => {
				return total + current;
			}, 0);
		}

		function inc(a, b) {
			if (!a.has(b)) a.set(b, 1);
			else a.set(b, a.get(b) + 1);
		}

		var eval_map = new Map();
		var exam_map = new Map();
		eval_map.set('1', 'Too few');
		eval_map.set('2', 'Can add more');
		eval_map.set('3', 'Ok');
		eval_map.set('4', 'Reduce a bit');
		eval_map.set('5', 'Too many');
		exam_map.set('1', 'Easy');
		exam_map.set('2', 'Moderate');
		exam_map.set('3', 'Hard');

		function recreate() {
			ratings = new Map();
			evaluations = new Map();
			exams = new Map();
			assignment = new Map();
			for (var k in new_data) {
				inc(ratings, new_data[k].rating);
				inc(evaluations, new_data[k]['lab evaluations']);
				inc(exams, new_data[k].exams);
				inc(assignment, new_data[k].assignments);
			}
			for (var k of [{
				canvas: canvas1,
				map: ratings,
				label: 'Ratings',
				id: '1'
			}, {
				canvas: canvas2,
				map: evaluations,
				label: 'Opinion about lab evaluations',
				id: '2'
			}, {
				canvas: canvas3,
				map: exams,
				label: 'Opinion about exams',
				id: '3'
			}, {
				canvas: canvas4,
				map: assignment,
				label: 'Opinion about assignment',
				id: '4'
			}]) {
				if (k.canvas) {
					document.getElementById('myChart' + k.id).remove();
					k.canvas = document.createElement('canvas');
					k.canvas.setAttribute('id', 'myChart' + k.id);
					document.getElementById('div' + k.id).appendChild(k.canvas);
				}
				var ctx = k.canvas.getContext('2d');
				var labels = [];
				if (k.id == '2' || k.id == '4') {
					for (var i of ['Too few', 'Can add more', 'Ok', 'Reduce a bit', 'Too many']) {
						labels.push(i);
					}
				} else if (k.id == '3') {
					for (var i of ['Easy', 'Moderate', 'Hard']) {
						labels.push(i);
					}
				} else {
					for (var i of ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']) {
						labels.push(i);
					}
				}
				var new_datas = {};
				if (k.id == '1') new_datas = Object.fromEntries(k.map);
				else if (k.id == '3') Object.entries(Object.fromEntries(k.map)).map(([o_key, o_val]) => {
					new_datas[exam_map.get(o_key)] = o_val
				});
				else Object.entries(Object.fromEntries(k.map)).map(([o_key, o_val]) => {
					new_datas[eval_map.get(o_key)] = o_val
				});
				new Chart(ctx, {
					type: 'bar',
					data: {
						labels: labels,
						datasets: [{
							label: k.label,
							data: new_datas
						},],
					}
				})
			}
			for (var k of [{
				canvas: canvas5,
				label: 'Use Statistics',
				id: '5'
			}]) {
				if (k.canvas) {
					document.getElementById('myChart' + k.id).remove();
					k.canvas = document.createElement('canvas');
					k.canvas.setAttribute('id', 'myChart' + k.id);
					//k.canvas.setAttribute('style', 'width:80%');
					document.getElementById('div' + k.id).appendChild(k.canvas);
				}
				var ctx = k.canvas.getContext('2d');
				var labels = ['Given Feedback', 'Not Given'];
				new Chart(ctx, {
					type: 'doughnut',
					data: {
						labels: labels,
						datasets: [{
							data: [distinct_users.size, new_data2.size - distinct_users.size],
							backgroundColor: [
								'rgb(255, 99, 132)',
								'rgb(54, 162, 235)',
							],
							hoverOffset: 4
						}]
					},
					options: {
						responsive: false
					}
				})
			}
			for (var k of [{
				canvas: canvas6,
				map: ratings,
				id: '6'
			}]) {
				if (k.canvas) {
					document.getElementById('myChart' + k.id).remove();
					k.canvas = document.createElement('canvas');
					k.canvas.setAttribute('id', 'myChart' + k.id);
					document.getElementById('div' + k.id).appendChild(k.canvas);
				}
				var ctx = k.canvas.getContext('2d');
				var labels = ['Highest', 'Median', 'Average', 'Lowest'];
				var ans = [0, 0, 0, 0];
				var arr = [];
				for (var [key, value] of ratings) {
					for (var k1 = 0; k1 < value; k1++) {
						arr.push(parseInt(key));
					}
				}
				if (arr.length) {
					ans[0] = math.max(arr);
					ans[3] = math.min(arr);
					ans[1] = math.median(arr);
					ans[2] = math.mean(arr);
				}
				new Chart(ctx, {
					type: 'line',
					data: {
						labels: labels,
						datasets: [{
							label: 'Ratings Statistics',
							data: ans,
							fill: false,
							borderColor: 'rgb(75, 192, 192)',
							tension: 0.1
						}]
					},
					options: {
						responsive: true,
						scales: {
							y: {
								beginAtZero: true,
								max: 11
							}
						}
					}
				})
				k.canvas.setAttribute('style', 'height:300px');
			}
			resetReviews();
		}
		for (var k1 of ['change', 'click']) {
			for (var k2 of [semester, sec_id, course_id]) {
				k2.addEventListener(k1, () => {
					empty(tbody);
					addCourseOptions();
					addSectionOptions();
					addSemesterOptions();
					create_table();
					recreate();
				})
			}
		}
		document.getElementById('reset').addEventListener('click', () => {
			reset();
			create_table();
			recreate();
		});
		document.getElementById('semester').click();
		window.addEventListener('slid.bs.carousel', () => { recreate() });
	</script>
	<footer class="text-center text-white bg-primary">
		<h6 class="text-uppercase fw-bold py-4 text-center">Contact</h6>
		<div class="container-fluid text-center d-block">
			<p><i class="fas fa-home me-1 text-white"></i>Indian Institute of Information Technology, Allahabad</p>
			<p><i class="fas fa-envelope me-1 text-white"></i>contact@iiita.ac.in</p>
			<p><i class="fas fa-phone me-1 text-white"></i>+91 5322 922000</p>
		</div>
		<div class="text-center py-4">
			© 2023 Copyright: <a class="text-reset fw-bold" href="../../../index.php">Group-1</a>
		</div>
	</footer>
	<script src="https://kit.fontawesome.com/10950362e3.js" crossorigin="anonymous"></script>
	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
		crossorigin="anonymous"></script>
	<script>
		if (data.length == 0) {
			document.getElementById('feedbackTable').remove();
			let noFeedback = document.createElement('h1');
			document.getElementById('top').setAttribute('class', 'text-center justify-content-center');
			console.log(noFeedback);
			noFeedback.appendChild(document.createTextNode('No feedback Submitted Yet'));
			document.getElementById('top').appendChild(noFeedback);
		}
	</script>

	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<!--
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	-->
</body>

</html>