<?php
  function getScope ($db){
      $sql = "SELECT * FROM preferences WHERE name = 'SYSTEM_BOMS';";
      $result = $db->query($sql);
      $output = array('NULL');

      // output data of each row
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $prefString = $row["value"];

        if(!empty(trim($prefString))){
          $output = explode(",", $prefString);
        }
      }

      foreach($output as &$value){
        $value = "%$value%";
      }

      $result->close();
      
      return $output;
  }
?>
