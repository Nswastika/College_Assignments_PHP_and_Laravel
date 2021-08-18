<?php
	session_start();
	if(isset($_SESSION['USER_ID']) && $_SESSION['USER_TYPE'] = "Trader"){
	$USER_ID = $_SESSION['USER_ID'];	
	}else{
		header('location:../login.php');
	}
	include '../includes/connect.php';
	if(isset($_GET['sid'])){		
		$sid = $_GET['sid'];
		$detail = "SELECT * FROM PAYMENT WHERE  = $sid";
		$detailqry = oci_parse($conn, $detail);
		oci_execute($detailqry);
		while($row = oci_fetch_assoc($detailqry)){
			$active = $row['IS_DELIVERED'];			
		}
		if($active==1){
			//deactivate
			$sql = "UPDATE PAYMENT SET IS_DELIVERED = '0' WHERE INVOICE_ID = $sid";
			$qry = oci_parse($conn, $sql);		
			$ociExecute = oci_execute($qry);
			if(!$ociExecute){
				echo "<script>alert('Oci Execute Error');window.location.href='order.php';</script>";
			}else{
				echo "<script>alert('Set an items delivery status as Not Delivered.');window.location.href='order.php';</script>";
			}
			
		}else{
			//activate
			$sql = "UPDATE ORDERS SET IS_DELIVERED = '1' WHERE INVOICE_ID = $sid";
			$qry = oci_parse($conn, $sql);		
			$ociExecute = oci_execute($qry);
			if(!$ociExecute){
				echo "<script>alert('Oci Execute Error');window.location.href='order.php';</script>";
			}else{
				echo "<script>alert('Set an Item is Delivered.');window.location.href='order.php';</script>";
			}
		}	
	}
?>