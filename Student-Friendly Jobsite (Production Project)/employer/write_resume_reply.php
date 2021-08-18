<?php
include 'includes/header.php';
include 'includes/sidebar.php';
include ('../includes/connection.php');

  $conn = mysqli_connect("localhost","root");
    
    if (!$conn) {
        error_log("Failed to connect to MySQL: " . mysqli_error($connection));
        die('Internal server error');
      }
     
      // 2. Select a database to use 
      $detail = mysqli_select_db($conn, 'Students_Jobsite');
      if (!$detail) {
        error_log("Database selection failed: " . mysqli_error($connection));
        die('Internal server error');
      }

      if (isset ($_GET['sid'])) {
        $_SESSION["resumeno"] = $_GET['sid'];
      }
      $sid = $_SESSION["resumeno"];   
      if(isset($_POST['submit'])){    
        $reply= $_POST["replies"];
        $detail = "UPDATE resumes SET replies = '$reply' where resume_id = $sid";
        echo $detail;
        $detailqry = mysqli_query($conn, $detail); 
        echo "<script>alert('Message is added successfully.');window.location.href='resume_manage.php';</script>";		    
}
?>


 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
            <div class="page-heading">
                <h1 class="page-title">Job Application Reply</h1>
                <ol class="breadcrumb">
                    <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Job Application Reply</li>
                </ol>
            </div>
            <br>
            <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Job Application Reply</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate" action="write_resume_reply.php" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Reply</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text"  placeholder="Add Reply" name="replies">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 ml-sm-auto">
                                    <button class="btn btn-info"  name="submit" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
</div>
<?php include('includes/footer.php'); ?>

