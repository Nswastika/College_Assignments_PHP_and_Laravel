
<?php
include('db.php');
if (isset($_GET["key"]) && isset($_GET["email"])
&& isset($_GET["action"]) && ($_GET["action"]=="reset")
&& !isset($_POST["action"])){
$key = $_GET["key"];
$email = $_GET["email"];
$curDate = date("Y-m-d H:i:s");
$query = mysqli_query($con,"SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';");
$row = mysqli_num_rows($query);
if ($row==""){
  $location = 'login.php';
  $error .= "<script>alert('The link is expired. You are trying to use the expired link which as valid only 24 hours');window.location.href='$location';</script>";
}else{
  $row = mysqli_fetch_assoc($query);
  $expDate = $row['expDate'];
  if ($expDate >= $curDate){ ?> <br />
    <?php include 'includes/header.php'; ?>
    <section class="inner-banner" style="background:#242c36 url(images/xxxx.jpg) no-repeat">
		<div class="container">
			<div class="caption">
				<h2>Reset Password</h2>
				<p>Get your dream jobs <span>2021</span></p>
			</div>
		</div>
	</section>


	<section class="login-wrapper">
		<div class="container" >
			<div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2" style=" border: 2px solid white; border-style: ridge; border-radius: 12px;">
	            <form method="post" action="" name="update">
	                <img class="img-responsive" alt="logo" src="images/logooo.jpg">
	                <input type="hidden" name="action" value="update" />
	                <input class="form-control input-lg" placeholder="Enter your New Password"  type="password" name="pass1" id="pass1" maxlength="15" required />
	                <input class="form-control input-lg" placeholder="Re-enter New Password"  type="password" name="pass2" id="pass2" maxlength="15" required/>
	                <input type="hidden" name="email" value="<?php echo $email;?>"/>
	                <button style="background-color:#ff8f3e;" type="submit" name="submit" value="Reset Password" class="btn px-4 btn-primary text-white">Reset Password</button><br/><br/>
	            </form>
                <?php }
				else{
	                $location = 'login.php';
                    $error .= "<script>alert('The link is expired. You are trying to use the expired link which as valid only 24 hours');window.location.href='$location';</script>";
				} }
                if($error!=""){
	                echo "<div class='error'>".$error."</div><br />";
	            } } 

                   if(isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"]=="update")){
					$error="";
                    $pass1 = mysqli_real_escape_string($con,$_POST["pass1"]);
                    $pass2 = mysqli_real_escape_string($con,$_POST["pass2"]);
                    $email = $_POST["email"];
                    $curDate = date("Y-m-d H:i:s");
                        if ($pass1!=$pass2){
	                        $location = 'login.php';
		                    $error .= "<script>alert('Password do not match. Both password should be same.');window.location.href='$location';</script>";
		                }
	                        if($error!=""){
		                        echo "<script>".$error."<script>";
		                    }else{
                            $pass1 = md5($pass1);
                            mysqli_query($con,"UPDATE `users` SET `user_password`='".$pass1."' WHERE `user_email`='".$email."';");	
                            mysqli_query($con,"DELETE FROM `password_reset_temp` WHERE `email`='".$email."';");		
                            $location = 'login.php';
                            echo "<script>alert('Congratulations! Your password has been updated successfully.');window.location.href='$location';</script>";
					    }		
					}?>
                </div>
			</div>
		</section>
<?php include 'includes/footer.php'; ?>