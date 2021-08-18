<?php
  include 'includes/connection.php';
  $txtPass="";
  $conn = mysqli_connect("localhost","root");
  if(isset($_SESSION['user_id'])){
    $USER_ID = $_SESSION['user_id'];
    if (!$conn) {
        error_log("Failed to connect to MySQL: " . mysqli_error($connection));
        die('Internal server error');
      }  
      // 2. Select a database to use 
      $detail = mysqli_select_db($conn, 'Students_Jobsite');
      if (!$detail) {
        error_log("Database selection failed: " . mysqli_error($connection));
        die('Internal server error');
      }
     
    $detail = "SELECT * FROM users WHERE user_id = $user_id";
    $detailqry = mysqli_query($conn, $detail);
   
    while($row = mysqli_fetch_assoc($detailqry)){
      $txtFirstName = $row['user_first_name'];
      
      $txtAddress = $row['user_address'];
      $txtEmail = $row['user_email'];
    
      $txtPass = $row['user_password'];
      $image = $row['user_image'];       
    }
  }else{
    header('location:login.php');
  }

  $date = date('m-d-Y');
  if (isset($_POST['edit'])){
    $fname=$_POST['fname']; 
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $address = $_POST['address'];
    $filename = $_FILES["uploadfile"]["name"]; 
    $tempname = $_FILES["uploadfile"]["tmp_name"];     
        $folder = "images/".$filename; 
        if (move_uploaded_file($tempname, $folder))  { 
            $msg = "Image uploaded successfully"; 
        }else{ 
            $msg = "Failed to upload image"; 
      } 
  
  if($txtPass == $pass){
    $sql = "UPDATE users SET user_first_name = '$fname',  user_address = '$address',  user_image = '$folder' WHERE user_id = '$user_id'";
  }else{
    $pass = md5($pass);
    $sql = "UPDATE users SET user_first_name = '$fname', user_address = '$address',  user_password ='$pass', user_image = '$folder'  WHERE user_id = '$user_id'";
  } 
  
  $result = mysqli_query($conn,$sql);

  echo "<script>alert('You have sucessfully Edited Your Detail.');window.location.href='student_profile.php';</script>";} 
  
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