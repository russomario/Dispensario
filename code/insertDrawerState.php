<?php 

require("connect.php");

function insertDrawerState($num, $state){
    
    global $conn;
    
    $sql = "INSERT INTO cassetti (NUM_CASSETTO, STATO) VALUES (".$num.", ".$state.")";
    if($conn->query($sql) == TRUE){
        error_log("new record created");
    } else{
        error_log("Error: " . $sql . "<br>" . $conn->error);
    }
    
}
	

?>
