<?php
 include 'filesLogic.php';
include 'includes/header.php';
include 'includes/sidebar.php';
?>


        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">List of Job Applications</h1>
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
                                   
                                    <th>Resume</th>
                                    <th>Job Id</th>
                                    <th>File</th>
                                    <th>User Email</th>
                                    <th>Reply</th>
                                    
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                   
                                    <th>Resume</th>
                                    <th>Job Id</th>
                                    <th>File</th>
                                    <th>User Email</th>
                                    <th>Reply</th>
                                    
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $detail="SELECT * FROM resumes where fk_user_id = '$user_id'";
                                $detailqry = mysqli_query($conn, $detail);
                                while($row = mysqli_fetch_array($detailqry)){
                                    $id = $row['resume_id'];
                                    $sql = "SELECT * FROM resumes where fk_user_id = $user_id and resume_id = $id";
                                    $result = mysqli_query($conn, $sql);

                                    $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                ?>
                                <tr>
                                    
                                    <td><?php echo $row['name'];?>
                                    <td><?php echo $row['job_id'];?>
                                    </td>
                                    
							       
                                     
                                    <td>
                                    <?php
                                    foreach ($files as $file){?>
                                        <a href="resume_manage.php?file_id=<?php echo $file['resume_id'] ?>">Download</a>
                                    <?php } ?>
                                    </td> 
                                    <td><?php echo $row['user_email'];?></td>        
                                    <td> 							
								        <a class="btn btn-primary" href="write_resume_reply.php?sid=<?php echo $row['resume_id']; ?>"><b>Write Reply</b>
								        </a>							
						            </td>	
                                    <?php
									if($row['status']=='pending'){
                                        echo '<td>';
										echo "<font color='#750000'><b>Not Sent</b></font>";
										$buttonText = "SEND";
                                        echo '</td>';?>
                                         <td class="text-center">							
								        <a class="btn btn-danger" href="action_resume.php?sid=<?php echo $row['resume_id']; ?>"><b><?php echo $buttonText; ?></b>
								        </a>							
								        </td>
                                    <?php
									}else{
                                        echo '<td>';
										echo "<font color='#8ed100'><b>Reply Sent</b></font>";
                                        echo '</td>';?>
                                        <td>														
								        </td>
									<?php }
									
								    ?>	
							       
                                
                                <?php }?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>            
            </div>
            <!-- END PAGE CONTENT-->    
            <footer class="page-footer">
                <div class="font-13">2021 © <b>Job4Students</b> - All rights reserved.</div>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
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