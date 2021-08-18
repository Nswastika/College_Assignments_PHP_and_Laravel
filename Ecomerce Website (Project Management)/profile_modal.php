<?php
  include 'includes/connect.php';
  
  $txtPass="";
  if(isset($_SESSION['USER_ID'])){
    $USER_ID = $_SESSION['USER_ID'];
    $detail = "SELECT * FROM USERS WHERE USER_ID = $USER_ID";
    $detailqry = oci_parse($conn, $detail);
    oci_execute($detailqry);
    while($row = oci_fetch_assoc($detailqry)){
      $txtFirstName = $row['USER_FIRST_NAME'];
      $txtLastName = $row['USER_LAST_NAME'];
      $txtAddress = $row['USER_ADDRESS'];
      $txtEmail = $row['USER_EMAIL'];
      $dates = $row['DATE_OF_BIRTH'];
      $txtPass = $row['USER_PASSWORD'];
      $image = $row['USER_IMAGE'];  
        
     
    }
  }else{
    header('location:login.php');
  }


$date = date('m-d-Y');
if (isset($_POST['edit'])){
  $fname=$_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $address = $_POST['address'];
  $dates = $_POST['dates'];
  $filename = $_FILES["uploadfile"]["name"]; 
    $tempname = $_FILES["uploadfile"]["tmp_name"];     
        $folder = "image/".$filename; 
        if (move_uploaded_file($tempname, $folder))  { 
            $msg = "Image uploaded successfully"; 
        }else{ 
            $msg = "Failed to upload image"; 
      } 
  
  if($txtPass == $pass){
    $sql = "UPDATE USERS SET USER_FIRST_NAME = '$fname', USER_LAST_NAME='$lname', USER_ADDRESS = '$address', DATE_OF_BIRTH = '$dates', USER_IMAGE = '$folder' WHERE USER_ID = '$USER_ID'";
  }else{
    $pass = md5($pass);
    $sql = "UPDATE USERS SET USER_FIRST_NAME = '$fname', USER_LAST_NAME='$lname', USER_ADDRESS = '$address', DATE_OF_BIRTH = '$dates', USER_PASSWORD='$pass', USER_IMAGE = '$folder'  WHERE USER_ID = '$USER_ID'";
  } 
  
  $result = oci_parse($conn,$sql);
  oci_execute($result);
  if(!oci_error()){echo "<script>alert('You have sucessfully Edited Your Detail.');window.location.href='profile.php';</script>";}
  //header('location:viewuser.php');//redirect to view profie page
 
}

?>



<!-- Edit Profile -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Update Account</b></h4>
            </div>
            <div class="modal-body">
               <form role="form" method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-12">
                      <input type="text" class="form-control" id="firstname" name="fname" value="<?php echo $txtFirstName?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-12">
                      <input type="text" class="form-control" id="lastname" name="lname" value="<?php echo $txtLastName?>">
                    </div>
                </div>


                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>

                    <div class="col-12">
                      <input type="text" class="form-control" id="email" name="email" value="<?php echo $txtEmail?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>

                    <div class="col-12">
                      <input type="password" class="form-control" id="password" name="pass" value="<?php echo $txtPass?>">
                    </div>
                </div>
               
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Address</label>

                    <div class="col-12">
                       <input type="text" class="form-control" id="exampleInputAddress" placeholder="Enter address" name="address" value="<?php echo $txtAddress?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="dateofbirth" class="col-sm-3 control-label">DOB</label>
                    <div class="col-12">
                      <input type="text" class="form-control" id="dateofbirth" name="dates" value="<?php echo $dates?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-6 control-label">Upload your photo</label>
                    <div class="col-12">
                    <input type="file" name="uploadfile" value="" /> 
                    </div>
                </div>
                <hr>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>