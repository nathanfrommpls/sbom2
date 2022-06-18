<?php
    $nav_selected = "SETUP"; 
    $left_selected = "GANTTPREFERENCE"; 

    include("../../../../index.php");

    global $db;

    //pulls the start date from the preferences table
    $sDate = findPreference('gantt_start', 'releases', 'open_date', 'first');
    //pulls the end date from the preferences table
    $eDate = findPreference('gantt_end', 'releases', 'rtm_date', 'last');
    //pulls the status from the preference table
    $status = findPreference('gantt_status', 'releases', 'status', 'all');
    //pulls the types from the preference table
    $types  = findPreference('gantt_type', 'releases', 'type', 'all');

    $statusSet = $db->query("SELECT DISTINCT `status` FROM releases ORDER BY `status` ASC");
    $typeSet = $db->query("SELECT DISTINCT `type` FROM releases ORDER BY `type` ASC"); 

?>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>

    <body>
    <?php
        if(isset($_GET['preferencesUpdated'])){
            if($_GET["preferencesUpdated"] == "Success"){
                echo "<br><h3 align=center style='color:green'>Success! The Preferences have been updated!</h3>";
            }
        }
        if(isset($_GET['preferencesUpdated'])){
            if($_GET["preferencesUpdated"] == "DateFail"){
                echo "<br><h3 align=center style='color:red'>Update Failed! The END DATE cannot come before the START DATE!</h3>";
            }
        }
        if(isset($_GET['preferencesUpdated'])){
            if($_GET["preferencesUpdated"] == "StatusFail"){
                echo "<br><h3 align=center style='color:red'>Update Failed! Please select at least one status to view!</h3>";
            }
        }
        if(isset($_GET['preferencesUpdated'])){
            if($_GET["preferencesUpdated"] == "TypeFail"){
                echo "<br><h3 align=center style='color:red'>Update Failed! Please select at least one type to view!</h3>";
            }
        }
    ?>
        <div class="right-content">
            <div class="container">

                <h3 style = "color: #01B0F1;">Setup --> Gantt Preferences</h3>
                <h3><img src="images/gantt.png" style="max-height: 35px;" /> Gantt Preferences</h3>

            </div>
        </div>  
        
        <div class="container">
            <h3>Set preferences on how to display the Gantt chart below:</h3>
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    <a data-toggle="collapse"  href="#collapse-date-range" aria-expanded="true" class>Date Range</a>
                    </h4>
                </div>
                <div id="collapse-date-range" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <form action="modifyThePreferences.php" method="POST">
                            <table style="width:500px">
                                <tr>
                                    <th style="width:200px"></th>
                                    <th>Current Value</th> 
                                    <th>Update Value</th>
                                </tr>
                                <tr>
                                    <td style="width:200px">Set Start Date:</td>
                                    <td><input disabled type="date" maxlength="12" size="15" value="<?php echo $sDate; ?>" title="Current value"></td> 
                                    <td><input required type="date" name="new_sDate" maxlength="12" size="15" value="<?php echo $sDate; ?>" title="Enter a start date"></td>
                                </tr>
                                <tr>
                                    <td style="width200px">Set End Date:</td>
                                    <td><input disabled type="date" maxlength="12" size="15" value="<?php echo $eDate; ?>" title="Current value"></td> 
                                    <td><input required type="date" name="new_eDate" maxlength="12" size="15" value="<?php echo $eDate; ?>" title="Enter a end date"></td>
                                </tr>
                            </table><br>
                            <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Modify Dates</button>
                        </form>
                    </div>
                </div>
                </div>
                <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" href="#collapse-release-date" aria-expanded="true" class>Release Status</a>
                    </h4>
                </div>
                <div id="collapse-release-date" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <form action="modifyThePreferences.php" method="POST">
                            <table style="width:5500px">
                                <tr>
                                    <th style="width:200px"></th>
                                    <th>Statuses</th> 
                                </tr>
                                <tr>
                                    <td style="width:200px">Current Status Range:</td>
                                    <td><input disabled type="string" maxlength="250" size="50" value="<?php echo $status; ?>" title="Current status"></td> 
                                </tr>
                                <tr>
                                    <td style="width200px">Select Status Range:</td>
                                    <td>
                                        <?php 
                                        $statusList = prefCheckbox('gantt_status', 'releases', 'status', 'status_list[]');
                                        echo  $statusList;
                                        /*
                                        while($rows = $statusSet->fetch_assoc()){
                                            $status=$rows['status']; 
                                        echo"<input type='checkbox' name='status_list[]' Value='$status'>&nbsp; $status &nbsp;&nbsp;";}
                                        */
                                        ?>
                                        </td>
                                </tr>
                            </table><br>
                            <button type="submit" name="status_submit" class="btn btn-primary btn-md align-items-center">Modify Status</button>
                        </form>
                    </div>
                </div>
                </div>
                <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" href="#collapse-type" aria-expanded="true" class>Type</a>
                    </h4>
                </div>
                <div id="collapse-type" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <form action="modifyThePreferences.php" method="POST">
                            <table style="width:5500px">
                                    <tr>
                                        <th style="width:200px"></th>
                                        <th>Types</th> 
                                    </tr>
                                    <tr>
                                        <td style="width:200px">Current Type Range:</td>
                                        <td><input disabled type="string" maxlength="250" size="50" value="<?php echo $types; ?>" title="Current status"></td> 
                                    </tr>
                                    <tr>
                                        <td style="width200px">Select Type Range:</td>
                                        <td style="width300px">
                                            <?php 
                                            $type_list = prefCheckbox('gantt_type', 'releases', 'type', 'type_list[]');
                                            echo $type_list;
                                            /*
                                            while($rows = $typeSet->fetch_assoc()){
                                                    $type=$rows['type']; 
                                            echo"<input type='checkbox' name='type_list[]' Value='$type' checked>&nbsp; $type &nbsp;&nbsp;";}
                                            */
                                            ?>
                                            </td>
                                    </tr>
                                </table><br>
                            <button type="submit" name="type_submit" class="btn btn-primary btn-md align-items-center">Modify Type</button>
                        </form>
                    </div>
                </div>
                </div>
            </div> 
        </div>

    </body>

</html>
        

 <style>
   tfoot {
     display: table-header-group;
   }
 </style>

  <?php include("./footer.php"); ?>
