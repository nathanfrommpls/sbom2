<?php

    $nav_selected = "REPORTS"; 
    $left_buttons = "YES"; 
    $left_selected = "APPLICATIONSTATUSCHART"; 

    include("./index.php");
    global $db;
   
?>
<html>

    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

        <script type="text/javascript">

        let queryArray = [['Application Status', 'Count', {role:'annotation'}]];

        <?php
        $query = $db->query("SELECT app_status, COUNT(app_status) AS occurrences FROM sbom GROUP BY app_status;");

        while($query_row = $query->fetch_assoc()) {
            echo 'queryArray.push(["'.$query_row["app_status"].'", '.$query_row["occurrences"].', "'.$query_row["app_status"].'"]);';
        }
        ?>
        </script>

        <!-- Google Pie Chart API Code -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawPieChart);

        function drawPieChart() {
            var data = google.visualization.arrayToDataTable(queryArray);

            var options = {
            title: 'Application Report'
            };

            var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));

            chart.draw(data, options);
        }
        </script>
        <!-- End Google Pie Chart API Code -->

        <!-- Google Bar Chart API Code -->
        <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawBarChart);

        function drawBarChart() {
            var data = google.visualization.arrayToDataTable(queryArray);

            var options = {
                title: 'Application Report',
                //chartArea: {width: '50%'},
                width: 900,
                height: 500,
                hAxis: {title: 'Occurrences', minValue: 0},
                vAxis: {title: 'Application Status'},
                legend: { position: "none" }
            };

            var chart = new google.visualization.BarChart(document.getElementById('bar_chart'));
            chart.draw(data, options);
        }
        </script>
        <!-- End Google Bar Chart API Code -->
    </head>

    <body>
        <div class="right-content">
            <div class="container">

                <h3 style = "color: #01B0F1;">Reports --> Application Status Chart.</h3>
                <h3><img src="images/reports.png" style="max-height: 35px;" /> Application Status Chart</h3>

            </div>
        </div>  

        <br>
        <div class="container">

            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse-pie-chart">Pie Chart</a>
                    </h4>
                </div>
                <div id="collapse-pie-chart" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <!-- Google Pie Chart API Code -->
                        <div id="pie_chart" style="width: 900px; height: 500px;"></div>
                        <!-- End Google Pie Chart API Code -->
                    </div>
                </div>
                </div>

                <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse-bar-chart">Bar Chart</a>
                    </h4>
                </div>
                <div id="collapse-bar-chart" class="panel-collapse collapse">
                    <div class="panel-body">
                        <!-- Google Bar Chart API Code -->
                        <div id="bar_chart" style="width: 900px; height: 500px;"></div>
                        <!-- End Google Bar Chart API Code -->
                    </div>
                </div>
                </div>               
                
            </div> 
        </div>

        <h3> &nbsp; &nbsp; &nbsp; &nbsp; File for this page: reports_<span style="color:red">application</span>_status_chart.php</h3>
    </body>

</html>
        

 <style>
   tfoot {
     display: table-header-group;
   }
 </style>

  <?php include("./footer.php"); ?>
