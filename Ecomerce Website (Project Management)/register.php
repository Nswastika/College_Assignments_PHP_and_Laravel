<?php
  include 'includes/connect.php';
  include 'includes/session.php';
?>

<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  if(isset($_SESSION['user'])){
    header('location: cart_view.php');
  } 
  $isRegistered = false;
  $fname = $lname = $address = $email = $pass = $repass = $user_type = "";
  $dateofbirth="";
  $username="";
  $rowCount=0;
  $set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $code=substr(str_shuffle($set), 0, 12);

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
    $fname =$_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];
    $user_type = $_POST['user_type'];
    $dateofbirth = $_POST['dateofbirth'];
    $username = $_POST['username'];


    $hashed_pass = md5($pass);
    date_default_timezone_set('Asia/Kathmandu');        
    $date = date("Y-m-d h:i:sA"); 
    $detail="SELECT * FROM USERS WHERE USER_EMAIL='$email'";
    $detailqry = oci_parse($conn, $detail);
    oci_execute($detailqry);
    while($row = oci_fetch_array($detailqry)){
      $rowCount++;
    }
    if($rowCount==0){
      if($repass == $pass){
        $pass = $pass;
        if(strtoupper($user_type) == 'CUSTOMER' || strtoupper($user_type) == 'ADMIN'){           
          $sql = "INSERT INTO users(user_id, user_first_name, user_last_name, user_address, user_email, user_password, user_type, active, user_created_at, date_of_birth, user_username) VALUES 
          (seq_users.nextval, '$fname','$lname','$address', '$email', '$hashed_pass', '$user_type', '', '$date', '$dateofbirth', '$username')";             
          $result = oci_parse($conn,$sql);            
          oci_execute($result);
          $message = "
          <h2>Thank you for Registering.</h2>
          <p>Your Account:</p>
          <p>Email: ".$email."</p>
          <p>Please click the link below to activate your account.</p>
          <a href='http://localhost/eProject/activate.php?code=".$code."&useremail=".$email."'>Activate Account</a>
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
            $_SESSION['success'] = 'Account created. Check your email to activate.';
            header('location: register.php');
          } 
          catch (Exception $e) {
              $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
              header('location: register.php');
          }
          if(oci_error()){
              echo "<script>alert('Oci Error');</script>";
          }
        }
        else{  
          $_SESSION['fname'] =$_POST['fname'];
          $_SESSION['lname'] = $_POST['lname'];
          $_SESSION['address'] = $_POST['address'];
          $_SESSION['email'] = $_POST['email'];
          $_SESSION['pass'] = $_POST['pass'];
          $_SESSION['repass'] = $_POST['repass'];
          $_SESSION['dateofbirth'] = $_POST['dateofbirth'];
          $_SESSION['username'] = $_POST['username'];
          header('location:registertrader.php');
        }
      }
      else{
          if($repass != ""){              
              echo "<script>alert('Your confirm Password does not match');</script>";
          }           
      }
    }
    else{
        $isRegistered = true;
        echo "<script>alert('User Already Registered. Please Enter new id');</script>";
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
<body class="container-fluid">
  <div class="container-fluid">
    <?php
      if(isset($_SESSION['error'])){
          echo "
          <div class='callout callout-danger text-center'>
              <p>".$_SESSION['error']."</p> 
          </div>
          ";
          
      }
      if(isset($_SESSION['success'])){
        echo "
          <div class='callout callout-danger text-center'>
              <p>".$_SESSION['success']."</p> 
          </div>
          ";
          
      }
    ?>
    <br>
    <h2 align="center">Register</h2>
    <br>
    <div class="col-md-12 col-12 col-lg-12 col-xl-6 ml-auto mr-auto">
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" required class="form-control" name="fname" placeholder="Firstname" value = "<?php if($fname!=""){echo $fname;}?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" required class="form-control" name="lname" placeholder="Lastname" value = "<?php if($lname!=""){echo $lname;}?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" required class="form-control" name="username" placeholder="Username" value = "<?php if($username!=""){echo $username;}?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" required class="form-control" name="email" placeholder="Email" value = "<?php if($email!="" AND $isRegistered==false){echo $email;}?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" required class="form-control" name="pass" placeholder="Password" value = "<?php if($pass!=""){echo $pass;}?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" required class="form-control" name="repass" placeholder="Re-Password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
      <label for="exampleInputType"></label>
        <select required id="exampleInputType" class="form-control" name="user_type">
          <option value="" disabled selected>Registration for:</option>
          <option <?php if($user_type=="Customer"){echo "selected";}?>>Customer</option>
          <option <?php if($user_type=="Trader"){echo "selected";}?>>Trader</option>
          <?php
            $detail="SELECT COUNT(USER_TYPE) as COUNT FROM USERS WHERE USER_TYPE='Admin'";
            $detailqry = oci_parse($conn, $detail);
            oci_execute($detailqry);
            $row = oci_fetch_array($detailqry);
            if ($row['COUNT'] == 0) {
          ?>
          <option <?php if($user_type=="Trader"){echo "selected";}?>>Admin</option>
          <?php
            }
            ?>
        </select>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="address" placeholder="Address" value = "<?php if($address!=""){echo $address;}?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="date" required class="form-control" name="dateofbirth" placeholder="mm/dd/yyyy" value = "<?php if($dateofbirth!=""){echo $dateofbirth;}?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-6"><input required type="checkbox" id="checkbox" style="width:15px; vertical-align: middle;"></input> I Agree To The <a href="termsandcondition.php" style="color:green;">Terms And Conditions</a></div>
        <div class="col-6"><input type="submit" name="submit" class="btn-outline-dark btn-hover-black" value="Register"></input></div>
      </div>
    </form>
    <div class="form-group has-feedback">
      <h5>Already have an account ? <a href="../eProject/login.php" style="color:green;">Login</h5></a>
    </div>
  </div>
</div>
</body>
<?php
    include 'includes/footer.php';
?>
</html>
