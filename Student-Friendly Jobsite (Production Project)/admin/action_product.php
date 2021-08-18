<?php

	include 'includes/header.php';
	include 'includes/sidebar.php';
	include ('../includes/connection.php');
	$conn = mysqli_connect("localhost","root");
	$detail = mysqli_select_db($conn, 'Students_Jobsite');
	if(isset($_GET['pid'])){		
		$pid = $_GET['pid'];
		$detail = "SELECT * FROM job WHERE job_id = $pid";
		$detailqry = mysqli_query($conn, $detail);

		while($row = mysqli_fetch_assoc($detailqry)){
			$active = $row['is_activated'];			
		}
		if($active==1){
			//deactivate
			$sql = "UPDATE job SET is_activated = '0' WHERE job_id = $pid";
			$qry = mysqli_query($conn, $sql);		
			if(!$ociExecute){
			
			echo "<script>alert('Job have been deactivated successfully.');window.location.href='job.php';</script>";
			
		}else{
			//activate
			$sql = "UPDATE job SET is_activated = '1' WHERE job_id = $pid";
			$qry = mysqli_query($conn, $sql);		
			
			echo "<script>alert('Job have been activated successfully.');window.location.href='job.php';</script>";

		}	
	}
	}
?>