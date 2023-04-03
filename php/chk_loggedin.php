<?php
session_start();
?>
        <?php 
        $curPageName=substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
        $userid=$_SESSION['userid'];
        // echo '<script>alert("efbg");</script>';
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true)
{
    if(isset($_SESSION['userid']))
    {
        if($_SESSION['userid']==1 && ($curPageName=="admin.html" || $curPageName=="add_faculty.html" || $curPageName=="add_faculty_course.html" || $curPageName=="add_student.html" || $curPageName=="show_faculty.html" || $curPageName=="view_feedback.html" || $curPageName=="view_student.html"))
        {
        }
        elseif($_SESSION['userid']==2 && ($curPageName=="faculty.html" || $curPageName=="show_feedback.html"))
        {
        }
        elseif($_SESSION['userid']==3 && ($curPageName=="student.html" || $curPageName=="give_feedback.html" || $curPageName=="view_feedback.html"))
        {}
        else{
        echo "<script>window.location.replace('../../index.html');</script>";
        header("location: ../../index.html");}
    }
    else{
    echo '<script>window.location.replace("../../index.html");</script>';
    header("location: ../../index.html");}
}
else{
echo '<script>window.location.replace("../../index.html");</script>';
header("location: ../../index.html");}
?>  
