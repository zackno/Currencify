<?php
require_once("common/define.php");
require_once("common/define.php");
if (isset($_POST['target_currency']) && isset($_POST['compare_type'])  && isset($_POST['mail']) ){
	$currency = $_POST['target_currency'];
	$options = $_POST['compare_type'];
		$mail = $_POST['mail'];
	if ( ($_POST['rate'])!=0 ){
		$rate = $_POST['rate'];
		er_update ($currency, $mail, $options, $rate);
	}

}
else {}



function er_update($currency, $mail, $options, $rate){
	global $conn;
	$sql = "INSERT INTO pm_user (currency, email, options, rate, create_time)
	VALUES ('".$currency."', '".$mail."', '".$options."','".$rate."', curdate())";
	# STH means "Statement Handle"
	$STH = $conn->prepare($sql);
	$STH->execute();

}
function est_update ($currency, $mail, $options, $duration){
		global $conn;
	$sql = "INSERT INTO pm_user (currency, email, options, duration, create_time)
	VALUES ('".$currency."', '".$mail."', '".$options."','".$duration."', curdate())";
	# STH means "Statement Handle"
	$STH = $conn->prepare($sql);
	$STH->execute();
}
?>

