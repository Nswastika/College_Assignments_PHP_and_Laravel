<?php 
    include 'includes/connection.php';
    include 'includes/session.php';
    include "includes/header.php";
?>
<section class="inner-banner" style="background:#242c36 url(images/xxxx.jpg) no-repeat">
	<div class="container">
		<div class="caption">
			<h2>Sign Up</h2>
			<p>Get your dream jobs <span>2021</span></p>
		</div>
	</div>
</section>
		
<!-- login section start -->
<section class="login-wrapper">
	<div class="container">
		<div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2" style=" border: 2px solid white; border-style: ridge; border-radius: 12px;">
    <img class="img-responsive" alt="logo" src="images/logooo.jpg">

    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    $isRegistered = false;
    $fname = $address = $email = $pass = $repass = $user_type = "";
    $username="";
    $rowCount=0;
    $set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code=substr(str_shuffle($set), 0, 12);
    if(isset($_POST['submit'])){
    
      $fname =$_POST['fname'];
      $address = $_POST['address'];
      $email = $_POST['email'];
      $pass = $_POST['pass'];
      $repass = $_POST['repass'];
      $user_type = "Student";
      $username = $_POST['username'];
      $category_id = $_POST['category_id'];  

      $hashed_pass = md5($pass);
      date_default_timezone_set('Asia/Kathmandu');        
      $date = date("Y-m-d h:i:sA"); 
      $conn = mysqli_connect("localhost","root");
  
    // Select Database
    if (!$conn) {
      error_log("Failed to connect to MySQL: " . mysqli_error($connection));
      die('Internal server error');
    }

    // 2. Select a database to use 
    $detail = mysqli_select_db($conn, 'Students_Jobsite');
    if (!$detail) {
      error_log("Database selection failed: " . mysqli_error($connection));
      die('Internal server error');
    }

    $detail="SELECT * FROM users WHERE user_email='$email'";
    $detailqry = mysqli_query($conn, $detail);
    while($row = mysqli_fetch_array($detailqry)){
      $rowCount++;
    }

    if($rowCount==0){
      if($repass == $pass){
        $pass = $pass;
        if(strtoupper($user_type) == 'STUDENT'){           
          $sql = "INSERT INTO users(user_first_name, user_username, user_address, user_email, user_password, user_type, active, user_created_at, category_id) VALUES 
          ('$fname', '$username', '$address', '$email', '$hashed_pass', '$user_type', '0', '$date', '$category_id')";             
          $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));        
          
          $message = "
          <h2>Thank you for Registering.</h2>
          <p>Your Account:</p>
          <p>Email: ".$email."</p>
          <p>Please click the link below to activate your account.</p>
          <a href='http://localhost/Student_Job/activate.php?code=".$code."&useremail=".$email."'>Activate Account</a>
          ";
          //Load phpmailer
          require 'vendor/vendor/autoload.php';
          $mail = new PHPMailer(true);                             
          try {
            //Server settings
            $mail->isSMTP();                                     
            $mail->Host = 'smtp.gmail.com';                      
            $mail->SMTPAuth = true;                               
            $mail->Username = 'jobstudents31@gmail.com';     
            $mail->Password = 'job4students';                    
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );                         
            $mail->SMTPSecure = 'ssl';                           
            $mail->Port = 465;
            $mail->setFrom('jobstudents31@gmail.com');
            //Recipients
            $mail->addAddress($email);              
            $mail->addReplyTo('jobstudents31@gmail.com');
            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = 'J4S Sign Up';
            $mail->Body    = $message;
            $mail->send();
            unset($_SESSION['fname']);
            unset($_SESSION['address']);
            unset($_SESSION['email']);
            unset($_SESSION['username']);
            unset($_SESSION['user_type']);
            echo "<div class='col-md-12 col-sm-12 col-md-offset-0 col-sm-offset-2' style='background-color:#c1f7d2; height:50px; border-style:round; border: 2px;
            border-radius: 5px; '><p style='text:justify; text-align: center; color:green;'>Account created. Check your email to activate. !</p>
            </div><br/><br/>";
          } 
          catch (Exception $e) {
            echo"<div class='col-md-12 col-sm-12 col-md-offset-0 col-sm-offset-2' style='background-color:#ffdbdd; height:70px; border-style:round; border: 2px;
            border-radius: 5px; '><p style='text:justify; text-align: center; color:red;'>Message could not be sent. Mailer Error: '.$mail->ErrorInfo' !</p>
            </div><br/><br/><br/>";


            
          }
         
        }
       
      }
      else{
          if($repass != ""){              
              echo"<div class='col-md-12 col-sm-12 col-md-offset-0 col-sm-offset-2' style='background-color:#ffdbdd; height:50px; border-style:round; border: 2px;
            border-radius: 5px; '><p style='text:justify; text-align: center; color:red;'>Your confirm Password does not match !</p>
            </div><br/><br/><br/>";
          }           
      }
    }
    else{
        $isRegistered = true;
        echo"<div class='col-md-12 col-sm-12 col-md-offset-0 col-sm-offset-2' style='background-color:#ffdbdd; height:50px; border-style:round; border: 2px;
            border-radius: 5px; '><p style='text:justify; text-align: center; color:red;'>User Already Registered. Please Enter new email !</p>
            </div><br/><br/>";
    }
  }

?>        
          <form action="" method="post">
              <select class="invisible" disabled required id="exampleInputType" name="user_type">    
                  <option <?php if($user_type=="Student"){echo "selected";}?>>Student</option>       
              </select>
						  <input type="text" class="form-control input-lg" required name="fname" placeholder="Name" value = "<?php if($fname!=""){echo $fname;}?>">
              <input type="text" class="form-control input-lg" required name="username" placeholder="Username" value = "<?php if($username!=""){echo $username;}?>">
						  <input type="email" class="form-control input-lg" required name="email" placeholder="Email" value = "<?php if($email!="" AND $isRegistered==false){echo $email;}?>">
						  <input type="password" class="form-control input-lg" required name="pass" placeholder="Password" value = "<?php if($pass!=""){echo $pass;}?>">
              <input type="password" required class="form-control input-lg" required name="repass" placeholder="Re-Password">
              <select class="form-control" name="category_id" required>					
                <option value="" disabled selected>Choose Job Category:</option>			
								<?php
                $conn = mysqli_connect("localhost","root");
                $sql2 = mysqli_select_db($conn, 'Students_Jobsite');
									$sql2 = "SELECT * FROM category";
									$result2 = mysqli_query($conn,$sql2);
															
									while ($row = mysqli_fetch_assoc($result2)){									
										?>
                    
										<option value="<?php echo $row['category_id']; ?>">
											<?php echo $row['categoryname']; ?>
										</option>
										<?php
									}
								?>
							</select>	
              <input type="text" class="form-control input-lg" name="address" placeholder="Address" value = "<?php if($address!=""){echo $address;}?>">               
              <input style="background-color:#ff8f3e;" type="submit" name="submit" value="Register" class="btn px-4 btn-primary text-white">
              <h1></h1>
          </form>    
				</div>   
			</div>  
		</section>
	
<?php include "includes/footer.php"; ?>