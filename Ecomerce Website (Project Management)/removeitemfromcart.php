<?php
    include 'includes/connect.php';
    session_start();
    $custid = $_SESSION["USER_ID"];
    
    if (isset ($_GET['id'])) {
        $productno = $_GET['id'];
        $sql = "DELETE FROM CART WHERE PRODUCTID=$productno AND CUSTOMERID=$custid";
        $stid = oci_parse($conn, $sql);
        oci_execute($stid);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
	}
?>