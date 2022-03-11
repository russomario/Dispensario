<?php

$sqlquery = "SELECT * FROM sensori ORDER BY ID DESC LIMIT 1;";
$resultSensori = $conn->query($sqlquery);


?>