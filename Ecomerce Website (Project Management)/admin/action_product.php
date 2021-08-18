<?php
	session_start();
	if(isset($_SESSION['USER_ID']) && $_SESSION['USER_TYPE'] = "Admin"){
		$USER_ID = $_SESSION['USER_ID'];	
	}else{
		header('location:../login.php');
	}
	include '../includes/connect.php';
	if(isset($_GET['pid'])){		
		$pid = $_GET['pid'];
		$detail = "SELECT * FROM PRODUCT WHERE PRODUCTID = $pid";
		$detailqry = oci_parse($conn, $detail);
		oci_execute($detailqry);
		while($row = oci_fetch_assoc($detailqry)){
			$active = $row['IS_ACTIVATED'];			
		}
		if($active==1){
			//deactivate
			$sql = "UPDATE PRODUCT SET IS_ACTIVATED = '0' WHERE PRODUCTID = $pid";
			$qry = oci_parse($conn, $sql);		
			$ociExecute = oci_execute($qry);
			if(!$ociExecute){
				echo "<script>alert('Oci Execute Error');window.location.href='products.php';</script>";
			}else{
				echo "<script>alert('Trader have been deactivated successfully.');window.location.href='products.php';</script>";
			}
			
		}else{
			//activate
			$sql = "UPDATE PRODUCT SET IS_ACTIVATED = '1' WHERE PRODUCTID = $pid";
			$qry = oci_parse($conn, $sql);		
			$ociExecute = oci_execute($qry);
			if(!$ociExecute){
				echo "<script>alert('Oci Execute Error');window.location.href='products.php';</script>";
			}else{
				echo "<script>alert('Product have been activated successfully.');window.location.href='products.php';</script>";
			}
		}	
	}
?>