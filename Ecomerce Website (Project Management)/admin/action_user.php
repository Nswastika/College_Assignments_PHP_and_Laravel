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
		$detail = "SELECT * FROM USERS WHERE USER_ID = $sid";
		$detailqry = oci_parse($conn, $detail);
		oci_execute($detailqry);
		while($row = oci_fetch_assoc($detailqry)){
			$active = $row['ACTIVE'];			
		}
		if($active==1){
			//deactivate
			$sql = "UPDATE USERS SET ACTIVE = '0' WHERE USER_ID = $sid";
			$qry = oci_parse($conn, $sql);		
			oci_execute($qry);
			if(ociError()){
				echo "<script>alert('Oci Execute Error');window.location.href='users_manage.php';</script>";
			}else{
				echo "<script>alert('User have been deactivated successfully.');window.location.href='users_manage.php';</script>";
			}
			
		}else{
			//activate
			$sql = "UPDATE USERS SET ACTIVE = '1' WHERE USER_ID = $sid";
			$qry = oci_parse($conn, $sql);		
			oci_execute($qry);
			if(ociError()){
				echo "<script>alert('Oci Execute Error');window.location.href='users_manage.php';</script>";
			}else{
				echo "<script>alert('User have been activated successfully');window.location.href='users_manage.php';</script>";
			}
		}	
	}
?>