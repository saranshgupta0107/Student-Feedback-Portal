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

  <title>Lost Password</title>
</head>


<body onload="clearAll()">
<?php
  session_start();
  if (!(isset($_SESSION['otp']) && ($_SESSION['sentmail']==TRUE))) {
    session_unset();
    session_destroy();
    echo "
        <script>
        function logout() {
            alert('You are not authorized to view this page!');
            window.location.replace('../../');
        };
        logout();
        </script>";
  }
  $_SESSION['sentmail']=FALSE;
  ?>
   <div class="container-fluid fixed-top" style="margin:0;padding:0;">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
      <div class="container-fluid">
        <a class="navbar-brand" href="../../"><img src="../../images/iiita_logo.png" alt="IIITA" width="60vw" height=auto class="align-text-middle" style='display:block;margin: 0 auto;max-width: 100%;'></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active text-success" aria-current="page" href="../../" style="font-size:1.5rem;text-align:center">Welcome to Student Feedback Portal</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <nav class="bg-white py-1" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" style="text-decoration: none;"><a href="../../">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Lost Password</li>
    </ol>
    </nav>
  </div>
  <div id="login" style="margin-top:150px">
    <div class="newform">
      <form name="f1" action="../../php/student/verifyotp.php" onsubmit="return validation()" method="post" style="display:grid;width: 350px;" id="FORM">
        <div class="mb-3">
          <label for="otp" class="form-label">OTP</label>
          <input name="otp" class="form-control" id="otp" aria-describedby="otpHelp" placeholder="Your One time password" required>
          <div id="otpHelp" class="form-text"><span id="timer"></span></div>
          <div id="otpHelp" class="form-text">Please don't refresh the page!</div>
        </div>
        <button id="submitbtn" type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <script>
      function validation() {
        var id = document.f1.exampleInputEmail1;
        if (id.length == "" ) {
          alert("User fields are empty");
          return false;
        }
      }
    </script>
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
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script>
    function clearAll() {
      document.getElementById("exampleInputEmail1").value = "";
      document.getElementById("exampleInputPassword1").value = "";
    }
  </script>
  <script type="module" src="../../js/timer.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>