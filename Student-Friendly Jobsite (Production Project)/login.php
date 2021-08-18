<?php 
session_start();
include 'includes/connection.php';
$error ="";
if(isset($_POST['submit'])){  
    $user_email = $_POST['email'];
  
    if($user_email == ""){
        $error = "<div class='col-md-12 col-sm-12 col-md-offset-0 col-sm-offset-2' style='background-color:#ffdbdd; height:50px; border-style:round; border: 2px;
        border-radius: 5px; '>
        <p style='text:justify; text-align: center; color:red;'>User Email is required !</p>
        </div><br/><br/><br/>";
    }else {      
        $pass = $_POST['password'];
        $pass =  md5($pass);
        $detail = mysqli_select_db($conn, 'Students_Jobsite');
        $detail = "SELECT * FROM users WHERE user_email = '$user_email' AND user_password = '$pass' AND user_type = 'Student' ";
        $detailqry = mysqli_query($conn, $detail);  
        while($row = mysqli_fetch_assoc($detailqry)){
          $uid = $row['user_id'];
          $fname = $row['user_first_name'];
          $type = $row['user_type'];
          $active = $row['active'];
          $category_id = $row['category_id']; 
        }
  
        if($detailqry->num_rows !=0){
          if($active==1){ 
            $_SESSION['user_id'] = $uid;
            $_SESSION['user_type'] = $type;
            $_SESSION['category_id'] = $category_id;
              if(strtoupper($type)=="STUDENT"){ 
                header('location:index.php');
              }
            else{
              $error =  "<div class='col-md-12 col-sm-12 col-md-offset-0 col-sm-offset-2' style='background-color:#ffdbdd; height:50px; border-style:round; border: 2px; border-radius: 5px; '>
              <p style='text:justify; text-align: center; color:red;'>Invalid login credentialss !</p></div><br/><br/><br/>";  
            }
          }  
          else{
            $error = "<div class='col-md-12 col-sm-12 col-md-offset-0 col-sm-offset-2' style='background-color:#ffdbdd; height:80px; border-style:round; border: 2px; border-radius: 5px; '>
            <p style='text:justify; text-align: center; color:red;'>Your Account Is Not Active. Please Contact your Administrator at jobstudents31@gmail.com !</p></div><br/><br/><br/><br/>   ";       
    }
  }
  else{  
    $error = "<div class='col-md-12 col-sm-12 col-md-offset-0 col-sm-offset-2' style='background-color:#ffdbdd; height:50px; border-style:round; border: 2px;
    border-radius: 5px; '>
    <p style='text:justify; text-align: center; color:red;'>Invalid login credentials!</p>
    </div><br/><br/><br/>";  
  }
}
}
?>

<?php
  include 'includes/header.php';
?>

<section class="inner-banner" style="background:#242c36 url(images/xxxx.jpg) no-repeat">
	<div class="container">
		<div class="caption">
			<h2>Login</h2>
			<p>Get your dream jobs <span>2021</span></p>
		</div>
	</div>
</section>

<section class="login-wrapper">
	<div class="container" >
    <div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2" style=" border: 2px solid white; border-style: ridge; border-radius: 12px;">
      <img class="img-responsive" alt="logo" src="images/logooo.jpg">
        <?php if($error == ""){        
          }else{
          echo $error;
        }?>
        <form action="" method="post">
					<input type="email" name="email" class="form-control input-lg" placeholder="Email">
					<input type="password" name="password" class="form-control input-lg" placeholder="Password">
          <button style="background-color:#ff8f3e;" type="submit" name="submit" value="submit" class="btn px-4 btn-primary text-white">LOGIN</button>           
						<p>Need Help? Forgotten your <a href="new_password.php">Password</a></p>
            
				</form>
		</div>
	</div>
</section>
   
<?php include 'includes/footer.php'; ?>
