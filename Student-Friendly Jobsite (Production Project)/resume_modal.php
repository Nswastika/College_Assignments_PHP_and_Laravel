<?php
include 'filesLogic.php';
?>
<!-- Edit Profile -->
<div class="modal fade" id="resume">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Upload Resume</b></h4>
            </div>
            <div class="modal-body">
               <form role="form" method="post" action="resume_modal.php" enctype="multipart/form-data">
                <p style="color:red; text-align:justify">Important! Upload your resume with your personal details, academic qualifications, 
                skills and College Name. Don't have a resume ?<a href="create_resume.php"><strong>&nbsp;Create Now</strong></a></p>
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label"></label>
                    <div class="col-12">
                      <input type="file"  name="myfile">
                    </div>
                <div class="col-12">
                  <select class="form-control" name="job_id" style = "display: none;">								
								    <?php
                      $conn = mysqli_connect("localhost","root");
                      $sql2 = mysqli_select_db($conn, 'Students_Jobsite');
									    $sql2 = "SELECT * FROM job WHERE job_id=$jobno";
									    $result2 = mysqli_query($conn,$sql2);								
									    while ($row = mysqli_fetch_assoc($result2)){ ?>
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
              <button type="update" class="btn btn-success btn-flat" name="update"><i class="fa fa-check-square-o"></i> Send</button>
              </form>
            </div>
        </div>
    </div>
</div>