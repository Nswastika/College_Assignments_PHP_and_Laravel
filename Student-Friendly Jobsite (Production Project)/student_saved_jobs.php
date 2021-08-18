<?php
  session_start();
  include 'includes/header.php';
  if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];    
  }else{
    header('location:login.php');
  }
  include ('includes/connection.php');
  $conn = mysqli_connect("localhost","root");
  $sql = mysqli_select_db($conn, 'Students_Jobsite');
  
?>

<section class="inner-banner" style="backend:#242c36 url(https://via.placeholder.com/1920x600)no-repeat;">
			<div class="container">
				<div class="caption">
					<h2>Saved jobs</h2>
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
            <th scope="col-md-3 col-sm-3">Job Deadline</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $detail="SELECT job.job_id, job.job_name, job.job_deadline FROM save_jobs, job where save_jobs.job_id = job.job_id AND save_jobs.user_id = '$user_id'";
            $detailqry = mysqli_query($conn, $detail);
            while($row = mysqli_fetch_array($detailqry)){
          ?>
          <tr>
            <td><a href ="#"><?php echo $row['job_name'];?></a></td>
            <td><?php echo $row['job_deadline'];?></td>
          </tr>
          <?php } ?>
       </tbody>
      </table><br/><br/><br/><br/>
    </div>
  </div>
</div>

<?php include 'includes/footer.php';?>