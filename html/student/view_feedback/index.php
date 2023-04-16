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

  <title>Show Faculty</title>
</head>

<body>
  <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
  <?php
  session_start();
  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
    echo "
        <script>
        function logout() {
            alert('You have been logged in for more than 30 minutes, Timeout!');
            window.location.replace('http://localhost/DBMS-Project/');
        };
        logout();
        </script>";
  }
  ?>
  <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'student') : echo "<script> alert('You are not authorised to this page'); window.location.replace('../../')</script>";
  endif; ?>
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
      <li class="breadcrumb-item" style="text-decoration: none;"><a href="../">Student</a></li>
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
  $sql = "select * from feedback natural join (select feedback_id from gives where anon_id ='" . $_SESSION['username'] . "') e1;";
  $result = $con->query($sql);
  $arr = [];
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    array_push($arr, $row);
  }
  $var = json_encode($arr);
  echo "<script>var data=$var;</script>";
  $sql =
    "select course_id,sec_id,semester from feedback natural join (select feedback_id from gives where anon_id ='" . $_SESSION['username'] . "') e1;";
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
  ?>
  <div id="top" class='table-responsive '>
    <table class='table sortable'>
      <thead class='p-3 mb-2 bg-primary text-white'>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script>
    var tbody = document.getElementById('table-body');
    var course_id = document.getElementById('course_id');
    var sec_id = document.getElementById('sec_id');
    var semester = document.getElementById('semester');

    function create_table() {
      for (var key in data) {
        //Create each row
        if (course_id.value != 'All' && data[key].course_id != course_id.value) continue;
        if (sec_id.value != 'All' && data[key].sec_id != sec_id.value) continue;
        if (semester.value != 'All' && data[key].semester != semester.value) continue;
        var row = document.createElement('tr');
        row.setAttribute('class', 'item');
        row.innerHTML += `<td>${data[key].course_id}</td>`;
        row.innerHTML += `<td>${data[key].sec_id}</td>`;
        row.innerHTML += `<td>${data[key].semester}</td>`;
        row.innerHTML += `<td><form action='specific_feedback.php' method='POST'style='width:100%;'><button name='feedback'class="btn btn-primary" type="submit"  value='${data[key].feedback_id}'>Edit</button></form></td>`;
        tbody.insertBefore(row, tbody.firstChild);
      }
    }
    create_table();
  </script>
  <script>
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
    document.getElementById('reset').addEventListener('click', () => {
      reset();
      create_table();
    });
  </script>
  <!-- Example split danger button -->
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