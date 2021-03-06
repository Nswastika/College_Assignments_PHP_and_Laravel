<!DOCTYPE html>
<html>
<head>
<!-- Font Awesome Icon Library -->
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <style>
    .rating {
        float:left;
        width:100%;
    }
    .rating span { float:right; position:relative; }
    .rating span input {
        position:absolute;
        top:0px;
        left:0px;
        opacity:0;
    }
    .rating span label {
        display:inline-block;
        width:20px;
        height:20px;
        text-align:center;
        color:#FFF;
        background:#ccc;
        margin-right:2px;
        background:url(images/star/emptystar.png);
    }
    .rating span:hover ~ span label,
    .rating span:hover label,
    .rating span.checked label,
    .rating span.checked ~ span label {
        background:url(images/star/fullstar.png);
        color:#FFF;
    }
</style>
</head>
<body>
<!-- Edit Profile -->
                <form class="form-horizontal" role="form" method="post" action="addreview.php" enctype="multipart/form-data">
                    <!--stars-->
                    <div class="form-group">
                    <div class="rating">
                        <span><input type="radio" name="star" id="str5" value="5"><label for="str5"></label></span>
                        <span><input type="radio" name="star" id="str4" value="4"><label for="str4"></label></span>
                        <span><input type="radio" name="star" id="str3" value="3"><label for="str3"></label></span>
                        <span><input type="radio" name="star" id="str2" value="2"><label for="str2"></label></span>
                        <span><input type="radio" name="star" id="str1" value="1"><label for="str1"></label></span>
                    </div>
                    <br/></div>
                    <!--review-->
                    
                    
                    <input class="btn-outline-dark btn-hover-black" type="submit" name="submit" value="Add Your Review" />
                    
                </form>
          </div>
       
  

</body>
<script>

$(document).ready(function(){
    // Check Radio-box
    $(".rating input:radio").attr("checked", false);

    $('.rating input').click(function () {
        $(".rating span").removeClass('checked');
        $(this).parent().addClass('checked');
    });
 
});

</script>
</html>
        









