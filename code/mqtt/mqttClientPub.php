<?php

    include("configMqtt.php");
    require('phpMQTT.php');
        
    $client_id = 'Ubuntu-Server';

    $mqtt = new phpMQTT($server, $port, $client_id);

    include '../connect.php';

    while (true) {
        $today = date('Y-m-d H:i:s');
        $sql_list = "SELECT DATE_TIME, assunzioni.ID_MEDICINA, NUM_CASSETTO FROM assunzioni, medicine WHERE assunzioni.ID_MEDICINA=medicine.ID_MEDICINA AND DATE_TIME > '$today' ORDER BY DATE_TIME ASC LIMIT 1;";
        $result = $conn -> query($sql_list);
        $ass = $result -> fetch_assoc();
        if ($ass == NULL){
            echo 'Ancora nessuna medicina.' . "\n";
            sleep(5);
            continue;
        } else {
            echo $ass['ID_MEDICINA'];
            echo $ass['DATE_TIME'];
            echo $ass['NUM_CASSETTO']. "\n";
            $time_sleep = calc_sleep($ass['DATE_TIME']);
            if ($time_sleep > 5){
                sleep(5);
                continue;
            }
            sleep($time_sleep);
            mqttPub($ass['ID_MEDICINA'] . '-' . $ass['NUM_CASSETTO']);
            sleep(2);
        }
 
    }

    function calc_sleep($prox){
        $now = date('Y-m-d H:i:s');
        $timenow = strtotime($now);
        $timemed = strtotime($prox);
  
        return  $timemed - $timenow;
    }

    function mqttPub($msg){
        echo "Sending $msg\n";
        global $mqtt, $username, $password;
        if ($mqtt->connect(true, NULL, $username, $password)) {
            $mqtt->publish("pilly/hardware/alarm", $msg, 0, false);
            $mqtt->close();
        } else {
            error_log("Time out!\n");
        }
    }

?>