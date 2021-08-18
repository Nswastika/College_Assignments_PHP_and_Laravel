<!DOCTYPE html>
<html>
<head>
  <title>Collection Slot</title>
      <!--adding header-->
    <?php
        session_start();
  if(isset($_SESSION['USER_ID'])){
  $USER_ID = $_SESSION['USER_ID'];
      }
        include 'includes/header.php';
        include 'includes/connect.php';
    ?>
</head>
<body>
<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 

<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style type="text/css">
input[type=radio] {
    border: 2px;
    width: 70%;
    height: 1.2em;
}
</style>

<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
    <form method="post">
     <div class="form-group ">
      <label class="control-label requiredField" for="date">
       Date
       <span class="asteriskField">
        *
       </span>
      </label>
      <div class="input-group">
       <input class="form-control" id="date" name="date" placeholder="DD/MM/YYYY" type="text" required="true" />
       <div class="input-group-addon">
        <i class="fa fa-calendar-check-o">
        </i>
       </div>
      </div>
      <span class="help-block" id="hint_date">
       Pick-Up Slots Available Only Wednesdays, Thursdays &amp; Fridays 
       &amp; 24 Hours After Placing Order
      </span>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField">
       Select a Slot
       <span class="asteriskField">
        *
       </span>
      </label>
      <div class="">
       <div class="radio">
        <label class="radio">
         <input name="radio" type="radio" value="10 AM To 1 PM"/>
         10 AM To 1 PM
        </label>
       </div>
       <div class="radio">
        <label class="radio">
         <input name="radio" type="radio" value="1 PM To 4 PM"/>
         1 PM To 4 PM
        </label>
       </div>
       <div class="radio">
        <label class="radio">
         <input name="radio" type="radio" value="4 PM To 7 PM"/>
         4 PM To 7 PM
        </label>
       </div>
      </div>
     </div>
     <div class="form-group">
      <div>
       <button class="btn btn-primary " name="submit" type="submit">
        Submit
       </button>

       <?php
       error_reporting(0);
  if(isset($_POST['submit']))
{
    $sql = oci_parse($conn, "INSERT INTO COLLECTION_SLOT(COLLECTION_SLOT_ID, DAY, SLOT, USER_ID) VALUES (SEQ_COLLECTION.nextval, '".$_POST["date"]."', '".$_POST["radio"]."', '$USER_ID')");
    if (oci_execute($sql)) {
          echo "
            <script type=\"text/javascript\">
            location.replace('checkout.php');
            </script>
        ";
    }

    else{
      
    
if (!oci_execute($sql)) {
    echo "
            <script type=\"text/javascript\">
            swal('All Collection Slots Already Reserved!');
            </script>
        ";
}

}

}

?>
      </div>
     </div>
    </form>
   </div>
  </div>
 </div>
     <?php
        include 'includes/footer.php';
    ?>
</div>


<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
    $(document).ready(function(){
        var today = new Date();
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            container: container,
            autoclose: true,
            format: "mm/dd/yyyy",
            maxViewMode: 3,
            daysOfWeekDisabled: "0,1,2,6",
            datesDisabled: ['today']
            
        })
    })
</script>

</body>
</html>
