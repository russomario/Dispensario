<?php
    require("connect.php");
    include "./templates/header.php"; 
    
    $sql_nomi = "SELECT ID_MEDICINA FROM medicine;";
    $result_nomi = $conn -> query($sql_nomi);
    $info_nomi = $result_nomi -> fetch_all(MYSQLI_ASSOC);
    $today = date('Y-m-d H:i:00');
    
    foreach ($info_nomi as $nome){
        echo "<div class=\"contaniner center\"><h2>{$nome['ID_MEDICINA']}</h2><br><hr style=\"margin-left: 600px; margin-right: 600px;\">";
        $sql_ass = "SELECT STATO, DATE_TIME FROM assunzioni WHERE ID_MEDICINA='{$nome['ID_MEDICINA']}' AND DATE_TIME <= '$today';";
        $result_ass = $conn -> query($sql_ass);
        $info_ass = $result_ass -> fetch_all(MYSQLI_ASSOC);
        foreach ($info_ass as $assunzione){
            if ($assunzione['STATO'] == '1'){
                echo "<p style=\"display: inline-block; margin-right: 20px;\">&#9210;</p><h5 style=\"display: inline-block\">{$assunzione['DATE_TIME']}  &#9989;</h5><br>";
            } else {
                echo "<p style=\"display: inline-block; margin-right: 20px;\">&#9210;</p><h5 style=\"display: inline-block\">{$assunzione['DATE_TIME']} &#10060;</h5><br>";
            }
        }
        echo "</div>";
    }
    ?>