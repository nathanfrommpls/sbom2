<?php

    $nav_selected = "REPORTS"; 
    $left_buttons = "YES"; 
    $left_selected = "REPORTSPIECHART"; 

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
        
        function createPieChart(pieChart){
            let name = pieChart[0];
            let columnTitle = pieChart[1];

            let queryArray = [[columnTitle, 'Count', {role:'annotation'}]];
            
            switch(name){
                case 'Application':
                    <?php
                    $query = $db->query("SELECT app_status, COUNT(app_status) AS occurrences FROM sbom GROUP BY app_status;");
                    while($query_row = $query->fetch_assoc()) {
                        echo 'queryArray.push(["'.$query_row["app_status"].'", '.$query_row["occurrences"].', "'.$query_row["app_status"].'"]);';
                    }
                    ?>
                    break;
                case 'Component':
                    <?php
                    $query = $db->query("SELECT cmp_status, COUNT(cmp_status) AS occurrences FROM sbom GROUP BY cmp_status;");
                    while($query_row = $query->fetch_assoc()) {
                        echo 'queryArray.push(["'.$query_row["cmp_status"].'", '.$query_row["occurrences"].', "'.$query_row["cmp_status"].'"]);';
                    }
                    ?>
                    break;
                case 'Request':
                    <?php
                    $query = $db->query("SELECT request_status, COUNT(request_status) AS occurrences FROM sbom GROUP BY request_status;");
                    while($query_row = $query->fetch_assoc()) {
                        echo 'queryArray.push(["'.$query_row["request_status"].'", '.$query_row["occurrences"].', "'.$query_row["request_status"].'"]);';
                    }
                    ?>
                    break;
                case 'Request Step':
                    <?php
                    $query = $db->query("SELECT request_step, COUNT(request_step) AS occurrences FROM sbom GROUP BY request_step;");
                    while($query_row = $query->fetch_assoc()) {
                        echo 'queryArray.push(["'.$query_row["request_step"].'", '.$query_row["occurrences"].', "'.$query_row["request_step"].'"]);';
                    }
                    ?>
                    break;
            }

            return queryArray;
        }

        let pieCharts = [['Application', 'Application Status'], ['Component', 'Component Status'], ['Request', 'Request Status'], ['Request Step', 'Request Step']];

        for(let i = 0; i < pieCharts.length; i++){
            pieCharts[i] = createPieChart(pieCharts[i]);
        }
        </script>

        <!-- Google Pie Chart API Code -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawPieCharts);

        function drawPieCharts() {
            pieCharts.forEach(queryArray => drawPieChart(queryArray));
        }

        function drawPieChart(queryArray){
            var data = google.visualization.arrayToDataTable(queryArray);

            let title = queryArray[0][0] + ' Report';

            var options = {
                title: title,
                width: 500,
                height: 500,
            };

            var chart = new google.visualization.PieChart(document.getElementById(title.replace(/ /g, '')));

            google.visualization.events.addListener(chart, 'select', selectHandler);

            chart.draw(data, options);

            function selectHandler(){
                var selectedItem = chart.getSelection()[0];

                if (selectedItem) {
                    var statusSelection = data.getValue(selectedItem.row, 0);
                    var reportName = queryArray[0][0].toLowerCase().replace(/ /g, '');

                    document.cookie = encodeURI("app_status_cookie=");
                    document.cookie = encodeURI("cmp_status_cookie=");
                    document.cookie = encodeURI("request_status_cookie=");
                    document.cookie = encodeURI("request_step_cookie=");

                    switch(reportName){
                        case "applicationstatus":
                            document.cookie = encodeURI("app_status_cookie=" + statusSelection); break;
                        case "componentstatus":
                            document.cookie = encodeURI("cmp_status_cookie=" + statusSelection); break;
                        case "requeststatus":
                            document.cookie = encodeURI("request_status_cookie=" + statusSelection); break;
                        case "requeststep":
                            document.cookie = encodeURI("request_step_cookie=" + statusSelection); break;
                    }

                    location.reload();
                }               
            }
        }
        </script>
        <!-- End Google Pie Chart API Code -->

        
    </head>

    <body>
        <div class="right-content">
            <div class="container">
                <h3 style = "color: #01B0F1;">Reports --> Pie Chart.</h3>
                <h3><img src="images/reports.png" style="max-height: 35px;" /> Pie Chart</h3>
            </div>
        </div>  
        <div class="container">
            <table>
                <tr>
                    <td><div style=" width:400px; height:400px; disply:inline-block;" id="ApplicationStatusReport" style="width: 900px; height: 500px;"></div></td>
                    <td><div style="width:400px; height:400px; disply:inline-block;" id="ComponentStatusReport" style="width: 900px; height: 500px;"></div></td>
                </tr>
                <tr>
                    <td><div style=" width:400px; height:400px; disply:inline-block;" id="RequestStatusReport" style="width: 900px; height: 500px;"></div></td>                   
                    <td><div style=" width:400px; height:400px; disply:inline-block;" id="RequestStepReport" style="width: 900px; height: 500px;"></div></td>
                </tr>
            </table><br><br><br><br><br><br>
        <?php
        error_reporting(E_ERROR | E_WARNING | E_PARSE);    
        if ($_COOKIE['app_status_cookie']!= null) {
            $appStatusSelection = $_COOKIE['app_status_cookie'];
        }elseif($_COOKIE['cmp_status_cookie']!= null) {
            $cmpStatusSelection = $_COOKIE['cmp_status_cookie'];  
        }elseif ($_COOKIE['request_status_cookie']!= null) {
            $requestType = $_COOKIE['request_status_cookie'];
        }elseif ($_COOKIE['request_step_cookie']!= null) {
            $requestStep = $_COOKIE['request_step_cookie'];
        }
        ?>
        
          
        <table id="info" cellpadding="0" cellspacing="0" border="0"
                class="datatable table table-striped table-bordered datatable-style table-hover"
                width="100%" style="width: 100px;">
                <thead>
                    <tr id="table-first-row">
                            <th>App ID</th>
                            <th>App Name</th>
                            <th>App Version</th>
                            <th>CMP ID</th>
                            <th>CMP Name</th>
                            <th>CMP Version</th>
                            <th>CMP Type</th>
                            <th>App Status</th>
                            <th>CMP Status</th>
                            <th>Request ID</th>
                            <th>Request Date</th>
                            <th>Request Status</th>
                            <th>Request Step</th>                        
                            <th>Notes</th>
                    </tr>
                </thead>
                <tbody>

                <?php

                $sql = "SELECT * from sbom;";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td>'.$row["app_id"].' </span> </td>
                                <td>'.$row["app_name"].'</td>
                                <td>'.$row["app_version"].'</td>
                                <td>'.$row["cmp_id"].' </span> </td>
                                <td>'.$row["cmp_name"].'</td>
                                <td>'.$row["cmp_version"].'</td>
                                <td>'.$row["cmp_type"].' </span> </td>
                                <td>'.$row["app_status"].' </span> </td>
                                <td>'.$row["cmp_status"].' </span> </td>
                                <td>'.$row["request_id"].'</td>
                                <td>'.$row["request_date"].'</td>
                                <td>'.$row["request_status"].'</td>
                                <td>'.$row["request_step"].'</td>
                                <td>'.$row["notes"].' </span> </td>
                            </tr>';
                    }//end while
                }//end if
                else {
                    echo "0 results";
                }//end else

                $result->close();
                ?>

                </tbody>
                <tfoot>
                    <tr>
                            <th>App ID</th>
                            <th>App Name</th>
                            <th>App Version</th>
                            <th>CMP ID</th>
                            <th>CMP Name</th>
                            <th>CMP Version</th>
                            <th>CMP Type</th>
                            <th>App Status</th>
                            <th>CMP Status</th>
                            <th>Request ID</th>
                            <th>Request Date</th>
                            <th>Request Status</th>
                            <th>Request Step</th> 
                            <th>Notes</th>
                    </tr>
                </tfoot>
            </table>
       
            <script type="text/javascript" language="javascript">

                var app_status, cmp_status, request_status, request_step = null;
                <?php
                if ($appStatusSelection != null) {
                    echo "app_status ='".$appStatusSelection."';";
                } else if ($cmpStatusSelection != null) {
                    echo  "cmp_status ='".$cmpStatusSelection."';";
                } else if ($requestType!= null) {
                    echo "request_status ='".$requestType."';";
                } else if ($requestStep != null) {
                    echo "request_step ='".$requestStep."';";
                } else {
                    echo "console.log(\"No Cookies Set\");";
                }
                ?>

            $(document).ready( function () {

            $('#info').DataTable( {
                dom: 'lfrtBip',
                buttons: [
                    'copy', 'excel', 'csv', 'pdf'
                ] }
            );

        

        $('#info thead tr').clone(true).appendTo( '#info thead' );
        $('#info thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            if (title == 'App Status' && app_status != null) {
                $(this).html( '<input type="text" placeholder="Search '+title+'" value = "'+app_status+'" autofocus/>' );
                $( this ).trigger( 'keyup' );
            } else if (title == 'CMP Status' && cmp_status != null) {
                $(this).html( '<input type="text" placeholder="Search '+title+'" value = "'+cmp_status+'" autofocus/>' );
                $( 'input', this ).trigger( 'keyup change' );
            } else if (title == 'Request Status' && title != 'Request Step' && request_status != null) {
                $(this).html( '<input type="text" placeholder="Search '+title+'" value = "'+request_status+'" autofocus/>' );
                $( this ).trigger( 'change' );
            } else if (title == 'Request Step' && title != 'Request Status' && request_step != null) {
                $(this).html( '<input type="text" placeholder="Search '+title+'" value = "'+request_step+'" autofocus/>' );
                $( this ).keyup();
            } else {
                $(this).html( '<input type="text" placeholder="Search '+title+'"/>' );
            }
                      
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
            

        } );
    
        var table = $('#info').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            retrieve: true
        } );
        
    } );



        </script>                  
        </div>
    </body>

</html>
        

 <style>
   tfoot {
     display: table-header-group;
   }
 </style>
 <?php include("./footer.php"); ?>
