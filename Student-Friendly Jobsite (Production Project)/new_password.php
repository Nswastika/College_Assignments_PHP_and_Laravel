<?php
include 'db.php';

include 'includes/header.php';
?>
<section class="inner-banner" style="background:#242c36 url(images/xxxx.jpg) no-repeat">
		<div class="container">
			<div class="caption">
				<h2>Forget Password</h2>
				<p>Get your dream jobs <span>2021</span></p>
			</div>
		</div>
	</section>
	<section class="login-wrapper">
			<div class="container" >
				<div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2" style=" border: 2px solid white; border-style: ridge; border-radius: 12px;">
                <img class="img-responsive" alt="logo" src="images/logooo.jpg">
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST["user_email"]) && (!empty($_POST["user_email"]))){
$email = $_POST["user_email"];
if (!$email) {
	$location = 'new_password.php';
  	$error .="<script>alert('Invalid Email Address. Please type a valid Email Address.');window.location.href='$location';</script>";;
	}else{
	$sel_query = "SELECT * FROM users WHERE user_email='".$email."'";
	$results = mysqli_query($con,$sel_query);
	$row = mysqli_num_rows($results);
	if ($row==""){
		$location = 'new_password.php';
		$error .= "<script>alert('No user is registered with this email address!');window.location.href='$location';</script>";
		}
	}
	if($error!=""){
	$location = 'new_password.php';
	echo "<script>alert('.$error.');window.location.href='$location';</script>";

		}else{
	$expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y"));
	$expDate = date("Y-m-d H:i:s",$expFormat);
	$key = md5($email);
	$addKey = substr(md5(uniqid(rand(),1)),3,10);
	$key = $key . $addKey;
// Insert Temp Table
mysqli_query($con,
"INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
VALUES ('".$email."', '".$key."', '".$expDate."');");

$output='<p>Dear user,</p>';
$output.='<p>Please click on the following link to reset your password.</p>';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p><a href="http://localhost/Student_Job/reset-password.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">http://localhost/Student_Job/reset-password.php?key='.$key.'&email='.$email.'&action=reset</a></p>';		
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reason.</p>';
$output.='<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to change your security password as someone may have guessed it, you can proceed.</p>';   	
$output.='<p>Thanks,</p>';
$output.='<p>Job4Students Team</p>';
$body = $output; 
$subject = "Password Recovery - Job4Students.com";

$email_to = $email;
$fromserver = "jobstudents31@gmail.com"; 
require 'vendor/vendor/autoload.php';
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';   // Enter your host here
$mail->SMTPAuth = true;
$mail->Username = 'jobstudents31@gmail.com';  // Enter your email here
$mail->Password = 'job4students';  //Enter your passwrod here
$mail->SMTPOptions = array(
	'ssl' => array(
	'verify_peer' => false,
	'verify_peer_name' => false,
	'allow_self_signed' => true
	)
);                         
$mail->SMTPSecure = 'ssl';                           
$mail->Port = 465;
$mail->isHTML(true);
$mail->setFrom('jobstudents31@gmail.com');
//Recipients
$mail->addAddress($email);              
$mail->addReplyTo('jobstudents31@gmail.com');

$mail->Subject = $subject;
$mail->Body = $body;
$mail->addAddress($email_to);
if(!$mail->Send()){
$location = 'new_password.php';
echo "<script>alert('.$mail->ErrorInfo.');window.location.href='$location';</script>";

}else{

$location = 'new_password.php';
echo "<script>alert('Mail has been sent to you');window.location.href='$location';</script>";
}

		}	

}else{
?>

<form method="post" action="">

<input type="email" name="user_email" class="form-control input-lg" placeholder="Enter your email" />

<button style="background-color:#ff8f3e;" type="submit" name="submit" value="Reset Password" class="btn px-4 btn-primary text-white">Submit</button><br/><br/>
</form>
</div>
			</div>
		</section>
<?php } ?>


<?php
include 'includes/footer.php';
?>
