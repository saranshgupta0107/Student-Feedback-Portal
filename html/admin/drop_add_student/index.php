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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.min.js"></script>
    <title>Show Faculty</title>
</head>

<body>
    <?php
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
    <script>
        function show_alert() {
            if (!confirm("Do you really want to do this?")) {
                return false;
            }
            this.form.submit();
        }
    </script>
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
            <li class="breadcrumb-item active" aria-current="page">Drop/Add Students</li>
        </ol>
    </nav>
    <div role="group" class="btn-group d-flex justify-center" aria-label="Basic radio toggle button group" style="margin-left:2%;margin-right:2%;padding-left:5%;padding-right:5%;padding-top:2%;width:55%;display:flex;position:relative;left:20%;">
        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
        <label class="btn btn-outline-primary" for="btnradio1">Add Student</label>
        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
        <label class="btn btn-outline-primary" for="btnradio2">Drop Student</label>
    </div>
    <div id="drop" class='table-responsive' style="margin-left:2%;margin-right:2%;padding:5%;padding-top:2%;display:none;">
        <div style="display:flexbox;">
            <div class="mb-3" style="width:100%;">
                <h2 style="display:flex;">Drop student</h2>
            </div>
            <div class="mb-3" style="width:100%;">
                <form action="../../../php/admin/drop_student/drop_student.php" method="POST" enctype="multipart/form-data" style="width:100%;" id="FORM1">
                    <label for="ID" class="form-label mb-3">Enter the student to drop:</label>
                    <input type="text" id="ID" name="ID" required class="form-control mb-3" placeholder="Example: IIT2021155">
                    <input type="submit" name="submit1" id='submit1' value="Submit" class="btn btn-primary mb-3">
                </form>
            </div>
            <br>
            <div class="mb-3" style="width:100%;">
                <form action="../../../php/admin/drop_student/drop_student.php" method="POST" enctype="multipart/form-data" style="width:100%;" id="FORM2">
                    <label for="csvfile" class="form-label">Or Upload CSV file for mass delete:</label>
                    <input type="file" id="csvfile1" name="csvfile1" required class="form-control mb-3" accept=".csv">
                    <input type='hidden' name='file_data1' id='file_data1'>
                    <input type="submit" name="submit2" id='submit2' value="Submit" disabled='true' class="btn btn-primary mb-3">
                </form>
            </div>
            <div class="mb-3">
                <form action="../../../php/admin/drop_student/drop_student.php" method="POST" enctype="multipart/form-data" style="width:100%;" id="FORM3" onsubmit="return show_alert(this);">
                    <label for="submit" class="form-label">Or Click me to drop all students:</label>
                    <input type='hidden' name='all' value='all'>
                    <input type="submit" name="submit3" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
    <div id="add" class='table-responsive' style="margin-left:2%;margin-right:2%;padding:5%;padding-top:2%;display:block;">
        <div style="display:flexbox;">
            <div class="mb-3" style="width:100%;">
                <h2 style="display:flex;">Add student</h2>
            </div>
            <div class="mb-3" style="width:100%;">
                <form action="../../../php/admin/drop_student/add_student.php" method="POST" enctype="multipart/form-data" style="width:100%;" id="FORM4">
                    <label for="ID" class="form-label">Enter the student to add:</label>
                    <input type="text" id="ID" name="ID" required class="form-control mb-3" placeholder="Example: IIT2021155">
                    <input type="text" id="name" name="name" required class="form-control mb-3" placeholder="Example: XXXXXXXXXX">
                    <input type="text" id="dept_name" name="dept_name" required class="form-control mb-3" placeholder="Example: IT">
                    <input type="submit" name="submit4" id='submit4' value="Submit" class="btn btn-primary mb-3">
                </form>
            </div>
            <br>
            <div class="mb-3" style="width:100%;">
                <form action="../../../php/admin/drop_student/add_student.php" method="POST" enctype="multipart/form-data" style="width:100%;" id="FORM5">
                    <label for="csvfile" class="form-label">Or Upload CSV file for mass add:</label>
                    <input type="file" id="csvfile2" name="csvfile2" required class="form-control mb-3" accept=".csv">
                    <input type='hidden' name='file_data2' id='file_data2'>
                    <input type="submit" name="submit5" id='submit5' value="Submit" disabled='true' class="btn btn-primary mb-3">
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="../../../js/admin/drop_student/drop_student.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var drop = document.getElementById('drop');
        var add = document.getElementById('add');

        var dropBtn = document.getElementById('btnradio2');
        var addBtn = document.getElementById('btnradio1');

        dropBtn.onclick = function() {
            drop.style.display = 'block';
            add.style.display = 'none';
        };

        addBtn.onclick = function() {
            drop.style.display = 'none';
            add.style.display = 'block';
        };
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>