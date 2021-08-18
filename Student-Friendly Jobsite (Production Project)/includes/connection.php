<?php
$hostname_job = "localhost";
$database_job = "Students_Jobsite";
$username_job = "root";
$password_job = "";
$conn = mysqli_connect($hostname_job, $username_job, $password_job) or trigger_error(mysql_error(),E_USER_ERROR); 
?>