<?php

  include 'includes/header.php';
  include 'includes/sidebar.php';
  include ('../includes/connection.php');
  $conn = mysqli_connect("localhost","root");
  $sql = mysqli_select_db($conn, 'Students_Jobsite');
?>

        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Students List</h1>
                <ol class="breadcrumb">
                    <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Students List</li>
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Data Table</div>
                    </div>
                    <div class="table-responsive ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                   
                                    <th>Name</th> 
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            
                                <tfoot>
                                <tr>
                                   
                                    <th>Name</th> 
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $detail="SELECT * FROM users WHERE UPPER(user_type)='Student'";
                                $detailqry = mysqli_query($conn, $detail);
                                while($row = mysqli_fetch_array($detailqry)){
                                    $user_id = $row['user_id'];
                                ?>
                                <tr>
                                   
							        <td><?php echo $row['user_first_name'];?></td>
							        <td><?php echo $row['user_email'];?></td>
							        <td><?php echo $row['user_address'];?></td>
                                    <?php
									if($row['active']==1){
										
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
								        <a class="btn btn-danger" href="action_user.php?sid=<?php echo $row['user_id']; ?>"><b><?php echo $buttonText; ?></b>
								        </a>							
								    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>            
            </div>
            <!-- END PAGE CONTENT-->        
        </div>
    </div>
           
    
    <!-- CORE PLUGINS-->
    <script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="./assets/vendors/DataTables/datatables.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#example-table').DataTable({
                pageLength: 10,
            });
        })
    </script>
    

</body>

</html>