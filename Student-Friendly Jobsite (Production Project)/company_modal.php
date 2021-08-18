<?php
include 'includes/connection.php'; 
$conn = mysqli_connect("localhost","root");

if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];}
else{
  header('location:login.php');
}
$detail = mysqli_select_db($conn, 'Students_Jobsite');
      
     
if (isset ($_GET['id'])) {
  $_SESSION["jobno"] = $_GET['id'];
}
  $jobno = $_SESSION["jobno"];

  if(isset($_POST['submit'])){
    unset($_POST['submit']);    
    $message = $_POST["message"];
    $user_id = $_SESSION["user_id"];
    $fk_user_id = $_POST['fk_user_id'];
    $user_email = $_POST['user_email'];
    $detail = "INSERT INTO message(message, user_id, job_id, fk_user_id, user_email, active) VALUES ('$message', '$user_id', '$jobno', '$fk_user_id', '$user_email', 0)";
    $detailqry = mysqli_query($conn, $detail);     
    echo "<script>alert('Message is successfully sent.');window.location.href='$location';</script>";
 
} ?>

<!-- Edit Profile -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Write Message</b></h4>
            </div>
            <div class="modal-body">
               <form role="form" method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    
                    <div class="col-12">
                      <input type="text" class="form-control" id="firstname" name="message">
                    </div>

                    <div class="col-12" >
                      <select class="form-control" name="job_id" style = "display: none;">								
								      <?php
                        $conn = mysqli_connect("localhost","root");
                        $sql2 = mysqli_select_db($conn, 'Students_Jobsite');
									      $sql2 = "SELECT * FROM job WHERE job_id=$jobno";
									      $result2 = mysqli_query($conn,$sql2);
												while ($row = mysqli_fetch_assoc($result2)){	?>
										      <option value="<?php echo $row['job_id']; ?>">
											      <?php echo $row['job_id']; ?>
										      </option>
										    <?php } ?>
							        </select>	
                    </div>

                    <div class="col-12">
                      <select class="form-control" name="fk_user_id" style = "display: none;">								
								      <?php
                        $conn = mysqli_connect("localhost","root");
                        $sql2 = mysqli_select_db($conn, 'Students_Jobsite');
									      $sql2 = "SELECT * FROM job WHERE job_id=$jobno";
									      $result2 = mysqli_query($conn,$sql2);										
									      while ($row = mysqli_fetch_assoc($result2)){	?>
										      <option value="<?php echo $row['user_id']; ?>">
											      <?php echo $row['user_id']; ?>
										      </option>
										    <?php } ?>
							        </select>	
                    </div>

                    <div class="col-12">
                      <select class="form-control" name="user_email" style = "display: none;">								
								      <?php
                        $conn = mysqli_connect("localhost","root");
                        $sql2 = mysqli_select_db($conn, 'Students_Jobsite');
									      $sql2 = "SELECT * FROM users where user_id = $user_id";
									      $result2 = mysqli_query($conn,$sql2);												
									      while ($row = mysqli_fetch_assoc($result2)){	?>
										      <option value="<?php echo $row['user_email']; ?>">
											      <?php echo $row['user_email']; ?>
										      </option>
										    <?php } ?>
							       </select>	
                   </div>
                </div>              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="submit"><i class="fa fa-check-square-o"></i> Send</button>
                          
              </form>
            </div>
        </div>
    </div>
</div>