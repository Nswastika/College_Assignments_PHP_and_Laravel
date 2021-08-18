<?php
	session_start();
	if(isset($_SESSION['USER_ID']) && $_SESSION['USER_TYPE'] = "Admin"){
	$USER_ID = $_SESSION['USER_ID'];	
	}else{
		header('location:../login.php');
	}
include ('../includes/connect.php');

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
	<section class="content-header">
      <h1>
       	Timeslot
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Timeslot</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
		  <div class="panel-heading">
			
		</div>
        <div class="col-xs-12">
          <div class="box">
           
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>  
                <th>User Id</th>                
                  <th>Day</th>
				         <th>Time</th>

				        <!--  <th>Action</th> -->
                </tr>
                </thead>
                <tbody>
                	
					<?php
								
					
					$detail="SELECT * FROM COLLECTION_SLOT";
					$detailqry = oci_parse($conn, $detail);
					oci_execute($detailqry);
					while($row = oci_fetch_array($detailqry)){
					
						?>
					<tr>
					  <td><?php echo $row['USER_ID'];?></td>
					  <td><?php echo $row['DAY'];?></td>
					  <td><?php echo $row['SLOT'];?></td>		  
					<!--   <td class="text-center">							
							<a class="btn btn-default btn-sm" href="edittimeslot.php?sid=<?php echo $row['COLLECTION_SLOT_ID']; ?>">
								<i class="fa fa-pencil"></i>                
							</a>							
						</td>  -->
					
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
  <!-- /.content-wrapper -->
  <?php include('./includes/footer.php'); ?>


<!-- ./wrapper -->
<?php include('./includes/script.php'); ?>
</body>
</html>
