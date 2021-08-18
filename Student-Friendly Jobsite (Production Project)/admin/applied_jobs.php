<?php
	
  include 'includes/header.php';
  include 'includes/sidebar.php';
  include ('../includes/connection.php');
  $conn = mysqli_connect("localhost","root");
  $sql = mysqli_select_db($conn, 'Students_Jobsite');
  $company_id = 1;
?>

        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">List of Job Applications </h1>
                <ol class="breadcrumb">
                    <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">List of Job Applications</li>
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
                                    <th>User Email</th>
                                    <th>Job Name</th>
                                    <th>Applied Date</th>
			                        <th>Status</th>
				                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>User Email</th>
                                    <th>Job Name</th>
                                    <th>Applied Date</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            $detail="SELECT * FROM resumes, job where resumes.job_id = job.job_id";
                            $detailqry = mysqli_query($conn, $detail);
                            while($row = mysqli_fetch_array($detailqry)){
                            ?>
                            <tr>
                                <td><?php echo $row['user_email'];?></td>
                                <td><?php echo $row['job_name'];?></td>
                                <td><?php echo $row['applied_date'];?></td>
                                <td><?php echo $row['status'];?></td>
                            </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>          
            </div>
            <!-- END PAGE CONTENT-->
            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="font-13">2021 © <b>Job4Students</b> - All rights reserved.</div>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
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
  