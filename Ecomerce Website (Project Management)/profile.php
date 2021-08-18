<?php
    session_start();
    include 'includes/header.php';
    include 'includes/connect.php';
    if(isset($_SESSION['USER_ID'])){
        $USER_ID = $_SESSION['USER_ID'];    
    }else{
        header('location:../login.php');
    }
    
    //include ('imageupload.php');

    $fname = "Not Available";
    $lname = "Not Available";
    $email = "Not Available";
    $address = "Not Available";
    $dates = "Not Available";
    $created = "Not Available";     
    $image = "Not Available";
    

    $sql = "SELECT * FROM  USERS WHERE USER_ID= '$USER_ID'";
    
    $result = oci_parse($conn,$sql);
    
    oci_execute($result);       

    while($row = oci_fetch_assoc($result))
    {
        $userid = $row['USER_ID'];
        $fname = $row['USER_FIRST_NAME'];
        $lname = $row['USER_LAST_NAME'];
        $email = $row['USER_EMAIL'];
        $address = $row['USER_ADDRESS'];
        $dates = $row['DATE_OF_BIRTH'];
        $created = $row['USER_CREATED_AT'];
        $image = $row['USER_IMAGE'];
        
        if($fname == "")
        {
            $fname = "Not Available";
        }
        if($lname == "")
        {
            $lname = "Not Available";
        }
        if($email == "")
        {
            $email = "Not Available";
        }
        if($address == "")
        {
            $address = "Not Available"; 
        }
    if($dates == "")
    {
      $dates = "Not Available";
    }

        if($created == "")
        {
            $created = "Not Available";
        }

        
    }
?>
<div class="container">
       
    </br>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-4">
            <h4>Profile</h4>
        </div>
    </div>
    <div class="row">
       
        <div class="col-sm-1">
        </div>
        <div class="col-sm-4">
            <br>
            <?php
                if ($image == 'image/') {
            ?>
            <img src="images/profile.jpg" width="60%">
            <?php }else { ?>
                <img src="<?php echo $image;?>" width="60%">
            <?php } ?>
        </div>
        <div class="col-sm-2">
            <br/>
                <h4>First Name: </h4>
                <h4>Last Name: </h4>
              
                <h4>Email: </h4>
               
                <h4>Address: </h4>
                <h4>Date of birth</h4>
            
                <h4>Member Since: </h4>
            <br/>
        </div>
        <div class="col-sm-3">
            <br/>
                <h4><?php echo $fname?></h4>
                <h4><?php echo $lname?></h4>
              
                <h4><?php echo $email?></h4>
                <h4><?php echo $address?></h4>
             
                <h4><?php echo $dates?></h4>
                
                <h4><?php echo $created?></h4>
            <br/>
        </div>
        <div class="col-sm-2">
            <br/>
            <span class="pull-right">
                <a href="#edit" class="btn btn-success btn-flat btn-sm" data-toggle="modal"><i class="fa fa-edit" name ="edit"></i> Edit</a>
            </span>
        </div>
    </div>
    </br>
</div>
<?php

    include 'includes/footer.php';
    include 'profile_modal.php';
?>