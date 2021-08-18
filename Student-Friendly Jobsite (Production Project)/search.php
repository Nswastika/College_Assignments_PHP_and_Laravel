<?php include 'includes/session.php';
header('Cache-Control: no-cache');?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/conn.php'; ?>

<!-- Inner Banner -->
<section class="inner-banner" style="background:#242c36 url(images/xxxx.jpg) no-repeat">
	<div class="container">
		<div class="caption">
			<h2>Get your jobs</h2>
			<p>Get your dream jobs <span>2021</span></p>
		</div>
	</div>
</section>

<!-- Main content -->
<section class="jobs">
	<div class="container">
	    <form form method="POST" action="search.php">
			<fieldset>
		        <?php	
	       			$conn = $pdo->open();
	       			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM job WHERE job_name LIKE :keyword AND job_location  LIKE :keyword1 AND emp_status LIKE :keyword2 AND is_activated = '1'");
	       			$stmt->execute(['keyword' => '%'.$_POST['keyword'].'%', 'keyword1' => '%'.$_POST['keyword1'].'%', 'keyword2' => '%'.$_POST['keyword2'].'%']);
	       			$row = $stmt->fetch();
	       			if($row['numrows'] < 1){
	       				echo '<h1 class="page-header">No results found for <i>'.$_POST['keyword'].'</i></h1>';
	       			}
	       			else{
	       				echo '<h1 class="page-header">Search results for <i>'.$_POST['keyword'].'</i></h1>';
		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM job WHERE job_name LIKE :keyword AND job_location  LIKE :keyword1 AND emp_status LIKE :keyword2 AND is_activated = '1'");
						    $stmt->execute(['keyword' => '%'.$_POST['keyword'].'%', 'keyword1' => '%'.$_POST['keyword1'].'%', 'keyword2' => '%'.$_POST['keyword2'].'%']);
					 
						    foreach ($stmt as $row) {
						    	$highlighted = preg_filter('/' . preg_quote($_POST['keyword'],'/') . '/i', '<b>$0</b>', $row['job_name']);
                                $highlighted1 = preg_filter('/' . preg_quote($_POST['keyword1'], '/') . '/i', '<b>$0</b>', $row['job_location']);
                                $highlighted2 = preg_filter('/' . preg_quote($_POST['keyword2'], '/') . '/i', '<b>$0</b>', $row['emp_status']);
						    	$image = (!empty($row['company_image'])) ? ''.$row['company_image'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='companies'>";
	       						echo "
								   
								<div class='company-list'>
								<div class = 'row'>
								   <div class='col-md-2 col-sm-2'>
								        <div class='company-logo'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' class='img-responsive' alt='' />		       									
											</div>
									    </div>
								    </div>
									<div class='col-md-8 col-sm-8'>
										<div class='company-content'>
											<h3>".$row['job_name']."</h3>
											<p><span class='company-name'><i class='fa fa-briefcase'></i>".$row['company_name']."</span><span class='company-location'><i class='fa fa-map-marker'></i>".$row['job_location']."</span><span class='package'><i class='fa fa-money'></i>".$row['salary']."</span></p>
										</div>
									</div>
									<div class='col-md-2 col-sm-2'>
									    <a style='color:white;' class='btn view-job' href='company-detail.php?id=".$row['job_id'].";'>View Job</a>          
										</div>
								</div>
																	
									";
	       						echo "</div>";
						    }
						  
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}
					}
					$pdo->close();?> 	        	
	    </div>	
		 </form>
		</fieldset>        	
	</div>
</section>
<?php include 'includes/footer.php'; ?>
