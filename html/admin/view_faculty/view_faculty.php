<!doctype html>
<html lang="en">

<head>
  <link rel="icon" href="../../../images/iiita_logo.png">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../../css/style.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Edit Faculty</title>
</head>
<body onload="clearAll()">
  <?php
  session_start();
  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800*6)) {
    session_unset();
    session_destroy();
    echo "
        <script>
        function logout() {
            alert('You have been logged in for more than 3 hours, Timeout!');
            window.location.replace('../../../');
        };
        logout();
        </script>";
  }
  ?>
  <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'admin') {
    session_unset();
    session_destroy();
    echo "<script> alert('You are not authorised to this page'); window.location.replace('../../../')</script>";
  }
  ?>
  <div class="container-fluid fixed-top" style="margin:0;padding:0;">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
      <div class="container-fluid">
        <a class="navbar-brand" href="../../"><img src="../../../images/iiita_logo.png" alt="IIITA" width="60vw" height=auto class="align-text-middle" style='display:block;margin: 0 auto;max-width: 100%;'></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active text-success" aria-current="page" href="../../" style="font-size:1.5rem;text-align:center">Welcome to Student Feedback Portal</a>
            </li>
          </ul>
          <form class="d-flex">
            <a href="../../../php/logout.php"><button class="btn btn-outline-primary" id="liveAlertn" type="button">Log Out</button></a>
          </form>
        </div>
      </div>
    </nav>
    <nav class="bg-white py-1" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" style="text-decoration: none;"><a href="../../../">Home</a></li>
      <li class="breadcrumb-item" style="text-decoration: none;"><a href="../login_admin.php">Log In</a></li>
      <li class="breadcrumb-item" style="text-decoration: none;"><a href="../">Admin</a></li>
      <li class="breadcrumb-item" style="text-decoration: none;"" aria-current=" page"><a href="../view_faculty/">View Faculty</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit
        <?php require('../../../php/connection.php');
        try{
          $email = array_values($_POST)[0];
          setcookie('Teacher', $email, time() + 60 * 5);
          $email = stripcslashes($email);
          $email = mysqli_real_escape_string($con, $email);
          $sql = "select name from p1_instructor where id='" . $email . "';";
          $result = mysqli_query($con, $sql);
          $row = $result->fetch_row();
          echo $row[0];
         }catch(Exception $e){
            echo "<script>alert('There has been some error on this page, please contact administrator!');window.location.replace('../');</script>";
          } ?>
      </li>
    </ol>
  </nav>
  </div>
  <div id="top" class='table-responsive' style="margin-top:200px">
    <script>
      function show_alert() {
        if (!confirm("Do you really want to do this?")) {
          return false;
        }
        this.form.submit();
      }
    </script>
    <?php
    require('../../../php/connection.php');
    try{
      $email = array_values($_POST)[0];
      $email = stripcslashes($email);
      $email = mysqli_real_escape_string($con, $email);
      $sql = "select sec_id,semester,course_id from p1_teaches where id='" . $email . "';";
      $result = $con->query($sql);
    }
    catch(Exception $e){
      echo "<script>alert('There has been some error on this page, please contact administrator!');window.location.replace('../');</script>";
    }
    echo "<table class='table'>";
    echo "<thead class='p-3 mb-2 bg-primary text-white'>";
    echo ("<th scope='col' style='width: 25%;text-align: center;'>Section</th>");
    echo ("<th scope='col' style='width: 25%;text-align: center;'>Course</th>");
    echo ("<th scope='col' style='width: 25%;text-align: center;'>Semester</th>");
    echo ("<th scope='col' style='width: 25%;text-align: center;'></th>");
    echo "<th></th>";
    echo "</thead>";
    echo "<tbody>";
    if ($result->num_rows > 0) {
      foreach ($result as $row => $val) {
        echo "<form action='../../../php/admin/view_faculty/faculty_section_drop.php' method='POST' style='width:100%;' onsubmit='return show_alert(this);'>";
        echo "<input type='hidden' name='course_id' value='" . $val['course_id'] . "' style='display:none'></input>";
        echo "<input type='hidden' name='sec_id' value='" . $val['sec_id'] . "' style='display:none'></input>";
        echo "<input type='hidden' name='semester' value='" . $val['semester'] . "' style='display:none'></input>";
        echo "<input type='hidden' name='id' value='" . $email . "' style='display:none'></input>";
        echo "<tr>";
        echo "<td>" . $val['sec_id'] . "</td>";
        echo "<td>" . $val['course_id'] . "</td>";
        echo "<td>" . $val['semester'] . "</td>";
        echo "<td><button class='btn btn-primary' type='submit'>Drop</button></td>";
        echo "</tr>";
        echo "</form>";
      }
    }
    echo "<form action='allot_section.php' method='POST'style='width:100%;'>";
    echo "<tr><td></td><td></td><td></td><td><button name='x' class='btn btn-primary' type='submit' >Allot a section+</button></td></tr>";
    echo "</form>";
    echo "</tbody>";
    echo "</table>";
    $con->close();
    ?>
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
</body>

</html>