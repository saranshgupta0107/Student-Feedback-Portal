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
        if($_SESSION['userid']==1 && ($curPageName=="admin.html" || $curPageName="add_faculty.html"))
        {}
        elseif($_SESSION['userid']==2 && $curPageName="faculty.html")
        {}
        elseif($_SESSION['userid']==3 && $curPageName="student.html")
        {}
        else
        header("location: ../html/index.html");
    }
    else
    header("location: ../html/index.html");
}
else
header("location: ../html/index.html");
?>  
</body>
</html>
