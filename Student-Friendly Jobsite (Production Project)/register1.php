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
    if (!preg_match("/^[a-zA-Z]*$/",$_POST['fname'])) {
      $_SESSION['VALIDATIONERROR'] = "Only letters allowed";
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $_SESSION['VALIDATIONERROR'] = "Invalid email format";
    }
    if (strlen($_POST['pass']) < 8) {
      $_SESSION['VALIDATIONERROR'] = "Password must be more than 8 characters";
    }
    if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST['username'])) {
      $_SESSION['VALIDATIONERROR'] = "Only letters and numbers allowed";
    }
  }


  if(isset($_POST['submit']) && $_SESSION['VALIDATIONERROR'] != NULL){
    $fname =$_POST['fname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];
    $user_type = "Employer";
    $username = $_POST['username'];
    
    


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
        if(strtoupper($user_type) == 'EMPLOYER'){           
          $sql = "INSERT INTO users(user_first_name, user_username, user_address, user_email, user_password, user_type, active, user_created_at) VALUES 
          ('$fname', '$username', '$address', '$email', '$hashed_pass', '$user_type', '0', '$date')";             
          $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));        
          
          $message = "
          <h2>Thank you for Registering.</h2>
          <p>Your Account:</p>
          <p>Email: ".$email."</p>
          <p>Your account will be manually verified by an Admin within 24 hours. </p>
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
            $mail->Subject = 'Students Jobsite Sign Up';
            $mail->Body    = $message;
            $mail->send();
            unset($_SESSION['fname']);
            unset($_SESSION['address']);
            unset($_SESSION['email']);
            unset($_SESSION['username']);
            unset($_SESSION['user_type']);
            echo "<div class='col-md-12 col-sm-12 col-md-offset-0 col-sm-offset-2' style='background-color:#c1f7d2; height:70px; border-style:round; border: 2px;
            border-radius: 5px; '><p style='text:justify; text-align: center; color:green;'>Your account will be manually verified by an Admin within 24 hours.</p>
            </div><br/><br/>";
          } 
          catch (Exception $e) {
            echo "<div class='col-md-12 col-sm-12 col-md-offset-0 col-sm-offset-2' style='background-color:#ffdbdd; height:70px; border-style:round; border: 2px;
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
                  <option <?php if($user_type=="Student"){echo "selected";}?>>Employer</option>             
              </select>
						  <input type="text" required class="form-control input-lg" name="fname" placeholder="Company Name" value = "<?php if($fname!=""){echo $fname;}?>">
              <input type="text" required class="form-control input-lg" name="username" placeholder="Type of Company" value = "<?php if($username!=""){echo $username;}?>">
						  <input type="email" required class="form-control input-lg" name="email" placeholder="Company Email" value = "<?php if($email!="" AND $isRegistered==false){echo $email;}?>">
						  <input type="password" required class="form-control input-lg" name="pass" placeholder="Password" value = "<?php if($pass!=""){echo $pass;}?>">
              <input type="password" required class="form-control input-lg" name="repass" placeholder="Re-Password">
              <input type="text" class="form-control input-lg" name="address" placeholder="Company Address" value = "<?php if($address!=""){echo $address;}?>">         
              <input style="background-color:#ff8f3e;" type="submit" name="submit" value="Register" class="btn px-4 btn-primary text-white">
              <h1></h1>
          </form>    
				</div>   
			</div>  
		</section>
		
<?php include "includes/footer.php"; ?>