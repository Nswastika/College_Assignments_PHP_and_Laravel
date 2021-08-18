<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php';
 include '../includes/connection.php';?>
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">List of Advices</h1>
                <ol class="breadcrumb">
                    <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">List of Advices</li>
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Data Table</div>
                    </div>
                    <div class="ibox-body">
                        <form method="get" action="add_advice.php">
                            &nbsp;&nbsp;&nbsp;<button type="submit" name="submit" class="btn btn-success">New <i class="fa fa-plus"></i> </button>
                        <form>                                                         
                    </div>
                    <div class="table-responsive ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Advisor name</th>
                                    <th>Advisor image</th>
                                    <th>Advisor description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Advisor name</th>
                                    <th>Advisor image</th>
                                    <th>Advisor description</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php
				               $conn = mysqli_connect("localhost","root");
                               // Select Database
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

                                $detail="SELECT * FROM advice";
                                $detailqry = mysqli_query($conn, $detail);
  
                                while($row = mysqli_fetch_array($detailqry)){	
                                    $url = "../".$row['advisor_image'];	
                                    $id = $row['advice_id'];	
                                ?>
                                <tr>
                                    <td><?php echo $row['advisor_name'];?></td>
                                    <td><img style="height:120px; width:100px;" class="img-responsive" src="<?php echo $url;?>" alt="No Image Found"></td>
                                    <td style="text-align:justify;"><?php echo $row['advice_description'];?></td>
                                    <td>							
                                        <a class="btn btn-warning btn-sm" href="edit_advice.php?sid=<?php echo $row['advice_id']; ?>">Edit
                                            <i class="fa fa-pencil"></i>                
                                        </a><br/><br/>					
                                        <a class="btn btn-danger btn-sm" href="delete_advice.php?sid=<?php echo $row['advice_id']; ?>">Delete
                                            <i class="fa fa-trash-o"></i>                
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