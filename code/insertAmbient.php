<?php 

require("connect.php");

function insertAmbient($temp, $hum){
    
    global $conn;
    
    $sql = "INSERT INTO sensori (HUMIDITY, TEMPERATURE) VALUES (".$hum.", ".$temp.")";
    if($conn->query($sql) == TRUE){
        //error_log("new record created");
    } else{
        error_log("Error: " . $sql . "<br>" . $conn->error);
    }
}

?>