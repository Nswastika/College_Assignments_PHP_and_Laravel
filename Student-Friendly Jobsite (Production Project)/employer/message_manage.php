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
                <h1 class="page-title">Messages</h1>
                <ol class="breadcrumb">
                    <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Messages</li>
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
                                  
                                    <th>Message</th>
                                   
                                    <th>User Email</th>
                                    <th>Reply</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            
                                <tfoot>
                                <tr>
                                    
                                    <th>Message</th>
                                   
                                    <th>User Email</th>
                                    <th>Reply</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $detail="SELECT * FROM message where fk_user_id = '$user_id'";
                                $detailqry = mysqli_query($conn, $detail);
                                while($row = mysqli_fetch_array($detailqry)){
                                    $id = $row['message_id'];
                                ?>
                                <tr>
                                   
                                    <td><?php echo $row['message'];?></td>
                                    
                                    <td><?php echo $row['user_email'];?></td>
                                    <td> 							
								        <a class="btn btn-primary" href="write_reply.php?sid=<?php echo $row['message_id']; ?>"><b>Write Reply</b>
								        </a>							
								    </td>	
                                    <?php
									if($row['active']==1){
										
										echo '<td>';
										echo "<font color='#8ed100'><b>Message Sent</b></font>";
                                        echo '</td>'; 
                                        ?>
                                        <td>														
								        </td> <?php
                                     }else{
										echo '<td>';
										echo "<font color='#750000'><b>Not Sent</b></font>";
										$buttonText = "SEND";
                                        echo '</td>';
                                        ?>
                                        <td class="text-center">							
								        <a class="btn btn-danger" href="action_message.php?sid=<?php echo $row['message_id']; ?>"><b><?php echo $buttonText; ?></b>
								        </a>							
								    </td>
										
									<?php
									}
									
								    ?>	
							        
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