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
    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['userid'] != 'student') {
        session_unset();
        session_destroy();
        echo "<script> alert('You are not authorised to this page'); window.location.replace('../../')</script>";
    }
    ?>
    <?php
    require('../../../php/connection.php');
    $sql = "select * from feedback where feedback_id='" . $_POST['feedback'] . "'";
    $result = mysqli_query($con, $sql);
    $result = $result->fetch_assoc();
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
            <li class="breadcrumb-item" style="text-decoration: none;"><a href="../../">Log In</a></li>
            <li class="breadcrumb-item" style="text-decoration: none;"><a href="../">Student</a></li>
            <li class="breadcrumb-item" style="text-decoration: none;"><a href="index.php">View Feedback</a></li>
        </ol>
    </nav>
    <div id="top" class='table-responsive'>
        <form action="../../../php/student/view_feedback/delete_feedback.php" method="POST" style="display:grid;width: 100%;" id="FORM">
            <h2 style="padding:3%;">View Feedback</h2>
            <div class="mb-3">
                <div class="mb-3" style="padding-left:3%;padding-right:3%">
                    <label for="ID" class="form-label">Your ID:</label>
                    <input class="form-control" type="text" class="form-control-plaintext" readonly placeholder="<?php echo $_SESSION['username']; ?>">
                </div>
                <div class="mb-3" style="padding-left:3%;padding-right:3%">
                    <label for="course_id" class="form-label">The Course</label>
                    <input class="form-control" type="text" class="form-control-plaintext" readonly placeholder="<?php echo $result['course_id']; ?>">
                </div>
                <div class="mb-3" style="padding-left:3%;padding-right:3%">
                    <label for="sec_id" class="form-label">The Section</label>
                    <input class="form-control" type="text" class="form-control-plaintext" readonly placeholder="<?php echo $result['sec_id']; ?>">
                </div>
                <div class="mb-3" style="padding-left:3%;padding-right:3%">
                    <label for="semester" class="form-label">The Semester</label>
                    <input class="form-control" type="text" class="form-control-plaintext" readonly placeholder="<?php echo $result['semester']; ?>">
                </div>
                <div class="mb-3" style="padding-left:3%;padding-right:3%">
                    <label for="rating" class="form-label">Rating</label>
                    <input class="form-control" type="text" class="form-control-plaintext" readonly placeholder="<?php echo $result['rating']; ?>">
                </div>
                <div class="mb-3" style="padding-left:3%;padding-right:3%">
                    <h6 class='form-label' style='margin-top:2%'>What do you feel about the number of assignments?</h6>
                    <div class="form-check form-check-inline" style="padding-left:3%;padding-right:3%">
                        <input disabled class="form-check-input" type="radio" <?php if ($result['assignments'] == 1) : echo 'checked';
                                                                                endif; ?>>
                        <label class="form-check-label" for="inlineRadio1">Too few</label>
                    </div>
                    <div class="form-check form-check-inline" style="padding-left:3%;padding-right:3%">
                        <input disabled class="form-check-input" type="radio" <?php if ($result['assignments'] == 2) : echo 'checked';
                                                                                endif; ?>>
                        <label class="form-check-label" for="inlineRadio2">Can add More</label>
                    </div>
                    <div class="form-check form-check-inline" style="padding-left:3%;padding-right:3%">
                        <input disabled class="form-check-input" type="radio" <?php if ($result['assignments'] == 3) : echo 'checked';
                                                                                endif; ?>>
                        <label class="form-check-label" for="inlineRadio3">Ok</label>
                    </div>
                    <div class="form-check form-check-inline" style="padding-left:3%;padding-right:3%">
                        <input disabled class="form-check-input" type="radio" <?php if ($result['assignments'] == 4) : echo 'checked';
                                                                                endif; ?>>
                        <label class="form-check-label" for="inlineRadio4">Reduce a bit</label>
                    </div>
                    <div class="form-check form-check-inline" style="padding-left:3%;padding-right:3%">
                        <input disabled class="form-check-input" type="radio" <?php if ($result['assignments'] == 5) : echo 'checked';
                                                                                endif; ?>>
                        <label class="form-check-label" for="inlineRadio5">Too many</label>
                    </div>
                </div>
                <div class="mb-3" style="padding-left:3%;padding-right:3%">
                    <h6 class='form-label' style='margin-top:2%'>What do you feel about the number of lab evaluations?</h6>
                    <div class="form-check form-check-inline" style="padding-left:3%;padding-right:3%">
                        <input disabled class="form-check-input" type="radio" <?php if ($result['lab evaluations'] == 1) : echo 'checked';
                                                                                endif; ?>>
                        <label class="form-check-label" for="inlineRadio6">Too few</label>
                    </div>
                    <div class="form-check form-check-inline" style="padding-left:3%;padding-right:3%">
                        <input disabled class="form-check-input" type="radio" <?php if ($result['lab evaluations'] == 2) : echo 'checked';
                                                                                endif; ?>>
                        <label class="form-check-label" for="inlineRadio7">Can add More</label>
                    </div>
                    <div class="form-check form-check-inline" style="padding-left:3%;padding-right:3%">
                        <input disabled class="form-check-input" type="radio" <?php if ($result['lab evaluations'] == 3) : echo 'checked';
                                                                                endif; ?>>
                        <label class="form-check-label" for="inlineRadio8">Ok</label>
                    </div>
                    <div class="form-check form-check-inline" style="padding-left:3%;padding-right:3%">
                        <input disabled class="form-check-input" type="radio" <?php if ($result['lab evaluations'] == 4) : echo 'checked';
                                                                                endif; ?>>
                        <label class="form-check-label" for="inlineRadio9">Reduce a bit</label>
                    </div>
                    <div class="form-check form-check-inline" style="padding-left:3%;padding-right:3%">
                        <input disabled class="form-check-input" type="radio" <?php if ($result['lab evaluations'] == 5) : echo 'checked';
                                                                                endif; ?>>
                        <label class="form-check-label" for="inlineRadio10">Too many</label>
                    </div>
                </div>
                <div class="mb-3" style="padding-left:3%;padding-right:3%">
                    <h6 class='form-label' style='margin-top:2%'>Level of Exams?</h6>
                    <div class="form-check form-check-inline" style="padding-left:3%;padding-right:3%">
                        <input class="form-check-input" disabled type="radio" <?php if ($result['exams'] == 1) : echo 'checked';
                                                                                endif; ?>>
                        <label class="form-check-label" for="inlineRadio6">Easy</label>
                    </div>
                    <div class="form-check form-check-inline" style="padding-left:3%;padding-right:3%">
                        <input class="form-check-input" disabled type="radio" <?php if ($result['exams'] == 2) : echo 'checked';
                                                                                endif; ?>>
                        <label class="form-check-label" for="inlineRadio7">Moderate</label>
                    </div>
                    <div class="form-check form-check-inline" style="padding-left:3%;padding-right:3%">
                        <input class="form-check-input" disabled type="radio" <?php if ($result['exams'] == 3) : echo 'checked';
                                                                                endif; ?>>
                        <label class="form-check-label" for="inlineRadio8">Hard</label>
                    </div>
                </div>
                <div class="mb-3" style="padding-left:3%;padding-right:3%">
                    <label for="comment" class="form-label">Comments</label>
                    <textarea disabled class="form-control" name='comment' id="comment" required <?php echo ("placeholder='" . $result['comment'] . "'"); ?>></textarea>
                </div>
                <div class="mb-3 mt-4" style="padding-left:3%;padding-right:3%">
                    <button type="submit" name="submit" value="<?php echo $_POST['feedback'] ?>" class='btn btn-primary' style="padding-left:3%;padding-right:3%">Delete</button>
                </div>

        </form>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>