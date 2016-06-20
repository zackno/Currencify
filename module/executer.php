<?php
require_once("../common/config.php");
require_once("../common/define.php");

$kur=array("USD","EUR");
$sec=array("lower","higher");

// The Proccess Controled Here..
foreach ($kur as $currency) {
			$command= new TraceCode;
			$rate=$command -> getRate($currency);
			$command->addDb_Rate($currency, $rate);
	foreach ($sec as $options){
		echo $currency." = ".$rate."  -  ".$options."<br>";
		$clients=$command->detirmine_awaitings($currency, $options, $rate);
		
		if (isset($clients)){
			echo "mail recuest has been made";
		$command->sent_mail($clients);
		}
		else echo "there is not desired condition";
	}
}

// Functions as Class
class TraceCode{
	//Rates are stored in db for further use in the future
	public function addDb_Rate($currency, $rate){
		global $conn;
		date_default_timezone_set('Europe/Istanbul');
		$sql= " SELECT create_date FROM pm_".$currency."_rates ORDER BY ID DESC LIMIT 1";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$last_date= $result ['0']['0'];
		$today=date('Y-m-d', time());
		if ($today!==$last_date){
			echo "added new date to tha rate table <br>";
			$sql = "INSERT INTO pm_".$currency."_rates (rate, create_date) VALUES ('".$rate."', curdate())";
			# STH means "Statement Handle"
			$STH = $conn->prepare($sql);
			$STH->execute();
		}
		else 
			echo "DB rate is up to date <br>";
	}
	// get todays currency rate
	public function getRate($currency){
			if(($handle = fopen("http://download.finance.yahoo.com/d/quotes.csv?s=".$currency."TRY=X&f=l1", "r")) !== false){
				if(($data = fgetcsv($handle)) !== false){
					$rate = (float)$data[0];
				}
			}
			return $rate;
	}
	// Determines clients whom notification should be sent
	public function detirmine_awaitings ($currency, $options, $rate){
		global $conn;
		if ($options=="lower"){
			$sql= "SELECT * FROM pm_user  WHERE options='".$options."' AND currency='".$currency."'	AND mail_sent='0' AND rate>'".$rate."' ";
		}
		else $sql= "SELECT * FROM pm_user  WHERE options='".$options."' AND currency='".$currency."' AND mail_sent='0'	AND rate<'".$rate."' ";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		//PDO::FETCH_ASSOC for removing numbering arrays
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
	}
	// Sents mail to the determined clients
	public function sent_mail ($clients){
		global $conn;
		foreach ($clients as $client){
			$rate=$client['rate'];
			$options=$client['options'];
			$currency=$client['currency'];
			$sentence['USD']="The USD dollar rate";
			$sentence['EUR']="The EUR rate";
			$id=$client['id'];
			if ($options="lower"){
				$subject=$sentence[$currency]." went down!";
				$msg="Hi,\r\n".$sentence[$currency]." just get down under ".$rate."TL";
			}
			else {
				$subject=$sentence[$currency]." went up!";
				$msg="Hi,\r\n".$sentence[$currency]." just get higher than ".$rate."TL";
			}
			$name="Rate Tracker dot com";
			//$email=$client['email'];
			$email="zakirerimbetov@gmail.com";
			///
			require_once("../module/phpmail/class.phpmailer.php");

			$mail = new PHPMailer();

			$mail->IsSMTP();                                   // send via SMTP
			$mail->Host     = "mail.bayewich.com"; // SMTP servers
			$mail->SMTPAuth = true;     // turn on SMTP authentication
			$mail->Username = "info@bayewich.com";  // SMTP username
			$mail->Password = "Musa12"; // SMTP password

			$mail->From     = "info@bayewich.com"; // smtp kullanýcý adýnýz ile ayný olmalý
			$mail->Fromname = "Keep Track The Rate";
			$mail->AddAddress($email,"Client");
			$mail->Subject  =  $subject;
			$mail->Body     =  $msg;

			if(!$mail->Send())
			{
			   echo "Mesaj Gönderilemedi <p>";
			   echo "Mailer Error: " . $mail->ErrorInfo;
			   exit;
			}
			echo "Mesaj Gönderildi";
			$sql= "UPDATE pm_user  SET mail_sent='1' WHERE id=".$id;
			$stmt = $conn->prepare($sql);
			$stmt->execute();
		}
	}
}

?>
