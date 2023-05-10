<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">

  <link rel="shortcut icon" href="images/iiita_logo.png" type="image/x-icon">
  <title>Student Feedback Portal</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<script src='js/index.js'></script>
<script>
  $("#navbar a:not(.dropdown-toggle)").click(function() {
    $("#navbar").collapse("hide");
  });
</script>

<body>
  <?php
  session_start();
  session_destroy();
  $_SESSION = array();
  ?>
  <div class="container-fluid fixed-top" style="margin:0;padding:0;">
    <nav id="goback" class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
      <div class="container-fluid">
        <a class="navbar-brand" href="./index.php"><img src="./images/iiita_logo.png" alt="IIITA" width="60vw" height=auto class="align-text-middle" style='display:block;margin: 0 auto;max-width: 100%;'></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active text-success" aria-current="page" href="./index.php" style="font-size:1.5rem;text-align:center">Welcome to Student Feedback Portal</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <nav class="bg-white py-1" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" style="text-decoration: none;"><a href="./">Home</a></li>
      </ol>
    </nav>
  </div>
  <div id="top" style="margin-top:200px;">
    <div class="jumbotron">
      <h2 class="display-4">Hello, IIIT Allahabad!</h2>
      <p class="lead">This is the student feedback portal, designed to collect the feedbacks from the students regarding
        the courses they are enrolled in.</p>
      <hr class="my-4">
      <p>In order to continue, you must choose your role by clicking on the button below.</p>
      <button type="button" class="btn btn-primary" id="liveAlertBtn" onclick="window.location.href='#group'">Choose
        Your Role to continue</button>
    </div>
  </div>
  <!-- <div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/iiita_buil3.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="images/iiita_buil3.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="images/iiita_buil3.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div> -->
  <div id="group">
    <div id="liveAlertPlaceholder"></div>
    <div id="choose" class="btn-group-vertical">
      <button type="button" class="btn btn-outline-primary" onclick="window.location.href='html/admin/login_admin.php'">Admin</button>
      <button type="button" class="btn btn-outline-primary" onclick="window.location.href='html/faculty/login.php'">Faculty</button>
      <button type="button" class="btn btn-outline-primary" onclick="window.location.href='html/student/login_student.php'">Student</button>
    </div>
  </div>
  <footer class="text-center text-white bg-primary">
        <h6 class="text-uppercase fw-bold py-4 text-center">Contact</h6>
        <div class="container-fluid text-center d-block">
            <p><i class="fas fa-home me-1 text-white"></i>Indian Institute of Information Technology, Allahabad</p>
            <p><i class="fas fa-envelope me-1 text-white"></i>contact@iiita.ac.in</p>
        <p><i class="fas fa-phone me-1 text-white"></i>+91 5322 922000</p>
        </div>
        <div class="text-center py-4">
            © 2023 Copyright: <a class="text-reset fw-bold" href="../../index.php">Group-1</a>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/10950362e3.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>

</html>