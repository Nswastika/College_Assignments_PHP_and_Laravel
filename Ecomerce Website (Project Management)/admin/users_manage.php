<?php
	session_start();
	if(isset($_SESSION['USER_ID']) && $_SESSION['USER_TYPE'] = "Admin"){
	$USER_ID = $_SESSION['USER_ID'];	
	}else{
		header('location:../login.php');
	}
include ('../includes/connect.php');
$trader_id = 1;
?>
<?php include('../includes/backend/head.php');?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include('./includes/nav.php'); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->    

    <!-- Main content -->
    <section class="content">
      <section class="content-header">
      <h1>
        Customers List
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customers List</li>
      </ol>
    </section>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th>User Id</th>
          <th>User Email</th>
				  <th>Address</th>
				  <th>Status</th>
				  <th>Action</th>				  
                </tr>
                </thead>
                <tbody>
                	
					<?php
						$detail="SELECT * FROM USERS WHERE UPPER(USER_TYPE)='CUSTOMER'";
						$detailqry = oci_parse($conn, $detail);
						oci_execute($detailqry);
						while($row = oci_fetch_array($detailqry)){
							$userid = $row['USER_ID'];
							?>
						<tr>
							<td><?php echo $row['USER_ID'];?></td>
							<td><?php echo $row['USER_EMAIL'];?></td>
							<td><?php echo $row['USER_ADDRESS'];?></td>
							<?php
									if($row['ACTIVE']==1){
										//echo '<td bgcolor="#8ed100">';
										echo '<td>';
										echo "<font color='#8ed100'><b>ACTIVE</b></font>";
										$buttonText = "DEACTIVATE";
									}else{
										echo '<td>';
										echo "<font color='#750000'><b>NOT ACTIVE</b></font>";
										$buttonText = "ACTIVATE";
									}
									echo "</td>";
								?>	
							<td class="text-center">							
								<a class="btn btn-danger" href="action_user.php?sid=<?php echo $row['USER_ID']; ?>"><b><?php echo $buttonText; ?></b>
								   
								</a>							
								
							</td>
							
							
							
						</tr>
					<?php }?>
					
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
          <!-- /.box -->


        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <?php include('includes/footer.php'); ?>


<!-- ./wrapper -->

<?php include('./includes/script.php'); ?>
</body>
</html>
