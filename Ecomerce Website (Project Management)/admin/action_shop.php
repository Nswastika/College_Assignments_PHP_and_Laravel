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
		$detail = "SELECT * FROM SHOP WHERE SHOP_ID = $sid";
		$detailqry = oci_parse($conn, $detail);
		oci_execute($detailqry);
		while($row = oci_fetch_assoc($detailqry)){
			$active = $row['IS_ACTIVE'];			
		}
		if($active==1){
			//deactivate
			$sql = "UPDATE SHOP SET IS_ACTIVE = '0' WHERE SHOP_ID = $sid";
			$qry = oci_parse($conn, $sql);		
			$ociExecute = oci_execute($qry);
			if(!$ociExecute){
				echo "<script>alert('Oci Execute Error');window.location.href='shop_manage.php';</script>";
			}else{
				echo "<script>alert('Trader have been deactivated successfully.');window.location.href='shop_manage.php';</script>";
			}
			
		}else{
			//activate
			$sql = "UPDATE SHOP SET IS_ACTIVE = '1' WHERE SHOP_ID = $sid";
			$qry = oci_parse($conn, $sql);		
			$ociExecute = oci_execute($qry);
			if(!$ociExecute){
				echo "<script>alert('Oci Execute Error');window.location.href='shop_manage.php';</script>";
			}else{
				echo "<script>alert('Trader have been activated successfully.');window.location.href='shop_manage.php';</script>";
			}
		}	
	}
?>