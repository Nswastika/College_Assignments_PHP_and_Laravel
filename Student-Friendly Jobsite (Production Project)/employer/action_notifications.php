<?php
	
	// include 'includes/header.php';
	// include 'includes/sidebar.php';


	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
	require '../vendor/vendor/autoload.php';
	
	//include ('../includes/connection.php');
	$conn = mysqli_connect("localhost","root");
	$detail = mysqli_select_db($conn, 'Students_Jobsite');
	if(isset($_GET['sid'])){		
		$sid = $_GET['sid'];
		$detail = "SELECT * from resumes WHERE user_id = $sid";
		$detailqry = mysqli_query($conn, $detail);

		while($row = mysqli_fetch_assoc($detailqry)){
		
			$email = $row['user_email'];		
		
		}
		
		
			
			
require '../vendor/vendor/autoload.php';
$mail = new PHPMailer(true);
  
try {                                       
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                             
    $mail->Username   = 'jobstudents31@gmail.com';                 
    $mail->Password   = 'job4students';                        
    $mail->SMTPSecure = 'ssl';                              
    $mail->Port       = 465;  
  
    $mail->setFrom('jobstudents31@gmail.com');           
    $mail->addAddress($email);
    $mail->addAddress('jobstudents31@gmail.com');

       
    $mail->isHTML(true);                                  
    $mail->Subject = 'New Job Added in J4S';
    // $mail->Body    = 'HTML message body in <b>bold</b> ';
	$mail->Body = "A new job as per your requirement has been added. Please view the website to apply as soon as possible." ;
    $mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();
    echo "<script>alert('Mail has been sent successfully!');window.location.href='send_notifications.php';</script>";
} catch (Exception $e) {
    echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');window.location.href='send_notifications.php';</script>";
}
  


			
		
		}	
	
	
?>