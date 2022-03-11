<?php
    
    function drawerStateQuery($i){
        global $conn;
        $sqlquery = "SELECT * FROM cassetti WHERE NUM_CASSETTO=$i ORDER BY ID DESC LIMIT 1;";
        $resultCassetto = $conn->query($sqlquery);
        $cassetto = $resultCassetto->fetch_assoc();
        return $cassetto["STATO"];
    }

?>
