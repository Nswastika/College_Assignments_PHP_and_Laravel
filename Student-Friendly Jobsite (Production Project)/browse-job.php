<?php
    session_start();
    include 'includes/connection.php';
    $custid = $_SESSION["custid"] = 30001;
?>
<?php
	include 'includes/header.php';
?>
		
	<!-- Inner Banner -->
	<section class="inner-banner" style="background:#242c36 url(images/xxxx.jpg) no-repeat">
		<div class="container">
			<div class="caption">
				<h2>Get your jobs</h2>
				<p>Get your dream jobs <span>2021</span></p>
			</div>
		</div>
	</section>
		
	<section class="jobs">
		<div class="container">
			<div class="row heading">
				<h2>Search Your Job</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
			</div>
			<div class="row top-pad">
				<div class="filter">
					<div class="col-md-2 col-sm-3">
						<p>Browse by category:</p>
					</div>
					<div class="col-md-10 col-sm-9 pull-right">
						<ul class="filter-list">
						    <?Php
                            $conn = mysqli_connect("localhost","root");
                            $qry = mysqli_select_db($conn, 'Students_Jobsite'); 
                            $qry = "SELECT * FROM category";
                            $stid = mysqli_query($conn, $qry);
                               
                            if (isset($_GET['query'])) {
                                $keyword = $_GET['query'];
                            }

                            while (($row = mysqli_fetch_assoc($stid)) != false) {
                                $catid = $row['category_id'];
                                $q = "SELECT COUNT(category_id) AS NUMROWS FROM job WHERE category_id = $catid";
                                $st = mysqli_query($conn, $q);
                                $r = mysqli_fetch_assoc($st);
                            ?>
                                <li class="active"><a href="browse-job.php?categoryset=<?php echo $catid;?>"><?php echo $row['categoryname']?><span><?php echo $r['NUMROWS'];?></span></a></li>
                            <?php 
                            }
                            ?>

						</ul>	
					</div>
				</div>
			</div>
				<div class="row top-pad">
					<div class="filter">
						<div class="col-md-2 col-sm-3">
							<p>Search By:</p>
						</div>
						
						<div class="col-md-10 col-sm-9 pull-right">
							<ul class="filter-list">
								<li>
									<input id="checkbox-1" class="checkbox-custom" name="checkbox-1" type="checkbox" checked="">
									<label for="checkbox-1" class="part-time checkbox-custom-label">Part Time</label>
								</li>
								
								
								<li>
									<input id="checkbox-4" class="checkbox-custom" name="checkbox-4" type="checkbox">
									<label for="checkbox-4" class="internship checkbox-custom-label">Internship</label>
								</li>

							</ul>	
						</div>
					</div>
				</div>
				<div class="companies">
				<?php
                            if (isset($_GET['pageno'])) {
                                $pageno = $_GET['pageno'];
                            } else {
                                $pageno = 1;
                            }

                            if (isset($_GET['sorttype'])) {
                                $sort = $_GET['sorttype'];
                            } else {
                                $sort = "job_id";
                            }

                            $no_of_records_per_page = 10;
                            $offset = ($pageno-1) * $no_of_records_per_page;

                            if (isset($_GET['categoryset'])) {
                                $_SESSION['cate'] = $_GET['categoryset'];
                                $cate = $_SESSION['cate'];
                                $qry = "SELECT * FROM (SELECT A.*, ROWNUM RNUM FROM (SELECT * FROM job WHERE category_id = $cate ORDER BY $sort) A WHERE ROWNUM <= $offset+10) WHERE RNUM > $offset";
                                $total_pages_sql = "SELECT COUNT(*) AS NUMROWS FROM job WHERE category_id LIKE $cate";
                            }
                            else if(isset($_GET['query'])){
                                $search = strtolower($_GET['query']);
                                $qry = "SELECT * FROM (SELECT A.*, ROWNUM RNUM FROM (SELECT * FROM job WHERE lower(COMPANY_NAME) LIKE '%$search%' OR lower(JOB_NAME) LIKE '%$search%' OR lower(JOB_TIME) LIKE '%$search%' OR category_id LIKE (SELECT category_id FROM job WHERE category_id = (SELECT category_id FROM category WHERE lower(CATEGORYNAME) LIKE '%$search%') GROUP BY category_id) ORDER BY job_id) A WHERE ROWNUM <= $offset+10) WHERE RNUM > $offset";
                                $total_pages_sql = "SELECT COUNT(*) AS NUMROWS FROM JOB WHERE lower(COMPANY_NAME) LIKE '%$search%' OR lower(JOB_NAME) LIKE '%$search%' OR lower(JOB_TIME) LIKE '%$search%' OR category_id LIKE (SELECT category_id FROM job WHERE category_id = (SELECT category_id FROM category WHERE lower(CATEGORYNAME) LIKE '%$search%') GROUP BY category_id) ORDER BY job_id";
                            }
                            else {
                                $qry = "SELECT * FROM (SELECT A.*, ROWNUM RNUM FROM (SELECT * FROM job ORDER BY $sort) A WHERE ROWNUM <= $offset+10) WHERE RNUM > $offset";
                                $total_pages_sql = "SELECT COUNT(*) AS NUMROWS FROM job";
                            }
                            
                            
                            $result = mysqli_query($conn,$total_pages_sql);
                            
                            $total_row = mysqli_fetch_assoc($result);
                            $total_rows = $total_row['NUMROWS'];
                            $total_pages = ceil($total_rows / $no_of_records_per_page);

                            $stid = mysqli_query($conn, $qry);
                            
                            ?>
							 <div class="shop-found">
                                    <p>Showing <span><?php if (($offset+10)>$total_rows) {echo $total_rows;} else{echo $offset+10;}?></span> Products of<span> <?php echo $total_rows; ?></span></p>
                                </div>
								<div class="shop-selector">
                                    <?php 
                                    if (!isset($search)) {
                                    ?>
                                    <div class="dropdown show">
                                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?php
                                                if (isset($sort) && $sort=="company_name") {
                                                    echo "Sorted by Company";
                                                }
                                                else if (isset($sort) && $sort=="category_id") {
                                                    echo "Sorted by Category";
                                                }
                                                else if (isset($sort) && $sort=="job_time") {
                                                    echo "Sorted by time";
                                                }
                                                else if (isset($sort) && $sort=="job_name") {
                                                    echo "Sorted By Name";
                                                }
                                                else if (isset($sort) && $sort=="salary") {
                                                    echo "Sorted by salary";
                                                }
                                                else{
                                                    echo "Sort By";
                                                }
                                            ?>    
                                            
                                        </a>
                                        
                                        <div>
                                            <a  href="?sorttype=company_name">Company</a>
                                            <a  href="?sorttype=category_id">Category</a>
                                            <a  href="?sorttype=job_time">Time</a>
                                            <a  href="?sorttype=job_name">Alphabetically</a>
                                            <a href="?cate&sorttype=salary">Salary</a>
                                        </div>
                                        
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
								<?php
                                if(isset($_GET['query'])){
                                  echo "Showing Results for ".$_GET['query'];
                                } ?>

                                <?php
                                $conn = mysqli_connect("localhost","root");
                                $qry = mysqli_select_db($conn, 'Students_Jobsite');
                                $qry = "SELECT * FROM job";
                                $stid = mysqli_query($conn, $qry);
                                while (($row = mysqli_fetch_assoc($stid)) != false) { ?>
					            <div class="company-list">
						            <div class="row">
							            <div class="col-md-2 col-sm-2">
								            <div class="company-logo">
									            <img src="images/<?php echo $row['company_image']?>" class="img-responsive" alt="" />
								            </div>
							            </div>
                                        <div class="col-md-8 col-sm-8">
								            <div class="company-content">
									            <h3><?php echo $row['company_name']?></h3>
									            <p><span class="company-name"><i class="fa fa-briefcase"></i><?php echo $row['job_name']?></span><span class="company-location"><i class="fa fa-map-marker"></i> <?php echo $row['job_location']?></span><span class="package"><i class="fa fa-money"></i><?php echo $row['salary']?></span></p>
								            </div>
							            </div>
							            <div class="col-md-2 col-sm-2">
								            <button type="submit" class="btn view-job" name="View Job"><a href="company-detail.php?id=<?php echo $row['job_id'];?>">View Job</a></button>
								        </div>			
						            </div>				
					            </div>
					            <?php } ?>
					            <ul>
                                <?php
                                $number = 1;
                                for ($number; $number <= $total_pages; $number +=1) {
                                    if ($pageno == $number) {
                                        echo " <li class=\"active\"><a> $number </a></li> ";
                                    } else {
                                        if (isset($search)) {
                                            echo " <li><a href='?pageno=$number&query=$search'>$number</a></li>";
                                        }
                                        else if (isset($cate)) {
                                            echo " <li><a href='?pageno=$number&sorttype=$sort&categoryset=$cate'>$number</a></li>";
                                        }
                                        else{
                                            echo " <li><a href='?pageno=$number&sorttype=$sort'>$number</a></li>";
                                        }
                                    }
                                }
                                ?>
                                </ul>			
				</div>
			</div>
		</section>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<?php include 'includes/footer.php'; ?>