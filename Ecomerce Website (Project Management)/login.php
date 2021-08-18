<?php
include 'includes/connect.php';
session_start();

if(isset($_POST['submit'])){
  $user_email = $_POST['email'];
  $pass = $_POST['password'];
  $pass =  md5($pass);

  
  $detail = "SELECT * FROM USERS WHERE user_email = '$user_email' AND user_password = '$pass'";
  $detailqry = oci_parse($conn, $detail); 
  oci_execute($detailqry);  
  while($row = oci_fetch_assoc($detailqry)){
    $uid = $row['USER_ID'];
    $fname = $row['USER_FIRST_NAME'];
    $lname = $row['USER_LAST_NAME'];
    $type = $row['USER_TYPE'];
    $active = $row['ACTIVE'];
  }
  
  if(oci_num_rows($detailqry) !=0){
    if($active==1){   
      $_SESSION['USER_ID'] = $uid;
      $_SESSION['USER_TYPE'] = $type;
      if(strtoupper($type)=="CUSTOMER"){
        header('location:index.php');
      }
      else if(strtoupper($type)=="TRADER"){
        header('location:trader/home.php');
      }
      else if(strtoupper($type)=="ADMIN"){
        header('location:admin/home.php');      
      }
      else{
        echo "<script language='javascript'>;alert('USER DATATYPE MISMATCHED.')</script>;";
      }
    }
    else{
      echo "<script language='javascript'>;alert('Your Account Is Not Active. Please Contact your Administrator at cleckhuddersfax12store@gmail.com')</script>;";      
    }
  }else{
    echo "<script language='javascript'>;alert('Invalid login credentials!')</script>;";
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
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>
<body class="hold-transition">
  <div class="row">
    <div class="col-md-12 col-12 col-lg-6 col-xl-6 ml-auto mr-auto">
      <div class="login">
        <h2 align="center">Log In</h2>
        <br>
        <div class="login-form-container">
            <div class="login-form">
              <form action="" method="post">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password">
                <div class="button-box">
                  <div class="login-toggle-btn">
                      <input type="checkbox">
                      <label>Remember me</label>    
                  </div>
                  <button type="submit" class="default-btn floatright" name="submit">Login</button><br/><br/>
                  <a href="register.php">Don't have an account, Signup?</a>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</body>
<?php
  include 'includes/footer.php';
?>
</html>