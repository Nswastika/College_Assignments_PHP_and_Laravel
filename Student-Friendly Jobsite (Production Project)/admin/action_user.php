<?php
    
	session_start();
	if(isset($_SESSION['user_id']) && $_SESSION['user_type'] = "Admin"){
	  $user_id = $_SESSION['user_id'];    
	}
	else{
	  header('location:../login.php');
	}
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
	require '../vendor/vendor/autoload.php';
	//include '../includes/connection.php';
	$conn = mysqli_connect("localhost","root");
	$sql = mysqli_select_db($conn, 'Students_Jobsite');

	if(isset($_GET['sid'])){		
		$sid = $_GET['sid'];
		$detail = "SELECT * FROM users WHERE user_id = $sid";
		$detailqry = mysqli_query($conn, $detail);
		while($row = mysqli_fetch_assoc($detailqry)){
			$active = $row['active'];
			$email = $row['user_email'];			
		}
		if($active==1){
			//deactivate
			$sql = "UPDATE users SET active = '0' WHERE user_id = $sid";
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
                $mail->Subject = 'Account Deactived';
                $mail->Body    = 'Your account is deactivated.';
                $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                $mail->send();
                echo "<script>alert('Mail has been sent successfully!');window.location.href='manage_students.php';</script>";
            } catch (Exception $e) {
                echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');window.location.href='manage_students.php';</script>";
            }					
		}else{
			//activate
			$sql = "UPDATE users SET active = '1' WHERE user_id = $sid";
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
                $mail->Subject = 'Account Activated';
                $mail->Body    = 'Your account is activated.';
                $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                $mail->send();
                // echo "Mail has been sent successfully!";
                echo "<script>alert('Mail has been sent successfully!');window.location.href='manage_students.php';</script>";
                } catch (Exception $e) {
                    echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');window.location.href='manage_students.php';</script>";
                }		
		}	
	}
?>