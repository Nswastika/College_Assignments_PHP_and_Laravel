<?php
    session_start();
    if(isset($_SESSION['user_id']) && $_SESSION['category_id'] && $_SESSION['user_type'] = "Student"){
        $user_id = $_SESSION['user_id'];
        $category_id = $_SESSION['category_id'];	
        }else{
            header('location:login.php');
        }
    include 'includes/connection.php';  
?>

<?php
require_once __DIR__ . '/vendor/autoload.php';

// Grab variables
if(isset($_POST['submit'])){
$fullname = $_POST['fullname'];
$profession = $_POST['profession'];
$city = $_POST['city'];
$state = $_POST['state'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$schoolname = $_POST['schoolname'];
$startdate = $_POST['startdate'];
$percentage = $_POST['percentage'];
$graduation = $_POST['graduation'];
$schoolname1 = $_POST['schoolname1'];
$startdate1 = $_POST['startdate1'];
$percentage1 = $_POST['percentage1'];
$study1 = $_POST['study1'];
$graduation1 = $_POST['graduation1'];
$schoolname2 = $_POST['schoolname2'];
$startdate2 = $_POST['startdate2'];
$percentage2 = $_POST['percentage2'];
$study2 = $_POST['study2'];
$graduation2 = $_POST['graduation2'];
$check = $_POST['check'];
$star = $_POST['star'];
$star1 = $_POST['star1'];
$star2 = $_POST['star2'];
$star3 = $_POST['star3'];
$star4 = $_POST['star4'];
$star5 = $_POST['star5'];
$lang1 = $_POST['lang1'];
$lang2 = $_POST['lang2'];
$summary = $_POST['summary'];
$skill = $_POST['skill'];
$skill1 = $_POST['skill1'];
$skill2 = $_POST['skill2'];
$skill3 = $_POST['skill3'];
$skill4 = $_POST['skill4'];
$skill5 = $_POST['skill5'];
$skill6 = $_POST['skill6'];
$skill7 = $_POST['skill7'];
$summary = $_POST['summary'];

$mpdf = new \Mpdf\Mpdf();

$data = "";


$data .= "
<h2><strong>$fullname</strong><br/>
$profession</h2>
<p>$state, $city<br/>
$phone<br/>
$email</p>
<p>$summary</p>

<h3>Education</h3>
<p>$startdate2 - $check<br/>
<strong>$schoolname2</strong><br/>
$study2  <br/>
Percentage: $percentage2<br/>
Graduation date: $graduation2</p>

<p>$startdate1 - $graduation1<br/>
<strong>$schoolname1</strong><br/>
$study1 <br/>
Percentage: $percentage1</p>

<p>$startdate - $graduation<br/>
<strong>$schoolname</strong><br/>
$study1 <br/>
Percentage: $percentage</p>
 
<h3>Technical Skills</h3>
<p>$skill&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$star<br/>
$skill1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$star1<br/>
$skill2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$star2<br/>
$skill3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$star3<br/>
$skill4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$star4<br/>
$skill5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$star5</p>

<h3>Languages</h3>
<p>$skill6&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  $lang1<br/>
$skill7&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     $lang2</p>";

$mpdf->WriteHtml($data);

$mpdf->output("Resume.pdf",'D');

}
?>


<?php
 include "includes/header.php";
?>
	 <section class="inner-banner" style="background:#242c36 url(images/xxxx.jpg) no-repeat">
		<div class="container">
			<div class="caption">
				<h2>Resume for Freshers</h2>
				<p>Get your dream jobs <span>2021</span></p>
			</div>
		</div>
	</section>

    <!-- HOME -->
    <section class="pricind">
			<div class="container">
                <div class ="col-md-12 col-sm-12">
                <h5>If you have a job experience. Create resume with job details. Click here !!!<a href ="create_resume_job.php"> Create Resume</a></h1><br/><br/>
                    <form action="create_resume.php" method="post">
                        <h5>Personal Information</h1>
				            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">Full Name</label>
						        <input type="text" required  class="form-control input-lg" name="fullname" required>
                                
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">Profession</label>
						        <input type="text" required  class="form-control input-lg" name="profession" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">City</label>
						        <input type="text" required  class="form-control input-lg" name="city" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">State/Provience</label>
						        <input type="text" required  class="form-control input-lg" name="state" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                               <label for="job-description">Phone</label>
						       <input type="text" required  class="form-control input-lg" name="phone" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">Email Address</label>
						        <input type="text" required  class="form-control input-lg" name="email" required>
                            </div>
                            <h5>Education(School)</h1>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">School Name</label>
						        <input type="text" required  class="form-control input-lg" name="schoolname" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">Start Date</label>
						        <input type="text" required  class="form-control input-lg" name="startdate" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">S.E.E Percentage</label>
						        <input type="text" required  class="form-control input-lg" name="percentage" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">Completion Year</label>
						        <input type="text" required  class="form-control input-lg" name="graduation" required>
                            </div>
                           

                            <h5>Education(High School)</h1>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">College Name</label>
						        <input type="text" required  class="form-control input-lg" name="schoolname1" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">Start Date</label>
						        <input type="text" required  class="form-control input-lg" name="startdate1" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">Percentage</label>
						        <input type="text" required  class="form-control input-lg" name="percentage1" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">Field of Study</label>
						        <input type="text" required  class="form-control input-lg" name="study1" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">Completion Year</label>
						        <input type="text" required  class="form-control input-lg" name="graduation1" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <br/><br/><br/><br/>
                            </div>

                            <h5>Education (University)</h1>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">College Name</label>
						        <input type="text" required  class="form-control input-lg" name="schoolname2" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">Joined Year</label>
						        <input type="text" required  class="form-control input-lg" name="startdate2" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">Percentage</label>
						        <input type="text"  required class="form-control input-lg" name="percentage2" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">Field of Study</label>
						        <input type="text"  required class="form-control input-lg" name="study2" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description">Graduation Year</label>
						        <input type="text"  required class="form-control input-lg" name="graduation2" required>
                            </div>
                            <div class="col-md-6 col-sm-6"  style="text-align:justify;">
                                <label for="job-description"></label>
                                <input type="checkbox" required class="form-check-input" id="exampleCheck1" name="check" value="present" required>
                                <label class="form-check-label " for="exampleCheck1 ">I currently study here</label> <br/><br/><br/><br/>
                            </div>

                            <h5>Technical Skills</h1>
                            <div class="col-md-6 col-sm-6">
                                <div class="col-md-8 col-sm-8">
                                    <label for="job-description">Skill 1</label>
						            <input type="text"  class="form-control input-lg" name="skill" required>
                                </div>   
                                <div class="col-md-4 col-sm-4"><br/><br/>
                                    <div class="rating">
                                        <span><input type="radio" name="star" id="str5" value="•••••"><label for="str5"></label></span>
                                        <span><input type="radio" name="star" id="str4" value="••••"><label for="str4"></label></span>
                                        <span><input type="radio" name="star" id="str3" value="•••"><label for="str3"></label></span>
                                        <span><input type="radio" name="star" id="str2" value="••"><label for="str2"></label></span>
                                        <span><input type="radio" name="star" id="str1" value="•"><label for="str1"></label></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="col-md-8 col-sm-8">
                                    <label for="job-description">Skill 2</label>
						            <input type="text"  class="form-control input-lg" name="skill1" required>
                                </div>   
                                <div class="col-md-4 col-sm-4"><br/><br/>
                                    <div class="rating1">
                                        <span><input type="radio" name="star1" id="str5" value="•••••"><label for="str5"></label></span>
                                        <span><input type="radio" name="star1" id="str4" value="••••"><label for="str4"></label></span>
                                        <span><input type="radio" name="star1" id="str3" value="•••"><label for="str3"></label></span>
                                        <span><input type="radio" name="star1" id="str2" value="••"><label for="str2"></label></span>
                                        <span><input type="radio" name="star1" id="str1" value="•"><label for="str1"></label></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="col-md-8 col-sm-8">
                                    <label for="job-description">Skill 3</label>
						            <input type="text"  class="form-control input-lg" name="skill2" required>
                                </div>   
                                <div class="col-md-4 col-sm-4"><br/><br/>
                                    <div class="rating2">
                                        <span><input type="radio" name="star2" id="str5" value="•••••"><label for="str5"></label></span>
                                        <span><input type="radio" name="star2" id="str4" value="••••"><label for="str4"></label></span>
                                        <span><input type="radio" name="star2" id="str3" value="•••"><label for="str3"></label></span>
                                        <span><input type="radio" name="star2" id="str2" value="••"><label for="str2"></label></span>
                                        <span><input type="radio" name="star2" id="str1" value="•"><label for="str1"></label></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="col-md-8 col-sm-8">
                                    <label for="job-description">Skill 4</label>
						            <input type="text"  class="form-control input-lg" name="skill3" required>
                                </div>   
                                <div class="col-md-4 col-sm-4"><br/><br/>
                                    <div class="rating3">
                                        <span><input type="radio" name="star3" id="str5" value="•••••"><label for="str5"></label></span>
                                        <span><input type="radio" name="star3" id="str4" value="••••"><label for="str4"></label></span>
                                        <span><input type="radio" name="star3" id="str3" value="•••"><label for="str3"></label></span>
                                        <span><input type="radio" name="star3" id="str2" value="••"><label for="str2"></label></span>
                                        <span><input type="radio" name="star3" id="str1" value="•"><label for="str1"></label></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="col-md-8 col-sm-8">
                                    <label for="job-description">Skill 5</label>
						            <input type="text"  class="form-control input-lg" name="skill4" required>
                                </div>   
                                <div class="col-md-4 col-sm-4"><br/><br/>
                                    <div class="rating4">
                                        <span><input type="radio" name="star4" id="str5" value="•••••"><label for="str5"></label></span>
                                        <span><input type="radio" name="star4" id="str4" value="••••"><label for="str4"></label></span>
                                        <span><input type="radio" name="star4" id="str3" value="•••"><label for="str3"></label></span>
                                        <span><input type="radio" name="star4" id="str2" value="••"><label for="str2"></label></span>
                                        <span><input type="radio" name="star4" id="str1" value="•"><label for="str1"></label></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="col-md-8 col-sm-8">
                                    <label for="job-description">Skill 6</label>
						            <input type="text"  class="form-control input-lg" name="skill5" required>
                                </div>   
                                <div class="col-md-4 col-sm-4"><br/><br/>
                                    <div class="rating5">
                                        <span><input type="radio" name="star5" id="str5" value="•••••"><label for="str5"></label></span>
                                        <span><input type="radio" name="star5" id="str4" value="••••"><label for="str4"></label></span>
                                        <span><input type="radio" name="star5" id="str3" value="•••"><label for="str3"></label></span>
                                        <span><input type="radio" name="star5" id="str2" value="••"><label for="str2"></label></span>
                                        <span><input type="radio" name="star5" id="str1" value="•"><label for="str1"></label></span>
                                    </div>
                                </div>
                            </div>

                            <h5>Languages</h1>
                            <div class="col-md-6 col-sm-6">
                                <div class="col-md-8 col-sm-8">
                                    <label for="job-description">Language 1</label>
						            <input type="text"  class="form-control input-lg" name="skill6" required>
                                </div>   
                                <div class="col-md-4 col-sm-4"><br/><br/>
                                    <div class="rating6">
                                        <span><input type="radio" name="lang1" id="str5" value="•••••"><label for="str5"></label></span>
                                        <span><input type="radio" name="lang1" id="str4" value="••••"><label for="str4"></label></span>
                                        <span><input type="radio" name="lang1" id="str3" value="•••"><label for="str3"></label></span>
                                        <span><input type="radio" name="lang1" id="str2" value="••"><label for="str2"></label></span>
                                        <span><input type="radio" name="lang1" id="str1" value="•"><label for="str1"></label></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="col-md-8 col-sm-8">
                                    <label for="job-description">Language 2</label>
						            <input type="text"  class="form-control input-lg" name="skill7" required>
                                </div>   
                                <div class="col-md-4 col-sm-4"><br/><br/>
                                    <div class="rating7">
                                        <span><input type="radio" name="lang2" id="str5" value="•••••"><label for="str5"></label></span>
                                        <span><input type="radio" name="lang2" id="str4" value="••••"><label for="str4"></label></span>
                                        <span><input type="radio" name="lang2" id="str3" value="•••"><label for="str3"></label></span>
                                        <span><input type="radio" name="lang2" id="str2" value="••"><label for="str2"></label></span>
                                        <span><input type="radio" name="lang2" id="str1" value="•"><label for="str1"></label></span>
                                    </div>
                                </div>
                            </div>
                            <h5>Summary</h1>
                            <div class="col-md-12 col-sm-12"  style="text-align:justify;">
                                <label for="job-description">Aims and objectives</label>
						        <!-- <input type="text"  class="form-control input-lg" name="schoolname"> -->
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="summary"required></textarea>
                            </div>
              
              
                            <div class="col-md-12 col-sm-12">
                                <div class="text-center">
                                    <input style="background-color:#ff8f3e;" type="submit" name="submit" value="Download Resume" class="btn px-4 btn-primary text-white">
                                </div>
                            </div>
                </form>  
            
         
            </div>
        </div>
    </section>
		
<?php
include "includes/footer.php";

?>
