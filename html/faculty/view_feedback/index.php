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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Student Dashboard</title>
</head>

<body>
    <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
    <?php
    require('../../../php/gen_id.php');
    session_start();
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        session_unset();
        session_destroy();
        erase_cookies();
        echo "
        <script>
        function logout() {
            alert('You have been logged in for more than 30 minutes, Timeout!');
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
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <a class="navbar-brand" href="../../index.html"><img src="../../../images/iiita_logo.png" alt="" width="100px" height="100px" class="d-inline-block align-text-middle"></a>
      <div class="new">
        <a class="navbar-text">
          Welcome to Student Feedback Portal
        </a>
      </div>
      <a href="../../../php/logout.php"><button type="button" class="btn btn-primary" id="liveAlertn" style="margin-bottom: 1%;margin-left: -20%;">Logout</button></a>
    </div>
  </nav>
  <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" style="text-decoration: none;"><a href="../../../">Home</a></li>
      <li class="breadcrumb-item" style="text-decoration: none;"><a href="login_student.php">Log In</a></li>
      <li class="breadcrumb-item" style="text-decoration: none;"><a href="../">Faculty</a></li>
      <li class="breadcrumb-item active" aria-current="page">View Feedback</li>
    </ol>
  </nav>
  <div style='display:flex;align-items:center;justify-content: center;' class="container-sm">
    <select class="form-select form-select-md" id='course_id' name='course_id' aria-label=".form-select-sm example" style='width:15%;'>
      <option selected disabled>Select Course</option>
    </select>
    <select class="form-select form-select-md" id='sec_id' name='sec_id' aria-label=".form-select-sm example" style='width:15%;'>
      <option selected disabled>Select Section</option>
    </select>
    <select class="form-select form-select-md" id='semester' name='semester' aria-label=".form-select-sm example" style='width:15%;'>
      <option selected disabled>Select Semester</option>
    </select>
    <button id='reset' class='btn btn-primary'>Reset</button>
  </div>
  <?php
  require_once('../../../php/connection.php');
  $sql = "select * from feedback natural join (select * from teaches where id='".$_SESSION['id']."') e1;";
  $result = $con->query($sql);
  $arr = [];
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    array_push($arr, $row);
  }
  $var = json_encode($arr);
  echo "<script>var data=$var;</script>";
  $sql = "select distinct(course_id) from teaches where id='".$_SESSION['id']."';";
  $result = $con->query($sql);
  $arr = [];
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    array_push($arr, $row);
  }
  $var = json_encode($arr);
  echo "<script>var course_data=$var;</script>";
  $sql = "select * from gives;";
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
  ?>
  <div id="top" class='table-responsive '>
    <table class='table sortable'>
      <thead class='p-3 mb-2 bg-primary text-white'>
        <th scope='col' style='width: 25%;text-align: center;'>Given by</th>
        <th scope='col' style='width: 25%;text-align: center;'>Course</th>
        <th scope='col' style='width: 25%;text-align: center;'>Section</th>
        <th scope='col' style='width: 25%;text-align: center;'>Semester</th>
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

    function create_table(course, sec, semester) {
      for (var key in data) {
        //Create each row
        if (course && data[key].course_id != course) continue;
        if (sec && data[key].sec_id != sec) continue;
        if (semester && data[key].semester != semester) continue;
        var row = document.createElement('tr');
        row.setAttribute('class', 'item');
        row.innerHTML += `<td>${mapper[data[key].feedback_id]}</td>`;
        row.innerHTML += `<td>${data[key].course_id}</td>`;
        row.innerHTML += `<td>${data[key].sec_id}</td>`;
        row.innerHTML += `<td>${data[key].semester}</td>`;
        row.innerHTML += `<td><form action='specific_feedback.php' method='POST'style='width:100%;'>
        <input type='hidden' value='${mapper[data[key].feedback_id]}' name='User'>
        <button name='feedback'class="btn btn-primary" type="submit" value='${data[key].feedback_id}'>View</button>
        </form></td>`;
        tbody.insertBefore(row, tbody.firstChild);
      }
    }
    create_table();
  </script>
  <script>
    var course_id = document.getElementById('course_id');
    var sec_id = document.getElementById('sec_id');
    var semester = document.getElementById('semester');
    for (var key in course_data) {
      var temp_child = (document.createElement('option'));
      temp_child.setAttribute('value', course_data[key].course_id);
      temp_child.setAttribute('selected', false);
      temp_child.appendChild(document.createTextNode(course_data[key].course_id));
      course_id.appendChild(temp_child);
    }

    function empty(node) {
      while (node.firstChild) {
        node.removeChild(node.lastChild);
      }
    }
    course_id.addEventListener('change', () => {
      empty(sec_id);
      empty(semester);
      var set = new Set();
      for (var key in data) {
        if (data[key].course_id == course_id.options[course_id.selectedIndex].text) {
          if (set.has(data[key].sec_id)) continue;
          else set.add(data[key].sec_id);
          var temp_child = (document.createElement('option'));
          temp_child.setAttribute('value', data[key].sec_id);
          temp_child.appendChild(document.createTextNode(data[key].sec_id));
          sec_id.appendChild(temp_child);
        }
      }
      empty(tbody);
      create_table(course_id.value);
    })
    sec_id.addEventListener('change', () => {
      empty(semester);
      var set = new Set();
      for (var key in data) {
        if (data[key].course_id == course_id.options[course_id.selectedIndex].text &&
          data[key].sec_id == sec_id.options[sec_id.selectedIndex].text) {
          if (set.has(data[key].semester)) continue;
          else set.add(data[key].semester);
          var temp_child = (document.createElement('option'));
          temp_child.setAttribute('value', data[key].semester);
          temp_child.appendChild(document.createTextNode(data[key].semester));
          semester.appendChild(temp_child);
        }
      }
      empty(tbody);
      create_table(course_id.value,sec_id.value);
    })
    course_id.addEventListener('click', () => {
      empty(sec_id);
      empty(semester);
      var set = new Set();
      for (var key in data) {
        if (data[key].course_id == course_id.options[course_id.selectedIndex].text) {
          if (set.has(data[key].sec_id)) continue;
          else set.add(data[key].sec_id);
          var temp_child = (document.createElement('option'));
          temp_child.setAttribute('value', data[key].sec_id);
          temp_child.appendChild(document.createTextNode(data[key].sec_id));
          sec_id.appendChild(temp_child);
        }
      }
      empty(tbody);
      create_table(course_id.value);
    })
    sec_id.addEventListener('click', () => {
      empty(semester);
      var set = new Set();
      for (var key in data) {
        if (data[key].course_id == course_id.options[course_id.selectedIndex].text &&
          data[key].sec_id == sec_id.options[sec_id.selectedIndex].text) {
          if (set.has(data[key].semester)) continue;
          else set.add(data[key].semester);
          var temp_child = (document.createElement('option'));
          temp_child.setAttribute('value', data[key].semester);
          temp_child.appendChild(document.createTextNode(data[key].semester));
          semester.appendChild(temp_child);
        }
      }
      empty(tbody);
      create_table(course_id.value,sec_id.value);
    })
    semester.addEventListener('change', () => {
      if (!semester.value || semester.value == 'Select Semester') return;
      empty(tbody);
      create_table(course_id.value, sec_id.value, semester.value);
    })
    semester.addEventListener('click', () => {
      if (!semester.value || semester.value == 'Select Semester') return;
      empty(tbody);
      create_table(course_id.value, sec_id.value, semester.value);
    })
    document.getElementById('reset').addEventListener('click', () => {
      empty(tbody);
      empty(sec_id);
      empty(semester);
      create_table();
    });
  </script>
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