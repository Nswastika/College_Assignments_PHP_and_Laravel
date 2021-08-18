<?php
session_start();
include 'includes/header.php';
include ('includes/connection.php');
if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];    
}else{
  header('location:login.php');
}
$conn = mysqli_connect("localhost","root");
$sql = mysqli_select_db($conn, 'Students_Jobsite');
  
?>

<section class="inner-banner" style="backend:#242c36 url(https://via.placeholder.com/1920x600)no-repeat;">
			<div class="container">
				<div class="caption">
					<h2>Applied jobs</h2>
					<p>Get your Popular jobs <span>2021 New job</span></p>
				</div>
			</div>
</section><br/><br/>


<div class="container">
  <div class="row">
    <div style="overflow-x:auto;">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col-md-3 col-sm-3">Job Name</th>
            <th scope="col-md-3 col-sm-3">Applied Date</th>
            <th scope="col-md-3 col-sm-3">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $detail="SELECT job.job_id, job.job_name, resumes.status, resumes.applied_date FROM resumes, job where resumes.job_id = job.job_id AND resumes.user_id = '$user_id'";
            $detailqry = mysqli_query($conn, $detail);
            while($row = mysqli_fetch_array($detailqry)){
          ?>
          <tr>
            <td><?php echo $row['job_name'];?></td>
            <td><?php echo $row['applied_date'];?></td>
            <td><?php echo $row['status'];?></td>
         </tr>
          <?php }  ?>
        </tbody>
     </table><br/><br/><br/><br/>
    </div>
  </div>
</div>

<?php include 'includes/footer.php';?>