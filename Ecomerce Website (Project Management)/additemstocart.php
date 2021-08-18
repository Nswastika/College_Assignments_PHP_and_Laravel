<?php
    include 'includes/connect.php';
    session_start();
    $custid = $_SESSION["USER_ID"];

    if (isset ($_GET['id'])) {
        $productno = $_GET['id'];
        $quantity;
        $query = "SELECT MINIMUMORDER, MAXIMUMORDER, PRODUCTPRICE, PRODUCT_DISCOUNT_PERCENT FROM Product WHERE PRODUCTID=$productno";
        $stid = oci_parse($conn, $query);
        oci_execute($stid);
        $row = oci_fetch_assoc($stid);
        if(isset($row['PRODUCT_DISCOUNT_PERCENT'])){
            $oldprice = $row['PRODUCTPRICE'];
            $discount = $row['PRODUCT_DISCOUNT_PERCENT'];
            $price = $oldprice-($oldprice*$discount/100);
        }
        else{
            $price = $row['PRODUCTPRICE'];
        }
        if (isset ($_POST['quantity']) && $_POST['quantity']>=$row['MINIMUMORDER'] && $_POST['quantity']<=$row['MAXIMUMORDER']) {
            $quantity = $_POST['quantity'];
            $selectfromcart = "SELECT COUNT(PRODUCTID) AS NUMROWS, QUANTITY FROM CART WHERE PRODUCTID=$productno AND CUSTOMERID = $custid GROUP BY QUANTITY";
            $isrow = oci_parse($conn, $selectfromcart);
            echo $selectfromcart;
            oci_execute($isrow);
            $rows = oci_fetch_assoc($isrow);
            if ($rows['NUMROWS']>0) {
                $quantity = $quantity + $rows['QUANTITY'];
                $query = "UPDATE CART SET QUANTITY = $quantity WHERE PRODUCTID = $productno AND CUSTOMERID = $custid";
                $stid = oci_parse($conn, $query);
                oci_execute($stid);
            }
            else{
                $query = "INSERT INTO CART (CUSTOMERID, PRODUCTID, QUANTITY, PRODUCTPRICE) VALUES ($custid,$productno,$quantity,$price)";
                $stid = oci_parse($conn, $query);
                oci_execute($stid);
            }
        }
        else if(isset ($_POST['quantity'])){
            if($_POST['quantity']<$row['MINIMUMORDER'] || $_POST['quantity']>$row['MAXIMUMORDER']){
            $_SESSION['QUANTITYERROR'] = "Error";
            }
        }
        else if(!isset ($_POST['quantity'])){
            $quantity = $row['MINIMUMORDER'];
            $selectfromcart = "SELECT COUNT(PRODUCTID) AS NUMROWS, QUANTITY FROM CART WHERE PRODUCTID=$productno AND CUSTOMERID = $custid GROUP BY QUANTITY";
            $isrow = oci_parse($conn, $selectfromcart);
            echo $selectfromcart;
            oci_execute($isrow);
            $rows = oci_fetch_assoc($isrow);
            if ($rows['NUMROWS']>0) {
                $quantity = $quantity + $rows['QUANTITY'];
                $query = "UPDATE CART SET QUANTITY = $quantity WHERE PRODUCTID = $productno AND CUSTOMERID = $custid";
                $stid = oci_parse($conn, $query);
                oci_execute($stid);
            }
            else{
                $query = "INSERT INTO CART (CUSTOMERID, PRODUCTID, QUANTITY, PRODUCTPRICE) VALUES ($custid,$productno,$quantity,$price)";
                $stid = oci_parse($conn, $query);
                oci_execute($stid);
            }
        }
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
    else {
        $_COOKIE['productid'] = $_GET['id'];
        echo $_COOKIE['productid'];
    }
?>