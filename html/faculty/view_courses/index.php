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

</head>

<body>
	<script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
	<?php
require '../../../php/gen_id.php';
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
				<li class="breadcrumb-item active" aria-current="page">View Courses</li>
			</ol>
		</nav>
	</div>
<?php
require_once '../../../php/connection.php';
try {
    $sql = "select * from p1_teaches where id='" . $_SESSION['id'] . "';";
    $result = $con->query($sql);
    $arr = [];
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        array_push($arr, $row);
    }
    $var = json_encode($arr);
    echo "<script>var data=$var;</script>";
} catch (Exception $e) {
    echo "<script>alert('There has been some error on this page, please contact administrator!');window.location.replace('../');</script>";
}
?>
<div id="top" class='table-responsive' style="margin-top:175px">
    <table class='table' id='feedbackTable'>
        <thead class='p-3 mb-2 bg-primary text-white'>
            <tr>
                <th scope='col' style='width: 25%;text-align: center;'>Course</th>
                <th scope='col' style='width: 25%;text-align: center;'>Section</th>
                <th scope='col' style='width: 25%;text-align: center;'>Semester</th>
                <th scope='col' style='width: 25%;text-align: center;'>Status</th>
            </tr>
        </thead>
    </table>
</div>

<script>
    var table = document.getElementById('feedbackTable');
    function create_table() {
        for (var key in data) {
            // Create each row
            var row = document.createElement('tr');
            row.setAttribute('class', 'item');
            row.innerHTML += `<td>${data[key].course_id}</td>`;
            row.innerHTML += `<td>${data[key].sec_id}</td>`;
            row.innerHTML += `<td>${data[key].semester}</td>`;
			if(data[key].freeze==1)
			{
				            row.innerHTML += `<td>
                    <button name='feedback' class="btn btn-primary" disabled=true style="padding-left: 15px;padding-right: 15px;">Frozen</button>
            </td>`;
			}
			else{
            row.innerHTML += `<td>
                <form action='../../../php/faculty/view_courses/freeze_course.php' method='POST' style='width:100%;'>
                    <input type='hidden' value='${data[key].semester}' name='semester'>
                    <input type='hidden' value='${data[key].course_id}' name='course_id'>
                    <input type='hidden' value='${data[key].sec_id}' name='sec_id'>
                    <button name='feedback' onclick='confirmFreeze();' class="btn btn-primary" type="submit" >Freeze</button>
                </form>
            </td>`;
			}
            table.appendChild(row);
			console.log(data[key].freeze==1);
        }
    }
    create_table();
	function confirmFreeze() {
  var confirmation = confirm("Are you sure you want to freeze?");
  if (!confirmation) {
	event.preventDefault();
  }
}
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
			noFeedback.appendChild(document.createTextNode('No courses added Yet'));
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