<?php
    session_start(); 
    include 'includes/header.php';
    include 'includes/connection.php';
    if(isset($_SESSION['user_id'])){
        $USER_ID = $_SESSION['user_id'];    
    }else{
        header('location:login.php');
    }
    
    $fname = "Not Available";
    $lname = "Not Available";
    $email = "Not Available";
    $address = "Not Available";
    $dates = "Not Available";
    $created = "Not Available";     
    $image = "Not Available";
?>

<section class="inner-banner" style="background:#242c36 url(images/xxxx.jpg) no-repeat">
	<div class="container">
		<div class="caption">
			<h2>Profile</h2>
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
    $detail="SELECT * FROM  users WHERE user_id= '$user_id'";
    $stid = mysqli_query($conn, $detail);
    while (($row = mysqli_fetch_assoc($stid)) != false) {
        $userid = $row['user_id'];
        $fname = $row['user_first_name'];
        $email = $row['user_email'];
        $address = $row['user_address'];
        $created = $row['user_created_at'];
        $image = $row['user_image'];
    ?>
    <div class="col-md-12 col-sm-12">
	    <div class="col-md-2 col-sm-2">
		</div>				
		<div class="col-md-3 col-sm-3"  style="height:180px; text-align:justify;">
			<div style="height:180px; width: 100%;">
            <?php
                if ($image == 'images/') {?>
                    <img src="images/profile.jpg" width="80%"><?php
                }else { ?>
                    <img src="<?php echo $image;?>" >
            <?php } ?>
            </div>	
        </div>
        <div class="col-md-3 col-sm-3"  style="height:360px; text-align:justify;">
            <div >
                <p><strong>Name</strong><br/><?php echo $fname?></p>
                <p><strong>Phone</strong><br/>+977 9876543210</p>
                <p><strong>Email</strong><br/><?php echo $email?></p>
                <p><strong>Address</strong><br/><?php echo $address?></p>
                <p><strong>Member since</strong><br/><?php echo $created?></p>
			</div>           
        </div>
        <div class="col-md-2 col-sm-2">
            <a href="#edit" class="btn btn-success btn-flat btn-sm" data-toggle="modal"><i class="fa fa-edit" name ="edit"></i> Edit</a>
        </div>      
    </div><br/>
    <div class="col-md-12 col-sm-12">
        <div class="col-md-3 col-sm-3">
        </div>
        <div class="col-md-6 col-sm-6">
            <p><strong> Did you get a dream job? </strong>&nbsp;              
            <a href="add_success_story.php" class="btn btn-danger"><i class="fa fa-plus" name ="edit"></i> Write Success Story</a></p>
        </div>
        <div class="col-md-3 col-sm-3">
        </div>
    </div>
    </div>
</section>
    
<?php 
    include 'includes/footer.php';
    include 'profile_modal.php';
?>
