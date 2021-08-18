<?php

	include 'includes/header.php';
	include 'includes/sidebar.php';
	include ('../includes/connection.php');
	$conn = mysqli_connect("localhost","root");
	$sql = mysqli_select_db($conn, 'Students_Jobsite');
	if(isset($_GET['sid'])){		
		$sid = $_GET['sid'];
		$detail = "SELECT * FROM success_story WHERE success_id = $sid";
		$detailqry = mysqli_query($conn, $detail);
		while($row = mysqli_fetch_assoc($detailqry)){
			$active = $row['active'];			
		}
		if($active==1){
			//deactivate
			$sql = "UPDATE success_story SET active = '0' WHERE success_id = $sid";
			$qry = mysqli_query($conn, $sql);		
			
			echo "<script>alert('Success Story have been deactivated successfully.');window.location.href='success_story.php';</script>";
			
			
		}else{
			//activate
			$sql = "UPDATE success_story SET active = '1' WHERE success_id = $sid";
			$qry = mysqli_query($conn, $sql);			
			
			echo "<script>alert('Success Story have been activated successfully');window.location.href='success_story.php';</script>";
			
		}	
	}
?>