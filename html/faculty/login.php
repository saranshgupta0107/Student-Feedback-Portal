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

  <title>Faculty Log In</title>
</head>


<body onload="clearAll()">
  <?php require '../../php/clear_session.php'; ?>
  <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <a class="navbar-brand" href="../../"><img src="../../images/iiita_logo.png" alt="iiita_logo" width="100px" height="100px" class="d-inline-block align-text-middle"></a>
      <div class="new">
        <a class="navbar-text">
          Welcome to Student Feedback Portal
        </a>
      </div>
    </div>
  </nav>
  <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" style="text-decoration: none;"><a href="../../">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Faculty Log In</li>
    </ol>
  </nav>
  <div id="login">
    <div class="newform">
      <form name="f1" action="../../php/faculty/authentication.php" onsubmit="return validation()" method="post" style="display:grid;width: 350px;" id="FORM">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email@iiita.ac.in" pattern="[a-z]+@iiita.ac.in" required>
          <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" name="pass" class="form-control" id="exampleInputPassword1" pattern="\w{8,20}" required>
          <div id="passwordHelp" class="form-text" id="passwordHelpInline">
            Must be 8-20 characters long.
          </div>
          <div id="passwordHelp" class="form-text" id="passwordHelpInline">
          <a href="lostpass.php">Lost Password? Click Here.</a>
          </div>
        </div>
        <button id="submitbtn" type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <script>
      function validation() {
        var id = document.f1.exampleInputEmail1;
        var ps = document.f1.exampleInputPassword1;
        if (id.length == "" && ps.length == "") {
          alert("User fields are empty");
          return false;
        }
      }
    </script>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script>
    function clearAll() {
      document.getElementById("exampleInputEmail1").value = "";
      document.getElementById("exampleInputPassword1").value = "";
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>