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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.js" integrity="sha512-VW8/i4IZkHxdD8OlqNdF7fGn3ba0+lYqag+Uy4cG6BtJ/LIr8t23s/vls70pQ41UasHH0tL57GQfKDApqc9izA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <title>Student Dashboard</title>
  <!--<style>
    .carousel .carousel-item {
        transition-duration: 0s;
    }
    </style>-->
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
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
  session_unset();
  session_destroy();
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

  <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'admin') {
  session_unset();
  session_destroy();
  echo "<script> alert('You are not authorised to this page'); window.location.replace('../../../')</script>";
}
?>
  <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <a class="navbar-brand" href="../../../"><img src="../../../images/iiita_logo.png" alt="" width="100px" height="100px" class="d-inline-block align-text-middle"></a>
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
      <li class="breadcrumb-item" style="text-decoration: none;"><a href="../login_admin.php">Log In</a></li>
      <li class="breadcrumb-item" style="text-decoration: none;"><a href="../">Admin</a></li>
      <li class="breadcrumb-item active" aria-current="page">View Feedback</li>
    </ol>
  </nav>
  <div style='display:flex;align-items:center;justify-content: center;' class="container-sm mb-2">
    <select class="form-select form-select-md" id='instructor' name='instructor' aria-label=".form-select-sm example" style='width:15%;'>
      <option selected>All</option>
    </select>
    <select class="form-select form-select-md" id='course_id' name='course_id' aria-label=".form-select-sm example" style='width:15%;'>
      <option selected>All</option>
    </select>
    <select class="form-select form-select-md" id='sec_id' name='sec_id' aria-label=".form-select-sm example" style='width:15%;'>
      <option selected>All</option>
    </select>
    <select class="form-select form-select-md" id='semester' name='semester' aria-label=".form-select-sm example" style='width:15%;'>
      <option selected>All</option>
    </select>
    <button id='reset' class='btn btn-primary'>Reset</button>
  </div>
  <div id="carouselExampleIndicators" class="carousel slide" data-interval="false">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" style='background-color:#33ffff'></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2" style='background-color:#33ffff'></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3" style='background-color:#33ffff'></button>
    </div>
    <div class="carousel-inner mt-4" data-interval="false">
      <div class="carousel-item active">
        <div style=' display:flex;border-style:ridge;width:90%;margin:auto;align-items:center;justify-content:center'>
          <div style='width:100%;margin:4%;padding:0;height:200px' id='div1'>
            <canvas id="myChart1" style='width:inherit;'></canvas>
          </div>
          <div style='width:100%;margin:4%;padding:0;height:200px' id='div2'>
            <canvas id="myChart2" style='width:inherit;'></canvas>
          </div>

        </div>
        <div style='display:flex;border-style:ridge;width:90%;margin:auto;align-items:center;justify-content:center'>
          <div style='width:100%;margin:4%;padding:0;height:200px' id='div3'>
            <canvas id="myChart3" style='width:inherit;'></canvas>
          </div>
          <div style='width:100%;margin:4%;padding:0;height:200px' id='div4'>
            <canvas id="myChart4" style='width:inherit;'></canvas>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div style='display:flex;border-style:ridge;width:90%;margin:auto;align-items:center;justify-content:center'>
          <div style='width:100%;margin:4%;padding:0;height:300px;margin-left:10%' id='div5'>
            <canvas id="myChart5" style='width:inherit;'></canvas>
          </div>
          <div style='width:100%;margin:4%;padding:0;height:300px' id='div6'>
            <canvas id="myChart6" style='width:inherit;height:300px'></canvas>
          </div>
        </div>
      </div>
      <div class="carousel-item">

      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev" style='width:2%'>
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next" style='width:2%'>
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <script>
    function generateOptions(course, section, semester, instructor) {
      for (var a of course) {
        for (var b of section) {
          for (var c of semester) {
            instructor.add(a + "_" + b + "_" + c);
          }
        }
      }
    }
  </script>
  <?php
require_once('../../../php/connection.php');
$sql = "select * from feedback ;";
$result = $con->query($sql);
$arr = [];
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  array_push($arr, $row);
}
$var = json_encode($arr);
echo "<script>var data=$var;</script>";
$sql = "select id from instructor;";
$result = $con->query($sql);
$arr = [];
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  array_push($arr, $row);
}
$var = json_encode($arr);
echo "<script>
    var instructorSet=new Set();
    var temp=$var;
    for(var k in temp){
      instructorSet.add(temp[k].id);
    }
    </script>";
$sql = "select course_id,sec_id,semester from section;";
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
  var teach=new Map();
  </script>";
$sql = "select * from teaches;";
$result = $con->query($sql);
$arr = [];
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  array_push($arr, $row);
}
foreach ($arr as $x) {
  echo "<script>
    if(!teach.has('" . $x['id'] . "'))teach.set('" . $x['id'] . "',new Set());
    generateOptions(['All','" . $x['course_id'] . "'],['All','" . $x['sec_id'] . "'],['All','" . $x['semester'] . "'],teach.get('" . $x['id'] . "'));
    </script>";
  $sql = "select takes.anon_id,teaches.ID,teaches.course_id,teaches.sec_id,teaches.semester from (select * from takes inner join represents on takes.id=represents.stud_id) takes inner join teaches on takes.course_id=teaches.course_id and takes.sec_id=teaches.sec_id and takes.semester=teaches.semester;";
  $result = $con->query($sql);
  $arr = [];
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    array_push($arr, $row);
  }
  $var = json_encode($arr);
  echo "<script>
    var enrollment_data=$var;
    </script>";
}
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
    var new_data = [];
    var new_data2 = new Set();
    var distinct_users = new Set();

    function create_table() {
      new_data.length = 0;
      new_data2 = new Set();
      distinct_users = new Set();
      for (var key in data) {
        //Create each row
        if (instructor.value != 'All' && !teach.get(instructor.value).has(data[key].course_id + "_" + data[key].sec_id + "_" + data[key].semester)) continue;
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
        row.innerHTML += `<td><form action='specific_feedback.php' method='POST'style='width:100%;'>
        <input type='hidden' value='${mapper[data[key].feedback_id]}' name='User'>
        <button name='feedback'class="btn btn-primary" type="submit" value='${data[key].feedback_id}'>View</button>
        </form></td>`;
        tbody.insertBefore(row, tbody.firstChild);
      }
      for (var key in enrollment_data) {
        if (instructor.value != 'All' && !teach.get(instructor.value).has(enrollment_data[key].course_id + "_" + enrollment_data[key].sec_id + "_" + enrollment_data[key].semester)) continue;
        if (course_id.value != 'All' && enrollment_data[key].course_id != course_id.value) continue;
        if (sec_id.value != 'All' && enrollment_data[key].sec_id != sec_id.value) continue;
        if (semester.value != 'All' && enrollment_data[key].semester != semester.value) continue;
        new_data2.add(enrollment_data[key].anon_id);
      }
    }
  </script>
  <script>
    var course_id = document.getElementById('course_id');
    var sec_id = document.getElementById('sec_id');
    var semester = document.getElementById('semester');
    var instructor = document.getElementById('instructor');

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
      setall(instructor);
      setall(course_id);
      setall(sec_id);
      setall(semester);
      for (var k of instructorSet) {
        addOption(k, instructor);
      }
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

    function addInstructorOptions() {
      const initial = instructor.value;
      empty(instructor);
      setall(instructor);
      for (const [key, value] of teach) {
        if (value.has(course_id.value + "_" + sec_id.value + "_" + semester.value)) addOption(key, instructor);
      }
      for (var childs of instructor.childNodes) {
        if (childs.value == initial) {
          childs.selected = true;
          return;
        }
      }
      instructor.firstChild.selected = true;
    }

    function addSectionOptions() {
      const initial = sec_id.value;
      empty(sec_id);
      setall(sec_id);
      var set = new Set();
      if (instructor.value != 'All') {
        for (const key of sectionSet) {
          if (teach.get(instructor.value).has(course_id.value + "_" + key + "_" + semester.value)) set.add(key);
        }
      } else {
        for (var k in data) {
          var pos = true;
          if (course_id.value == 'All' || data[k].course_id == course_id.value);
          else pos = false;
          if (semester.value == 'All' || data[k].semester == semester.value);
          else pos = false;
          if (pos) set.add(data[k].sec_id);
        }
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
      if (instructor.value != 'All') {
        for (const key of courseSet) {
          if (teach.get(instructor.value).has(key + "_" + sec_id.value + "_" + semester.value)) set.add(key);
        }
      } else {
        for (var k in data) {
          var pos = true;
          if (sec_id.value == 'All' || data[k].sec_id == sec_id.value);
          else pos = false;
          if (semester.value == 'All' || data[k].semester == semester.value);
          else pos = false;
          if (pos) set.add(data[k].course_id);
        }
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
      if (instructor.value != 'All') {
        for (const key of semesterSet) {
          if (teach.get(instructor.value).has(course_id.value + "_" + sec_id.value + "_" + key)) set.add(key);
        }
      } else {
        for (var k in data) {
          var pos = true;
          if (sec_id.value == 'All' || data[k].sec_id == sec_id.value);
          else pos = false;
          if (course_id.value == 'All' || data[k].course_id == course_id.value);
          else pos = false;
          if (pos) set.add(data[k].semester);
        }
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
            }, ],
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

    }
    for (var k1 of ['change', 'click']) {
      for (var k2 of [instructor, semester, sec_id, course_id]) {
        k2.addEventListener(k1, () => {
          empty(tbody);
          addCourseOptions();
          addInstructorOptions();
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
    window.addEventListener('slid.bs.carousel',()=>{recreate()});
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