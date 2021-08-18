<?php
    session_start(); 
    include 'includes/header.php';
    include 'includes/connection.php';
?>
 <section class="inner-banner" style="background:#242c36 url(images/xxxx.jpg) no-repeat">
		<div class="container">
			<div class="caption">
				<h2>Advices</h2>
				<p>Get your dream jobs <span>2021</span></p>
			</div>
		</div>
	</section>
    
  <!-- HOME -->
  <section class="pricind">
	<div class="container">
        <?php $conn = mysqli_connect("localhost","root");
        $detail = mysqli_select_db($conn, 'Students_Jobsite');
        $detail="SELECT * FROM advice";
        $stid = mysqli_query($conn, $detail);
        while (($row = mysqli_fetch_assoc($stid)) != false) {?>
            <div class ="col-md-6 col-sm-6">
				    <div class="col-md-6 col-sm-6">
					      <div class="package-box"  style="height:180px; border-radius: 50%; width:180px; background:url(<?php echo $row['advisor_image']; ?>) no-repeat">									
					      </div>
				    </div>		
				    <div class="col-md-6 col-sm-6"  style="text-align:justify;">
					    <div >
                           <p><strong><?php echo $row['advisor_name']; ?></strong></br><?php echo $row['advice_description']; ?></p>	
					    </div>
                    </div>
            </div>
        <?php } ?> 
	</div>
  </section>    
<?php include 'includes/footer.php'; ?>
