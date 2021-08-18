    <footer class="page-footer">
      <div class="font-13">2021 © <b>Job4Students</b> - All rights reserved.</div>
      <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
    </footer>
  </div>
</div>  
    <!-- END THEME CONFIG PANEL-->
    
   
    <!-- CORE PLUGINS-->
    <script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="./assets/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <script src="./assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.min.js" type="text/javascript"></script>
    <script src="assets/js/ajax-mail.js"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script src="./assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
      
    google.charts.setOnLoadCallback(drawPieChart);
      
    function drawPieChart() {

      var data = new google.visualization.arrayToDataTable([
        ["Country","People"],
        <?php
        for($i=0;$i<$resultCount;$i++){
          ?>[<?php echo "'".$country[$i]."', ".$people[$i] ?>],
        <?php } 
        ?>
        ]);

      var options = {
          title: "Percentage of Jobs",
          width: '100%',
          height: '200px',
          colors: [
            <?php
            for($i=0;$i<$resultCount;$i++) {
              echo "'".$color[$i]."',";
            } 
            ?>
          ]
        };
      var chart = new google.visualization.PieChart(document.getElementById('pie-chart'));
      chart.draw(data, options);
    }


    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBarBasic);

    function drawBarBasic() {

      var data = new google.visualization.arrayToDataTable([
         ['Country', 'Population', { role: 'style' }, { role: 'annotation' }],
        <?php
        for($i=0;$i<$resultCount;$i++){
          ?>[<?php echo "'".$country[$i]."', ".$people[$i].", '".$color[$i]."' , "."'".$people[$i]."'" ?>],
        <?php } 
        ?>
        ]);

      var options = {
    	    title: "Number of Jobs per Category",
        chartArea: {width: '100%'},
        hAxis: {
          title: 'Total Population',
          minValue: 0
        },
        vAxis: {
          title: 'City'
        },
        legend: { position: "none" }
      };

      var chart = new google.visualization.BarChart(document.getElementById('bar-chart'));

      chart.draw(data, options);
    }


  google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawColumnChart);
    function drawColumnChart() {
      var data = google.visualization.arrayToDataTable([
        ['Country', 'Population', { role: 'style' }, { role: 'annotation' }],
        <?php
        for($i=0;$i<$resultCount;$i++){
          ?>[<?php echo "'".$country[$i]."', ".$people[$i].", '".$color[$i]."' , "."'".$people[$i]."'" ?>],
        <?php } 
        ?>
        ]);


      var options = {
        // title: "Number of Jobs per Category",
        chartArea: {width: '100%'},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("column-chart"));
      chart.draw(data, options);
  }
  </script>
  
</body>
</html>