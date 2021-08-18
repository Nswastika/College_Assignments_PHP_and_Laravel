<?php
	session_start();
	if(isset($_SESSION['USER_ID']) && $_SESSION['USER_TYPE'] = "Trader"){
	$USER_ID = $_SESSION['USER_ID'];	
	}else{
		header('location:../login.php');
	}
	include '../includes/connect.php';
	if(isset($_GET['mid'])){
		$mid = $_GET['mid'];
		$sql2 = "DELETE FROM SHOP WHERE SHOP_ID ='$mid'";
		$result2 = oci_parse($conn,$sql2);
		oci_execute($result2);
		//header("Location: {$_SERVER['HTTP_REFERER']}");
		$location = $_SERVER['HTTP_REFERER'];
		echo "<script>alert('You have sucessfully Deleted a Shop.');window.location.href='$location';</script>";
	}
		
?>