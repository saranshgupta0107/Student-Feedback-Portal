<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <body>
        <?php 
        $curPageName=substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true)
{
    if(isset($_SESSION['userid']))
    {
        if($_SESSION['userid']==1 && ($curPageName=="admin.html" || $curPageName="add_faculty.html" || $curPageName="add_faculty_course.html" || $curPageName="add_student.html" || $curPageName="show_faculty.html" || $curPageName="view_feedback.html"))
        {}
        elseif($_SESSION['userid']==2 && $curPageName="faculty.html")
        {}
        elseif($_SESSION['userid']==3 && $curPageName="student.html")
        {}
        else
        header("location: ../../index.html");
    }
    else
    header("location: ../../index.html");
}
else
header("location: ../../index.html");
?>  
</body>
</html>
