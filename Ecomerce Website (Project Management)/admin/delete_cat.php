<?php
	session_start();
	if(isset($_SESSION['USER_ID']) && $_SESSION['USER_TYPE'] = "Admin"){
	$USER_ID = $_SESSION['USER_ID'];	
	}else{
		header('location:../login.php');
	}
	include '../includes/connect.php';
	if(isset($_GET['sid'])){
		$sid = $_GET['sid'];
		$sql2 = "DELETE FROM CATEGORY WHERE CATEGORYID=$sid";
		$result2 = oci_parse($conn,$sql2);
		oci_execute($result2);
		//header("Location: {$_SERVER['HTTP_REFERER']}");
		$location = $_SERVER['HTTP_REFERER'];
		echo "<script>alert('Category have been deleted successfully.');window.location.href='$location';</script>";
	}
		
?>