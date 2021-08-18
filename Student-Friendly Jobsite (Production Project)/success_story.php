<?php
    session_start(); 
    include 'includes/header.php';
    include 'includes/connection.php';
?>
  <section class="inner-banner" style="background:#242c36 url(images/xxxx.jpg) no-repeat">
		<div class="container">
			<div class="caption">
				<h2>Success Stories</h2>
				<p>Get your dream jobs <span>2021</span></p>
			</div>
		</div>
	</section>
  <!-- HOME -->
  <section class="pricind">
		<div class="container">
      <?php
        $conn = mysqli_connect("localhost","root");
        $detail = mysqli_select_db($conn, 'Students_Jobsite');
        $detail="SELECT * FROM success_story where active = 1";
        $stid = mysqli_query($conn, $detail);
        while (($row = mysqli_fetch_assoc($stid)) != false) {?>
        <div class ="col-md-12 col-sm-12">
				  <div class="col-md-4 col-sm-4">
					
            <img src= "<?php echo $row['success_student_image']; ?>" style="height:180px; border-radius: 20%;">
				  </div>		
				  <div class="col-md-8 col-sm-8"  style="text-align:justify;">
					  <div >
                <p><strong><?php echo $row['success_student_name']; ?></strong></br><?php echo $row['success_description']; ?></br><?php echo $row['success_job_name']; ?></p>	
				   	</div>
          </div>
        </div>
        <?php } ?> 
	    </div>
  </section>   
<?php 
  include 'includes/footer.php';
?>
