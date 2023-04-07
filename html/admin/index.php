<!doctype html>
<html lang="en">

<head>
  <link rel="icon" href="../../images/iiita_logo.png">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../css/style.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Admin Dashboard</title>
</head>

<body>
  <?php
  session_start();
  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
  }
  ?>
  <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'admin') : echo "<script> alert('You are not authorised to this page'); window.location.replace('../../')</script>";
  endif; ?>
  <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <a class="navbar-brand" href="../../"><img src="../../images/iiita_logo.png" alt="" width="100px" height="100px" class="d-inline-block align-text-middle"></a>
      <div class="new">
        <a class="navbar-text">
          Welcome to Student Feedback Portal
        </a>
      </div>
      <a href="../../php/logout.php"><button type="button" class="btn btn-primary" id="liveAlertn" style="margin-bottom: 1%;margin-left: -20%;">Logout</button></a>
    </div>
  </nav>
  <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" style="text-decoration: none;"><a href="../../">Home</a></li>
      <li class="breadcrumb-item" style="text-decoration: none;"><a href="login_admin.php">Log In</a></li>
      <li class="breadcrumb-item active" aria-current="page">Admin</li>
    </ol>
  </nav>
  <div id="top">
    <div class="jumbotron">
      <h2 class="display-4">Hello, IIIT Admin!</h2>
      <p class="lead">This is the student feedback portal, designed to collect the feedbacks from the students regarding
        the courses they are enrolled in.</p>
      <hr class="my-4">
      <p>You can view feedback, delete feedback or add any new user to the system.</p>
      <button type="button" class="btn btn-primary" id="liveAlertBtn" onclick="window.location.href='#group'">Choose
        Your Action</button>
    </div>
  </div>
  <div id="group">
    <div class="card-group" style="padding: 10%; background-color: rgba(0, 0, 0, 0.558);">
      <div class="row mt-4">
        <div class="col">
          <div class="card">
            <img src="https://source.unsplash.com/1400x700/?view" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">View Faculty</h5>
              <p class="card-text">View the faculty.</p>
              <a class="btn btn-primary" href="view_faculty/" role="button">View Faculty</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <img src="https://source.unsplash.com/1400x700/?teacher" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Add Section</h5>
              <p class="card-text">Add Section for a subject</p>
              <a class="btn btn-primary" href="" role="button">Add Section</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col">
          <div class="card">
            <img src="https://source.unsplash.com/1400x700/?education,technology" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Drop/Add Students</h5>
              <p class="card-text">Change the students</p>
              <a class="btn btn-primary" href="drop_add_student/" role="button">Drop/Add</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <img src="https://source.unsplash.com/1400x700/?view" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">View Feedback</h5>
              <p class="card-text">View the feedback.</p>
              <a class="btn btn-primary" href="view_feedback/" role="button">View Feedback</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>