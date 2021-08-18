<?php 
   $conn = oci_connect('example', 'example', '//localhost/xe'); 
   if (!$conn) {
      $m = oci_error();
      echo $m['message'], "\n";
      exit; }else {
      //print "Connected to Oracle!"; 
   }
?>