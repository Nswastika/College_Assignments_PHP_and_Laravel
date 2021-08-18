<?php
include 'includes/connect.php';
?>

<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
session_start();

date_default_timezone_set('Asia/Kathmandu');		
$date = date("Y-m-d h:i:sA");
if(isset($_POST['submit'])){
  if (!preg_match("/^[a-zA-Z]*$/",$_POST['fname'])) {
    $_SESSION['VALIDATIONERROR'] = "Only letters allowed";
  }
  if (!preg_match("/^[a-zA-Z]*$/",$_POST['lname'])) {
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
		$fname =$_SESSION['fname'];
		$lname = $_SESSION['lname'];
		$address = $_SESSION['address'];
		$email = $_SESSION['email'];
		$pass = $_SESSION['pass'];
		$repass = $_SESSION['repass'];
    $repass = $_SESSION['repass'];
    $dateofbirth = $_SESSION['dateofbirth'];
    $username = $_SESSION['username'];
		$desc = $_POST['desc'];
    $hashed_pass = md5($pass);
    $sql = "INSERT INTO users(user_id, user_first_name, user_last_name, user_address, user_email, user_password, user_type, active, user_created_at, date_of_birth, user_username) VALUES 
    (seq_users.nextval, '$fname','$lname','$address', '$email', '$hashed_pass', 'Trader', '0', '$date', '$dateofbirth', '$username')";		
		$result = oci_parse($conn,$sql);			
		oci_execute($result);
    $sql1 = "INSERT INTO trader(trader_id, user_id, trader_email) VALUES (seq_users.nextval-1, seq_users.nextval-1,'$email')";
    $result1 = oci_parse($conn, $sql1);      
    oci_execute($result1);
    if(oci_error()){
      echo "<script>alert('Oci Error');</script>";
    }
    $message = "
    <h2>Thank you for Registering.</h2>
    <p>Your Shop/Product Description: ".$desc."</p>
    <p>Email: ".$email."</p>
    <p><b>Your request for Trader Account will manually be verified by Admin within next working day.</b></p>
    ";

    //Load phpmailer
    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);                             
    try {
      //Server settings
      $mail->isSMTP();                                     
      $mail->Host = 'smtp.gmail.com';                      
      $mail->SMTPAuth = true;                               
      $mail->Username = 'cleckhuddersfax12store@gmail.com';     
      $mail->Password = 'clecks11';                    
      $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
      );                         
      $mail->SMTPSecure = 'ssl';                           
      $mail->Port = 465;
      $mail->setFrom('cleckhuddersfax12store@gmail.com');
      //Recipients
      $mail->addAddress($email);              
      $mail->addReplyTo('cleckhuddersfax12store@gmail.com');
      //Content
      $mail->isHTML(true);                                  
      $mail->Subject = 'ECommerce Site Sign Up';
      $mail->Body    = $message;
      $mail->send();
      unset($_SESSION['fname']);
      unset($_SESSION['lname']);
      unset($_SESSION['address']);
      unset($_SESSION['email']);
      unset($_SESSION['username']);
      unset($_SESSION['dateofbirth']);
      unset($_SESSION['user_type']);
      $_SESSION['success'] = 'Account created. Your Account will be manually be verfied by the admin with a working day.';
      header('location: register.php');
    } 
    catch (Exception $e) {
        $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
        header('location: register.php');
    }
	}
?>


<!DOCTYPE html>
<html>
<?php
    include 'includes/header.php';
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
	<!-- /top Header -->
	<div class="container" id="logo">
		<div class="container">
			<div class="pull-left">
				<!-- Logo -->
				<div class="header-logo">
					<a class="logo" href="index.php">
						<img src="misc/img/logo.png" alt="">
					</a>
				</div>
				<!-- /Logo -->				
			</div>
		</div>
	</div>
	
<body class="hold-transition">


<div class="container-fluid" id="login">
  <div class="login-logo">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Enter a short description of your shop or the products you are trying to sell</p>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Description" name="desc">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
        <div class="row">
          <div class="col-xs-8">
        </div>
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
        </div>
      </div>
    </form>
	<br>
  </div>
  <!-- /.login-box-body -->
</div>
</body>
<?php
    include 'includes/footer.php';
?>
</html>