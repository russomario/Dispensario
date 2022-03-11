<?php

include("configMqtt.php");
include('../insertAmbient.php');
include('../insertDrawerState.php');
require('phpMQTT.php');


$client_id = 'Ubuntu-Server';

$mqtt = new phpMQTT($server, $port, $client_id);
if (!$mqtt->connect(true, NULL, $username, $password)) {
	exit(1);
}

$mqtt->debug = false;

$topic0[$ambientTopic] = array('qos' => 0, 'function' => 'procMsg');
$topic1[$takenTopic] = array('qos' => 0, 'function' => 'procMsg');
$topic2[$drawersStateTopic] = array('qos' => 0, 'function' => 'procMsg');
$mqtt->subscribe($topic0, 0);
$mqtt->subscribe($topic1, 0);
$mqtt->subscribe($topic2, 0);

while ($mqtt->proc()) {
}

$mqtt->close();

function procMsg($topic, $msg)
{
	global $ambientTopic, $takenTopic, $drawersStateTopic;

	echo 'Msg Recieved: ' . date('r') . "\n";
	echo "Topic: {$topic}\n\n";
	echo "\t$msg\n\n";
	if ($topic ==  $ambientTopic) { #stranamente funziona tutto 
		list($temp, $hum) = explode('-', $msg);
		insertAmbient($temp, $hum);
	}

	if ($topic == $takenTopic) {
		include '../connect.php';
		$now = date('Y-m-d H:i:00');
		$inf = date('Y-m-d H:i:00', strtotime($now . ' - 5 minutes'));
		$sup = date('Y-m-d H:i:00', strtotime($now . ' + 5 minutes'));
		echo "$inf" . "\n";
		echo "$sup" . "\n";
		$sql_query = "UPDATE assunzioni SET STATO='1' WHERE DATE_TIME > '$inf' AND DATE_TIME < '$sup' AND ID_MEDICINA='$msg' ORDER BY DATE_TIME DESC LIMIT 1;";
		echo $sql_query;
		$conn->query($sql_query);
	}

	if ($topic == $drawersStateTopic) {
		list($num, $state) = explode('-', $msg);
		insertDrawerState($num, $state);
	}
}
