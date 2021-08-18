<?php
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
	require '../vendor/vendor/autoload.php';
	
	$conn = mysqli_connect("localhost","root");
	$detail = mysqli_select_db($conn, 'Students_Jobsite');
	if(isset($_GET['sid'])){		
		$sid = $_GET['sid'];
		$detail = "SELECT * FROM resumes WHERE resume_id = $sid";
		$detailqry = mysqli_query($conn, $detail);

		while($row = mysqli_fetch_assoc($detailqry)){
			$status = $row['status'];
			$email = $row['user_email'];		
			$reply = $row['replies'];
		}
		if($status=='pending'){
			//deactivate
			$sql = "UPDATE resumes SET status = 'selected' WHERE resume_id = $sid";
			$qry = mysqli_query($conn, $sql);		
			
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
    $mail->Subject = 'Subject';
    // $mail->Body    = 'HTML message body in <b>bold</b> ';
	$mail->Body = $reply;
    $mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();
    echo "<script>alert('Mail has been sent successfully!');window.location.href='resume_manage.php';</script>";
} catch (Exception $e) {
    echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');window.location.href='resume_manage.php';</script>";
}
  

			// echo "<script>alert('Job have been deactivated successfully.');window.location.href='message_manage.php';</script>";
			
		
		}	
	}
	
?>