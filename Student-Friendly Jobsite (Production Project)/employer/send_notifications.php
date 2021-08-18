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
                                    <th>Job Category</th>
                                    <th>Name</th> 
                                    <th>Email</th>
                                    <th>Address</th>
                                   
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            
                                <tfoot>
                                <tr>
                                    <th>Job Category</th>
                                    <th>First Name</th> 
                                    <th>Email</th>
                                    <th>Address</th>
                                  
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $detail = mysqli_select_db($conn, 'Students_Jobsite');
                                $detail="SELECT DISTINCT users.category_id, categoryname, resumes.user_email, users.active, user_first_name, user_address, resumes.user_id, users.user_id, resumes.fk_user_id FROM users, resumes, category WHERE users.user_id = resumes.user_id AND users.category_id = category.category_id AND fk_user_id =  $user_id";
                                $detailqry = mysqli_query($conn, $detail);
                                while($row = mysqli_fetch_array($detailqry)){
                                    $user_id = $row['user_id'];
                                ?>
                                <tr>
                                    
                                    <td><?php echo $row['categoryname'];?></td>
							        <td><?php echo $row['user_first_name'];?></td>
							        <td><?php echo $row['user_email'];?></td>
							        <td><?php echo $row['user_address'];?></td>
                                    
							        <td class="text-center">							
								        <a class="btn btn-danger" href="action_notifications.php?sid=<?php echo $row['user_id']; ?>"><b>Send Notification</b>
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
           
    
    <!-- END PAGA BACKDROPS-->
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
                //"ajax": './assets/demo/data/table_data.json',
                /*"columns": [
                    { "data": "name" },
                    { "data": "office" },
                    { "data": "extn" },
                    { "data": "start_date" },
                    { "data": "salary" }
                ]*/
            });
        })
    </script>
    

</body>

</html>