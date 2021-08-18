<?php
session_start();
if(isset($_SESSION['user_id']) && $_SESSION['user_type']){
  $user_id = $_SESSION['user_id'];    
  
}
else{
  header('location:login.php');
}
include 'includes/connection.php';
$conn = mysqli_connect("localhost","root"); 
      // Select Database 
      if (!$conn) {
        error_log("Failed to connect to MySQL: " . mysqli_error($connection));
        die('Internal server error');
      }
     
      // 2. Select a database to use 
      $sql = mysqli_select_db($conn, 'Students_Jobsite');
      if (!$sql) {
        error_log("Database selection failed: " . mysqli_error($connection));
        die('Internal server error');
      }
      $detail = mysqli_select_db($conn, 'Students_Jobsite');
      $sql = "SELECT * FROM resumes";
      $result = mysqli_query($conn, $sql);
      $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
      if(isset($_POST['update'])){       
      $user_id = $_SESSION["user_id"];
      $job_id = $_POST['job_id'];
      $fk_user_id = $_POST['fk_user_id'];
      $user_email = $_POST['user_email'];  
      $filename = $_FILES['myfile']['name'];

      // destination of the file on the server
      $destination = 'uploads/' . $filename;

      // get the file extension
      $extension = pathinfo($filename, PATHINFO_EXTENSION);

      // the physical file on a temporary uploads directory on the server
      $file = $_FILES['myfile']['tmp_name'];
      $size = $_FILES['myfile']['size'];

      if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        $location="company-detail.php";
          echo "<script>alert('You file extension must be .zip, .pdf or .docx');window.location.href='$location';</script>";
      } elseif ($_FILES['myfile']['size'] > 9900000) { // file shouldn't be larger than 1Megabyte
        $location="company-detail.php";
          echo "<script>alert('File too large!');window.location.href='$location';</script>";
      } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $detail = "INSERT INTO resumes (name, user_id, job_id, fk_user_id, user_email, status, size, downloads, applied_no) VALUES ('$filename', '$user_id', '$job_id', '$fk_user_id', '$user_email', 'pending', 0, 0, '1')";
            $detailqry = mysqli_query($conn, $detail);  
            if (mysqli_query($conn, $sql)) {
              $location="company-detail.php";
                echo "<script>alert('Your job application is sent successfully. Email will be sent to selected candidates regarding further details.');window.location.href='$location';</script>";
            }
        }   else {
              $location="company-detail.php";
              echo "<script>alert('Failed to upload file.');window.location.href='$location';</script>";            
            }   
        }
      }
  // Downloads files
  if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

  // fetch file to download from database
    $sql = "SELECT * FROM resumes WHERE resume_id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['name'];

    if (file_exists($filepath)) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename=' . basename($filepath));
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize('uploads/' . $file['name']));
      readfile('uploads/' . $file['name']);

      // Now update downloads count
      $newCount = $file['downloads'] + 1;
      $updateQuery = "UPDATE resumes SET downloads=$newCount WHERE resume_id=$id";
      mysqli_query($conn, $updateQuery);
      exit;
    }
  }
?>


