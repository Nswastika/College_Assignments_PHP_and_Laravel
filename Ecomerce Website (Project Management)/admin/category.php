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
        List of Categories
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List of Categories</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
		  <div class="panel-heading">
			<h3 class="page-header p-b-md m-b-sm">
				<br>
				
				<span class="pull-left">
					
					<form method="get" action="add_cat.php">
						<button type="submit" name="submit" class="btn btn-info btn-block btn-flat">New <i class="fa fa-plus"></i> </button>
					<form>
				</span>
			</h3>
		</div>
        <div class="col-xs-12">
          <div class="box">
           
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>                  
                  <th>Category Id</th>
				  <th>Category Name</th>
				 
				  <th>Tools</th>
                </tr>
                </thead>
                <tbody>
                	
					<?php
					
					$detail="SELECT * FROM CATEGORY";
					$detailqry = oci_parse($conn, $detail);
					oci_execute($detailqry);
					while($row = oci_fetch_array($detailqry)){								
						?>
					<tr>
					  <td><?php echo $row['CATEGORYID'];?></td>
					  <td><?php echo $row['CATEGORYNAME'];?></td>
					  	  
					  <td class="text-center">							
							<a class="btn btn-warning btn-sm" href="edit_cat.php?sid=<?php echo $row['CATEGORYID']; ?>">Edit
								<i class="fa fa-pencil"></i>                
							</a>							
							<a class="btn btn-danger btn-sm" href="delete_cat.php?sid=<?php echo $row['CATEGORYID']; ?>">Delete
								<i class="fa fa-trash-o"></i>                
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
   <!-- /.content-wrapper -->
  <?php include('includes/footer.php'); ?>



<!-- ./wrapper -->
<?php include('./includes/script.php'); ?>
</body>
</html>
