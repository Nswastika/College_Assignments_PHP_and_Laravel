<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    session_start();
    if(isset($_SESSION['USER_ID'])){
        $USER_ID = $_SESSION['USER_ID'];    
    }else{
        header('location:../eProject/login.php');
    }
    // Include autoloader 
    require_once 'vendor/dompdf/autoload.inc.php'; 

    // Reference the Dompdf namespace 
    use Dompdf\Dompdf; 
    
    // Instantiate and use the dompdf class 
    $dompdf = new Dompdf();
    ?>
    <?php
    $conn = oci_connect('EXAMPLE', 'example', '//localhost/xe'); 
    // Load content from html file 
    $html = file_get_contents("invoice.html"); 
    $dompdf->loadHtml($html); 
    $file_name = 'invoice' . '.pdf';
    
    // (Optional) Setup the paper size and orientation 
    $dompdf->setPaper('A4', 'landscape'); 
    
    // Render the HTML as PDF 
    $dompdf->render();
    $file = $dompdf->output();
    file_put_contents($file_name, $file);

    

    $get_cust ="SELECT USER_EMAIL FROM USERS WHERE USER_ID='$USER_ID'";
    $run_cust=oci_parse($conn , $get_cust);
    oci_execute($run_cust);
    $row =oci_fetch_array($run_cust);
    $email_cust =$row['USER_EMAIL'];
    $message = "<h2>Kindly Find The Attached Invoice Document</h2>";

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
        $get ="SELECT TRADER_EMAIL FROM TRADER";
        $run=oci_parse($conn , $get);
        oci_execute($run);
            
        while ( $row =oci_fetch_array($run)) {
            $email =$row['TRADER_EMAIL']; 
            $mail->addBCC($email);
        }
        
        $mail->addAddress($email_cust);               
        $mail->addReplyTo('cleckhuddersfax12store@gmail.com');
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Invoice From Cleckhuddersfax';
        $mail->Body    = $message;
        $path       = "";
        $file_name  = "invoice.pdf";
        $mail->addAttachment($path.$file_name);
        $mail->send();
        $_SESSION['success'] = 'Invoice mailed to your Trader';

    } 
    catch (Exception $e) {
        $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
    }
    // Output the generated PDF (1 = download and 0 = preview) 
    $dompdf->stream("Cleckhuddersfax", array("Attachment" => 1));
?>