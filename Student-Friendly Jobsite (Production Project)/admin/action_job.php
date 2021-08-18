<?php
	include 'includes/header.php';
	include 'includes/sidebar.php';
	include ('../includes/connection.php');
	$conn = mysqli_connect("localhost","root");
	$detail = mysqli_select_db($conn, 'Students_Jobsite');
	if(isset($_GET['sid'])){		
		$sid = $_GET['sid'];
		$detail = "SELECT * FROM job WHERE job_id = $sid";
		$detailqry = mysqli_query($conn, $detail);

		while($row = mysqli_fetch_assoc($detailqry)){
			$active = $row['is_activated'];			
		}
		if($active==1){
			//deactivate
			$sql = "UPDATE job SET is_activated = '0' WHERE job_id = $sid";
			$qry = mysqli_query($conn, $sql);			
			echo "<script>alert('Job is deactivated successfully.');window.location.href='job.php';</script>";
		}else{
			//activate
			$sql = "UPDATE job SET is_activated = '1' WHERE job_id = $sid";
			$qry = mysqli_query($conn, $sql);		
			
			echo "<script>alert('Job is activated successfully.');window.location.href='job.php';</script>";
		}	
	}
	
?>

