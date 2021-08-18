<?php

	include '../includes/connection.php';
	$sql2 = mysqli_select_db($conn, 'Students_Jobsite');
	if(isset($_GET['sid'])){
		$sid = $_GET['sid'];	
		$sql2 = "DELETE FROM advice WHERE advice_id=$sid";
		$result2 = mysqli_query($conn, $sql2);
		//header("Location: {$_SERVER['HTTP_REFERER']}");
		$location = $_SERVER['HTTP_REFERER'];
		echo "<script>alert('Advice is deleted successfully.');window.location.href='$location';</script>";
	}
		
?>