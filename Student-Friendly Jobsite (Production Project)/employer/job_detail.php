<?php include 'includes/header.php'; 
include 'includes/sidebar.php'; 
 include ('../includes/connection.php');
include ('imageupload.php');
  $conn = mysqli_connect("localhost","root");
  $detail = mysqli_select_db($conn, 'Students_Jobsite');
if(isset($_GET['sid'])){	
  $error_count=0;
	$sid = $_GET['sid'];
	$detail = "SELECT * FROM job WHERE job_id = $sid";
	$detailqry = mysqli_query($conn, $detail);
	while($row = mysqli_fetch_assoc($detailqry)){
     

?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    
    <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Job Details</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" id="form-sample-1" method="post" action="" enctype="multipart/form-data" novalidate="novalidate">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"><strong>Title:</strong></label>
                                <div class="col-sm-10">
                                <?php echo $row['job_name'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"><strong>Location:</strong></label>
                                <div class="col-sm-10">
                                <?php echo $row['job_location'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"><strong>Time:</strong></label>
                                <div class="col-sm-10">
                                <?php echo $row['job_time'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"><strong>Vacancy:</strong></label>
                                <div class="col-sm-10">
                                <?php echo $row['vacancy'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"><strong>Company Name:</strong></label>
                                <div class="col-sm-10">
                                <?php echo $row['company_name'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"><strong>Employment Status:</strong></label>
                                <div class="col-sm-10">
                                <?php echo $row['emp_status'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"><strong>Salary:</strong></label>
                                <div class="col-sm-10">
                                <?php echo $row['salary'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"><strong>Deadline:</strong></label>
                                <div class="col-sm-10">
                                <?php echo $row['job_deadline'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"><strong>Description:</strong></label>
                                <div class="col-sm-10">
                                <?php echo $row['job_description'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"><strong>Responsibility:</strong></label>
                                <div class="col-sm-10">
                                <?php echo $row['responsibilities'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <?php echo $row['responsibilities1'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <?php echo $row['responsibilities2'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <?php echo $row['responsibilities3'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <?php echo $row['responsibilities4'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <?php echo $row['responsibilities5'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"><strong>Education</strong></label>
                                <div class="col-sm-10">
                                <?php echo $row['education'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <?php echo $row['education1'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <?php echo $row['education2'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <?php echo $row['education3'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <?php echo $row['education4'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <?php echo $row['education5'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"><strong>Benefits</strong></label>
                                <div class="col-sm-10">
                                <?php echo $row['benefits'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <?php echo $row['benefits1'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <?php echo $row['benefits2'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <?php echo $row['benefits3'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <?php echo $row['benefits4'];?><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <?php echo $row['benefits5'];?><br/><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"><strong>Image</strong></label>
                                <div class="col-sm-10">
                                <img style="height:120px; width:100px;" class="img-responsive" src="../<?php echo $row['company_image'];?>" alt="No Image Found"><br/><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"><strong></strong></label>
                                <div class="col-sm-10">
                                <a class="btn btn-warning btn-sm" href="edit_job.php?sid=<?php echo $row['job_id']; ?>">Edit
                                <i class="fa fa-pencil"></i>                
                                </a>							
                                </div>
                               
                            </div>
                            
    
                            <?php } }?>
                    </div>
                </div>






  

  <?php include('includes/footer.php'); ?>

