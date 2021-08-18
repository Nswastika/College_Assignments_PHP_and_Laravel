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
			$email = $row['USER_EMAIL'];			
		}
		if($active==1){
			//deactivate
			$sql = "UPDATE USERS SET ACTIVE = '0' WHERE USER_ID = $sid";
			$qry = oci_parse($conn, $sql);		
			$ociExecute = oci_execute($qry);
			$msg = "Your account has been deactivated, please contact the admin for more info";

			// use wordwrap() if lines are longer than 70 characters
			$msg = wordwrap($msg,70);
		
				
			$headers = "From: cleckhuddersfax12store@gmail.com\r\n";
			$headers .= "Reply-To: ".$email."\r\n";
			$headers .= "Return-Path: cleckhuddersfax12store@example.com\r\n";

			if ( mail($email,"About your account",$msg,$headers) ) {
   				echo "Confirmation has been sent to trader's email";
   			} 
			else 
			{
   				echo "Failed to send email to trader, try again!";
   			}
			if(!$ociExecute){
				echo "<script>alert('Oci Execute Error');window.location.href='trader_manage.php';</script>";
			}else{
				echo "<script>alert('Trader have been deactivated successfully.');window.location.href='trader_manage.php';</script>";
			}
			
		}else{
			//activate
			$sql = "UPDATE USERS SET ACTIVE = '1' WHERE USER_ID = $sid";
			$qry = oci_parse($conn, $sql);		
			$ociExecute = oci_execute($qry);
			
			$msg = "Your account has been activated";

			// use wordwrap() if lines are longer than 70 characters
			$msg = wordwrap($msg,70);
		
				
			$headers = "From: cleckhuddersfax12store@gmail.com\r\n";
			$headers .= "Reply-To: ".$email."\r\n";
			$headers .= "Return-Path: cleckhuddersfax12store@example.com\r\n";

			if ( mail($email,"About your account",$msg,$headers) ) {
   				echo "Confirmation has been sent to trader's email";
   			} 
			else 
			{
   				echo "Failed to send email to trader, try again!";
   			}
			
			
			if(!$ociExecute){
				echo "<script>alert('Oci Execute Error');window.location.href='trader_manage.php';</script>";
			}else{
				echo "<script>alert('Trader have been activated successfully.');window.location.href='trader_manage.php';</script>";
			}
		}	
	}
?>