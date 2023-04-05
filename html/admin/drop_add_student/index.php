<!DOCTYPE html>
<html>

<head>
    <title>Form with CSV upload field</title>
</head>

<body>
    <h2>Drop student</h2>
    <form action="form_action.php" method="POST" enctype="multipart/form-data">
        <label for="course_id">Name:</label>
        <input type="text" id="course_id" name="course_id" required><br><br>

        <label for="sec_id">Email:</label>
        <input type="text" id="sec_id" name="sec_id" required><br><br>

        <label for="semester">Phone:</label>
        <input type="text" id="semester" name="semester" required><br><br>

        <label for="csvfile">Upload CSV file:</label>
        <input type="file" id="csvfile" name="csvfile" required><br><br>

        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>