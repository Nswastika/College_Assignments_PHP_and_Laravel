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

$error_count = 0;
$isUsed = false;
$prdCatId = $shopId = $txtName = $txtDesc = $txtAllergy = $txtSpc = $txtSf = $txtSt = $trad_Id =  "";
	$txtPrice = $txtQuantity = $txtDis = 0;
	$isRegistered = 0;
    $sql="SELECT * FROM TRADER WHERE USER_ID='$USER_ID' ";
	$qry = oci_parse($conn, $sql);

if (isset($_POST['addprod'])){
	unset($_POST['addprod']);
	
	date_default_timezone_set('Asia/Kathmandu');
	$date = date("Y-m-d h:i:sA");
	
	$trader_Id = $_POST["trader_Id"];
	$prdCatId = $_POST["prdCatId"];
	$shopId = $_POST["shopId"];
	$txtName = $_POST["txtName"];
	$txtDesc = $_POST["txtDesc"];
	$txtPrice = $_POST["txtPrice"];
	$txtQuantity = $_POST["txtQuantity"];
	$minord = $_POST["minord"];
	$maxord = $_POST["maxord"];
	$txtAllergy = $_POST["txtAllergy"];
	$txtDis = $_POST["txtDis"];
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
		$imgPath = "";
	}
        if ($error_count == 0){
		$sql = "INSERT INTO PRODUCT (PRODUCTID, PRODUCT_SHOP_ID, CATEGORYID, PRODUCTNAME, PRODUCTDESCRIPTION, PRODUCTPRICE, PRODUCT_DISCOUNT_PERCENT, 
		 PRODUCTSTOCK, MINIMUMORDER, MAXIMUMORDER, ALLERGYINFORMATION, PRODUCTIMAGE, TRADER_ID) VALUES 
		(seq_product.nextval, '$shopId','$prdCatId','$txtName', '$txtDesc', '$txtPrice', '$txtDis',  '$txtQuantity', '$minord', '$maxord', '$txtAllergy', '$imgPath', '$trader_Id')";
		
		$result = oci_parse($conn,$sql);		
		oci_execute($result);
		}
        if ($sql){			
			echo "<script>alert('A new product have been added successfully.');window.location.href='products.php';</script>";            
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
       	Add New Product
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add New Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
           
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="" enctype="multipart/form-data">
				<div class="box-body">
					

						<div class="form-group">
						<label>Shop Id:</label>
												
							<select class="form-control" name="shopId">								
								<?php
									$sql2 = "SELECT * FROM SHOP WHERE TRADER_ID=$trader_id";
									$result2 = oci_parse($conn,$sql2);
									oci_execute($result2);									
									while ($row = oci_fetch_assoc($result2)){									
										?>
										<option value="<?php echo $row['SHOP_ID']; ?>">
											<?php echo $row['NAME']; ?>
										</option>
										<?php
									}
								?>
							</select>							
						</div>


                        
						<div class="form-group">
						<label>Trader Id:</label>
												
							<select class="form-control" name="trader_Id">								
								<?php
									$sql2 = "SELECT * FROM SHOP WHERE TRADER_ID=$trader_id";
									$result2 = oci_parse($conn,$sql2);
									oci_execute($result2);									
									while ($row = oci_fetch_assoc($result2)){									
										?>
										<option value="<?php echo $row['TRADER_ID']; ?>">
											<?php echo $row['TRADER_ID']; ?>
										</option>
										<?php
									}
								?>
							</select>							
						</div>


		
                <div class="form-group">
                  <label for="exampleInputName">Name</label>
                  <input type="text" required class="form-control" id="Name" placeholder="Enter name" name="txtName">
                </div>
                <div class="form-group">
                  <label for="exampleInputDescription">Description</label>
                  <input type="text" required class="form-control" id="Desc" placeholder="Enter description" name="txtDesc">
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
										<option value="<?php echo $row['CATEGORYID']; ?>">
											<?php echo $row['CATEGORYNAME']; ?>
										</option>
										<?php
									}
								?>
							</select>							
						</div>
					
				
               	<div class="form-group">
                  <label for="exampleInputPrice">Price</label>
                  <input type="number" required class="form-control" id="Price" placeholder="Enter Price" name="txtPrice">
                </div>
				<div class="form-group">
                  <label for="exampleInputQuantity">Quantity</label>
                  <input type="number" required class="form-control" id="Quantity" placeholder="Enter quantity" name="txtQuantity">
                </div>
                <div class="form-group">
                  <label for="exampleInputAllergy">Minimum Order</label>
                  <input type="num" class="form-control" id="Min" placeholder="Enter any min order" name="minord">
                </div>
                <div class="form-group">
                  <label for="exampleInputAllergy">Maximum Order</label>
                  <input type="num" class="form-control" id="Max" placeholder="Enter any max order" name="maxord">
                </div>
               	<div class="form-group">
                  <label for="exampleInputAllergy">Allergy Info</label>
                  <input type="text" class="form-control" id="Allergy" placeholder="Enter any allergy info the product might have" name="txtAllergy">
                </div>
				
				<div class="form-group">
                  <label for="exampleInputPrice">Discount %</label>
                  <input type="number" class="form-control" id="Dis" placeholder="Enter Discount %" name="txtDis">
                </div>			
               
                <div class="form-group">
                  <label for="exampleInputFile">Choose thumbnail</label>
                  <input type="file" name="product_image">

                  <p class="help-block">Upload product image.</p>
                </div>
               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="addprod" class="btn btn-success">Add</button>
              </div>
            </form>
          </div>
      </section>
    <!-- /.content -->
  </div>
   <!-- /.content-wrapper -->
 <?php include('includes/footer.php'); ?>
<script type="text/javascript">    
    $(function() {
        $('#Sf').datepicker('show'){
            format: 'YYYY-MM-DD'
        };
    });  

</script>
<!-- ./wrapper -->
<?php include('includes/script.php'); ?>
</body>
</html>
