<?php
session_start();
if(isset($_SESSION['USER_ID']) && $_SESSION['USER_TYPE'] = "Trader"){
	$USER_ID = $_SESSION['USER_ID'];	
}else{
	header('location:../login.php');
}
include ('../includes/connect.php');
include ('imageupload.php');
$trader_id = $USER_ID;
$pshopid = 0;
$pcatid = 0;
if(isset($_GET['id'])){
	$error_count=0;
	$eid = $_GET['id'];
	$detail = "SELECT * FROM product WHERE PRODUCTID = $eid";
	$detailqry = oci_parse($conn, $detail);
	oci_execute($detailqry);
	while($row = oci_fetch_assoc($detailqry)){
		$txtName = $row['PRODUCTNAME'];
		$txtDesc = $row['PRODUCTDESCRIPTION'];
		$txtPrice = $row['PRODUCTPRICE'];
		$txtQuantity = $row['PRODUCTSTOCK'];
		$minord = $row['MINIMUMORDER'];
		$maxord = $row ['MAXIMUMORDER'];		
		$txtAllergy = $row['ALLERGYINFORMATION'];		
		$txtDis = $row['PRODUCT_DISCOUNT_PERCENT'];		
		$pshopid = $row['PRODUCT_SHOP_ID'];
		$pcatid = $row['CATEGORYID'];
		$pimagePath = $row['PRODUCTIMAGE'];
	}
}

if (isset($_POST['updateprod'])){
	date_default_timezone_set('Asia/Kathmandu');
	$date = date("Y-m-d h:i:sA");
	$prdCatId = $_POST["prdCatId"];
	$prdShopId = $_POST["shopId"];
	$txtName = $_POST['txtName'];
	$txtDesc = $_POST['txtDesc'];
	$txtPrice = $_POST['txtPrice'];
	$txtQuantity = $_POST['txtQuantity'];
	$minord = $_POST['minord'];
	$maxord = $_POST['maxord'];		
	$txtAllergy = $_POST['txtAllergy'];		
	
	$txtDis = $_POST['txtDis'];		
	
	$product_image = $_FILES['product_image']["name"];
	
	$maxsize = 2097152;
    $img_haystack = array('jpg', 'jpeg', 'png');
    $image_filter = array('image/jpeg', 'image/jpg', 'image/png');
    if (!empty($product_image)) {
		$target_dir = "../image/";
		$target_file = $target_dir . basename($_FILES["product_image"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		if (!in_array($imageFileType, $img_haystack)) {
			$errors['invalid_img'] = "Invalid file type. Only JPG and PNG types are accepted.";
		} else {
			$flag = 1;
		}
		if ($flag) {
			$imgSize = $_FILES["product_image"]["size"];
			if ($imgSize > $maxsize) {
				$errors['max'] = 'File you\'re trying to upload is too large. File must be less than 2 megabytes.';
			}
		}
		$check = getimagesize($_FILES["product_image"]["tmp_name"]);
		if ($check !== false) {
			$uploadOk = 1;
			$imgPath = $target_dir . uniqid() . '.' . $imageFileType;
			if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $imgPath)) {
			} else {
				$errors['fail'] = "Sorry, there was an error uploading your file.";
			}
		}		
		$imgPath = substr($imgPath,3,strlen($imgPath)-3);
	}else{
		$imgPath = $pimagePath;
	}
	
	//if there are no errors save it to database
	if ($error_count == 0){
		$sql = "UPDATE PRODUCT SET PRODUCTNAME = '$txtName', PRODUCTDESCRIPTION='$txtDesc', PRODUCTSTOCK=$txtQuantity, MINIMUMORDER = '$minord', MAXIMUMORDER = '$maxord', ALLERGYINFORMATION = '$txtAllergy', PRODUCT_SHOP_ID = $prdShopId, 
		CATEGORYID = $prdCatId, PRODUCTPRICE = $txtPrice, 
		PRODUCT_DISCOUNT_PERCENT= '$txtDis', PRODUCTIMAGE = '$imgPath' WHERE PRODUCTID = $eid";
		
		$result = oci_parse($conn,$sql);		
		$oci = oci_execute($result);
		if(!$oci){
			
			echo "<script>alert('Product have been edited successfully.');window.location.href='products.php';</script>";
		}
		
	} 
}


?>
<?php include('../includes/backend/head.php');?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include('./includes/nav.php'); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       	Update Product
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Enter details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="" enctype="multipart/form-data">
				<div class="box-body">
					<div class="form-group">
						<label >Select Shop:</label>
												
							<select class="form-control" name="shopId">								
								<?php
									$sql2 = "SELECT * FROM SHOP WHERE TRADER_ID=$trader_id";
									$result2 = oci_parse($conn,$sql2);
									oci_execute($result2);									
									while ($row = oci_fetch_assoc($result2)){									
										?>
										<option value="<?php echo $row['SHOP_ID']; ?>" <?php if($pshopid==$row['SHOP_ID']){echo "selected";} ?> >
											<?php echo $row['NAME']; ?>
										</option>
										<?php
									}
								?>
							</select>							
						
					</div>
					
					
					
						
                <div class="form-group">
                  <label for="exampleInputName">Name</label>
                  <input type="text" required class="form-control" id="Name" placeholder="Enter name" value="<?php echo $txtName?>" name="txtName">
                </div>
                <div class="form-group">
                  <label for="exampleInputDescription">Description</label>
                  <input type="text" required class="form-control" id="Desc" placeholder="Enter description" value="<?php echo $txtDesc?>" name="txtDesc">
                </div>
                <div class="form-group">
						<label>Select Category:</label>
												
							<select class="form-control" name="prdCatId">								
								<?php
									$sql2 = "SELECT * FROM CATEGORY";
									$result2 = oci_parse($conn,$sql2);
									oci_execute($result2);									
									while ($row = oci_fetch_assoc($result2)){									
										?>
										<option value="<?php echo $row['CATEGORYID']; ?>" <?php if($pcatid==$row['CATEGORYID']){echo "selected";} ?>>
											<?php echo $row['CATEGORYNAME']; ?>
										</option>
										<?php
									}
								?>
							</select>							
						
					</div>
               	<div class="form-group">
                  <label for="exampleInputPrice">Price</label>
                  <input type="number" required class="form-control" id="Price" placeholder="Enter Price" value="<?php echo $txtPrice?>" name="txtPrice">
                </div>
				<div class="form-group">
                  <label for="exampleInputQuantity">Quantity</label>
                  <input type="number" required class="form-control" id="Quantity" placeholder="Enter quantity" value="<?php echo $txtQuantity?>" name="txtQuantity">
                </div>
                <div class="form-group">
                  <label for="exampleInputAllergy">Minimum Order</label>
                  <input type="text" class="form-control" id="Allergy" placeholder="Enter any allergy info the product might have" value="<?php echo $minord?>" name="minord">
                </div>
                <div class="form-group">
                  <label for="exampleInputAllergy">Maximum Order</label>
                  <input type="text" class="form-control" id="Allergy" placeholder="Enter any allergy info the product might have" value="<?php echo $maxord?>" name="maxord">
                </div>
               	<div class="form-group">
                  <label for="exampleInputAllergy">Allergy Info</label>
                  <input type="text" class="form-control" id="Allergy" placeholder="Enter any allergy info the product might have" value="<?php echo $txtAllergy?>" name="txtAllergy">
                </div>
				
				<div class="form-group">
                  <label for="exampleInputPrice">Discount %</label>
                  <input type="number" class="form-control" id="Dis" placeholder="Enter Discount %" value="<?php echo $txtDis?>" name="txtDis">
                </div>
									
               
                <div class="form-group">
                  <label for="exampleInputFile">Choose thumbnail</label>
                  <input type="file" id="exampleInputFile" name="product_image">

                  <p class="help-block">Upload an appropriate image for the product.</p>
                </div>
               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="updateprod" class="btn btn-success">Update</button>
              </div>
            </form>
          </div>
      </section>
    <!-- /.content -->
  </div>
   <?php include('includes/footer.php'); ?>

<!-- ./wrapper -->
<?php include('./includes/script.php'); ?>
</body>
</html>
