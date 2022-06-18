<?php

include("../../../../index.php");
global $db;

//Checks to see if gantt_start exists
$startExists = $db->query("SELECT * FROM preferences WHERE id = 'gantt_start'");
//Checks to see if gantt_end exists
$endExists = $db->query("SELECT * FROM preferences WHERE id = 'gantt_end'");
//Checks to see if gantt_end exists
$statusExists = $db->query("SELECT * FROM preferences WHERE id = 'gantt_status'");
//Checks to see if gantt_end exists
$typeExists = $db->query("SELECT * FROM preferences WHERE id = 'gantt_type'");
//Gets date for gantt_start comment field
$sComment = findPreference('gantt_start', 'releases', 'open_date', 'first');
//Gets date for gantt_end comment field
$eComment = findPreference('gantt_end', 'releases', 'rtm_date', 'last');
//Gets status for gantt_status comment field
$statComment = findPreference('gantt_status', 'releases', 'status', 'all');
//Gets status for gantt_type comment field
$typeComment = findPreference('gantt_type', 'releases', 'type', 'all');

if (isset($_POST['new_sDate'])){
    $sDate = $_POST['new_sDate'];
    $eDate = $_POST['new_eDate'];
    if ($sDate > $eDate){
        header('location: setup_gantt_preference.php?preferencesUpdated=DateFail');
    }else{
        if($startExists->num_rows == 0){
            $sql1 = "INSERT INTO `preferences`(`id`, `type`, `value`, `comments`) VALUES ('gantt_start','DATE','$sDate','$sComment')";
        }else{
            $sql1 = "UPDATE `preferences` SET `value`= '$sDate' WHERE `id` = 'gantt_start'";
        }
        if($endExists->num_rows == 0){
            $sql2 = "INSERT INTO `preferences`(`id`, `type`, `value`, `comments`) VALUES ('gantt_end','DATE','$eDate','$eComment')";
        }else{
            $sql2 = "UPDATE `preferences` SET `value`= '$eDate' WHERE `id` = 'gantt_end'";
        }
        mysqli_query($db, $sql1);
        mysqli_query($db, $sql2);
        header('location: setup_gantt_preference.php?preferencesUpdated=Success');
    }
}//end if

if(isset($_POST['status_submit'])){
    if (!empty($_POST['status_list'])){
        $status = $_POST['status_list'];
        $result = "'" . implode ( "', '", $status ) . "'";
        if($statusExists->num_rows == 0){
            $sql1 = "INSERT INTO `preferences`(`id`, `type`, `value`, `comments`) VALUES ('gantt_status','STRING',\"" .$result. "\",\"" .$statComment. "\")";
        }else{
            $sql1 = "UPDATE `preferences` SET `value`= \"" .$result. "\" WHERE `id` = 'gantt_status'";
        }
        mysqli_query($db, $sql1);
        header('location: setup_gantt_preference.php?preferencesUpdated=Success');
    }else{
    header('location: setup_gantt_preference.php?preferencesUpdated=StatusFail');
    }
}   
if(isset($_POST['type_submit'])){
    if (!empty($_POST['type_list'])){
        $type = $_POST['type_list'];
        $result = "'" . implode ( "', '", $type ) . "'";
        if($typeExists->num_rows == 0){
            $sql1 = "INSERT INTO `preferences`(`id`, `type`, `value`, `comments`) VALUES ('gantt_type','STRING',\"" .$result. "\",\"" .$typeComment. "\")";
        }else{
            $sql1 = "UPDATE `preferences` SET `value`= \"" .$result. "\" WHERE `id` = 'gantt_type'";
        }
        mysqli_query($db, $sql1);
        header('location: setup_gantt_preference.php?preferencesUpdated=Success');
    }else{
    header('location: setup_gantt_preference.php?preferencesUpdated=TypeFail');   
    }
}
?>
