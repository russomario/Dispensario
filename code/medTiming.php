<?php
    include 'connect.php';
    $sql_list = "SELECT ID_MEDICINA, DURATA FROM medicine;";
    $result = $conn -> query($sql_list);
    $arr = $result -> fetch_all(MYSQLI_ASSOC);

    $today = date('Y-m-d H:i:s');
    
    foreach ($arr as $medicine) {
        $sql_prox = "SELECT * FROM assunzioni WHERE DATE_TIME >= '$today' AND ID_MEDICINA LIKE '{$medicine['ID_MEDICINA']}' LIMIT 1;";
        $result_prox = $conn -> query($sql_prox);
        $ass_prox = $result_prox -> fetch_array(MYSQLI_ASSOC);

        $sql_prec = "SELECT * FROM assunzioni WHERE DATE_TIME < '$today' AND ID_MEDICINA LIKE '{$medicine['ID_MEDICINA']}' ORDER BY DATE_TIME DESC LIMIT 1;";
        $result_prec = $conn -> query($sql_prec);
        $ass_prec = $result_prec -> fetch_array(MYSQLI_ASSOC);

        $sql_first = "SELECT DATE_TIME FROM assunzioni WHERE DATE_TIME < '$today' AND ID_MEDICINA LIKE '{$medicine['ID_MEDICINA']}' ORDER BY DATE_TIME ASC LIMIT 1;";
        $result_first = $conn -> query($sql_first);
        $ass_first = $result_first -> fetch_array(MYSQLI_ASSOC);

        if (count($ass_prec) > 0 || count($ass_prox) > 0) {
            $durata = date('Y-m-d', strtotime($ass_first['DATE_TIME'] . "+ {$medicine['DURATA']} days"));
            
            echo "{$medicine['ID_MEDICINA']},";
            
            if (count($ass_prec) == 0) {
                echo "Nessuna assunzione precedente,";
            } else {
                echo "{$ass_prec['DATE_TIME']},";
            }

            if (count($ass_prox) == 0) {
                echo "Nessuna assunzione futura,";
            } else {
                echo "{$ass_prox['DATE_TIME']},";
            }
            echo "$durata;";
        }



        $result_prec -> free_result();
        $result_prox -> free_result();
        $result_first -> free_result();
    }

    $result -> free_result();
    $conn -> close();

?>