<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
<<<<<<< HEAD:index.html
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="images/iiita_logo.png" alt="" width="60" height="60"
        class="d-inline-block align-text-middle"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#top" style="font-size: larger;">Student Feedback Portal</a>
          </li>
          <li class="nav-item dropdown" style="align-items: end;">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Choose Your Action
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../html/admin/login_admin.html">Admin</a></li>
              <li><a class="dropdown-item" href="../html/faculty/login_faculty.html">Faculty</a></li>
              <li><a class="dropdown-item" href="../html/student/login_student.html">Student</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex" role="submit">
          <button class="btn btn-outline-primary" type="submit">Log In</button>
        </form>
      </div>
    </div>
  </nav>
  <!-- <nav id="goback" class="navbar navbar-light" style="background-color: #e3f2fd;">
=======
  <?php   
    session_start();
    session_destroy();
    $_SESSION = array();
  ?>
  <nav id="goback" class="navbar navbar-light" style="background-color: #e3f2fd;">
>>>>>>> 0752287b225aed681c3d884bebd76d0f12a40db5:index.php
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="images/iiita_logo.png" alt="" width="100" height="100"
          class="d-inline-block align-text-middle"></a>
      <div class="new">
        <a class="navbar-text">
          Welcome to Student Feedback Portal
        </a>
      </div>
    </div>
  </nav> -->
  <div id="top">
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
  <div id="carouselExampleIndicators" class="carousel slide">
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
        <img src="https://source.unsplash.com/1400x700/?feedback,technology" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://source.unsplash.com/1400x700/?education,technology" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://source.unsplash.com/1400x700/?programming,technology" class="d-block w-100" alt="...">
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
  </div>

  <div id="group">
    <div id="liveAlertPlaceholder"></div>
    <div id="choose" class="btn-group-vertical">
      <button type="button" class="btn btn-outline-primary"
        onclick="window.location.href='html/admin/login_admin.html'">Admin</button>
      <button type="button" class="btn btn-outline-primary"
        onclick="window.location.href='html/faculty/login_faculty.html'">Faculty</button>
      <button type="button" class="btn btn-outline-primary"
        onclick="window.location.href='html/student/login_student.html'">Student</button>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
    crossorigin="anonymous"></script>

</body>

</html>