<?php
    include 'includes/connect.php';
    session_start();
    $custid = $_SESSION["USER_ID"];

    if (isset ($_POST['submit'])) {
        $query = "SELECT USER_FIRST_NAME FROM USERS WHERE USER_ID = $custid";
        $stid = oci_parse($conn, $query);
        oci_execute($stid);
        $row = oci_fetch_assoc($stid);
        $custname = $row['USER_FIRST_NAME'];
        $score = $_POST['star'];
        $desp = $_POST['review'];
        $date = date("m/d/Y"); 
        $productno = $_SESSION['PRODUCTNO'];

        $query = "INSERT INTO REVIEW (REVIEWID, CUSTOMERID, CUSTOMERNAME, PRODUCTID, REVIEWDESCRIPTION, REVIEWSCORE, REVIEWDATE) VALUES (SEQ_REVIEW.nextval, $custid, '$custname', $productno, '$desp', $score, '$date')";
        echo $query;
        $stid = oci_parse($conn, $query);
        oci_execute($stid);

        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
?>