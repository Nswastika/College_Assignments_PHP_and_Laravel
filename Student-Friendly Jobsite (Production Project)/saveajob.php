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

if(isset($_POST['submit1'])){
  unset($_POST['submit1']);
      
  $user_id = $_SESSION["user_id"];
  $fk_user_id = $_POST['fk_user_id'];
        
  $detail = "INSERT INTO save_jobs(user_id, job_id, fk_user_id) VALUES ('$user_id', '$jobno', '$fk_user_id')";
  $detailqry = mysqli_query($conn, $detail);     
    echo "<script>alert('Job is successfully saved.');window.location.href='$location';</script>";
}
?>


<div class="modal fade" id="saveajob">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Save a Job</b></h4>
            </div>
            <div class="modal-body">
               <form role="form" method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-12" >
                      <select class="form-control" name="job_id" style = "display: none;">								
								        <?php
                          $conn = mysqli_connect("localhost","root");
                          $sql2 = mysqli_select_db($conn, 'Students_Jobsite');
									        $sql2 = "SELECT * FROM job WHERE job_id=$jobno";
									        $result2 = mysqli_query($conn,$sql2);								
								      	  while ($row = mysqli_fetch_assoc($result2)){									
										    ?>
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
									          while ($row = mysqli_fetch_assoc($result2)){?>
										          <option value="<?php echo $row['user_id']; ?>">
											          <?php echo $row['user_id']; ?>
										          </option>
										    <?php } ?>
							        </select>	
                    </div>
                    <div class="col-12">
                      <p>Do you want to save this job?</p> 
                      
                      <button type="submit" class="btn btn-success btn-flat pull-left" name="submit1"><i class="fa fa-check-square-o"></i> Yes</button>&nbsp;&nbsp;&nbsp;&nbsp;
                      <button type="button" class="btn btn-danger btn-flat " data-dismiss="modal"><i class="fa fa-close"></i>No</button>
                    </div>
                  </div>               
                </div>
                <div class="modal-footer">
                   
            </form>
            </div>
        </div>
    </div>
</div>