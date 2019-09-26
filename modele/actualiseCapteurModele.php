<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '..\vendor\autoload.php';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=011A");
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$data = curl_exec($ch);
curl_close($ch);
//echo "Raw Data:<br />";
//echo("$data");

$data_tab = str_split($data,33);
echo "Tabular Data:<br />";
$size=count($data_tab);
for($i=$size-10, $size; $i<$size; $i++){
    echo "Trame $i: $data_tab[$i]<br />";
}

$trame = $data_tab[$i-2];
// décodage avec des substring
$t = substr($trame,0,1);
$o = substr($trame,1,4);
// …
// décodage avec sscanf
list($t, $o, $r, $c, $n, $v, $a, $x, $year, $month, $day, $hour, $min, $sec) =
    sscanf($trame,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
echo("<br />$t,$o,$r,$c,$n,$v,$a,$x,$year,$month,$day,$hour,$min,$sec<br />");
echo("<br /><br />");
echo("<br /><br />");
echo($c);
echo("<br /><br />");

$timesql = $year . '-' . $month. '-'. $day .' ' .$hour . ':'. $min . ':' .$sec;
$username = "root";
$password = "";

try {
    $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $result = $conn->prepare('SELECT  date FROM donnees_capteur WHERE id_capteur=1 ORDER BY date DESC');
    $result->execute(array(1));
    $first = true;
    foreach ($result as $row) {
        if ($first) {
            $lastdate = $timesql;
            $lastdate=$row["date"];
            $first = false;
        }
    }
    if ($lastdate != $timesql and $c == 3) {
        $req = $conn->prepare('INSERT INTO donnees_capteur (id_capteur,valeur,date) VALUES (?,?,?)');
        $req->execute(array(1, $v / 10, $timesql));
    }
    if ($lastdate != $timesql and $c == 7) {
        $req = $conn->prepare('INSERT INTO donnees_capteur (id_capteur,valeur,date) VALUES (?,?,?)');
        $req->execute(array(20, 1 , $timesql));


        $mail = new PHPMailer(); // create a new object
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; // or 587
        $mail->IsHTML(true);
        $mail->Username = "e.labify.APP@gmail.com";
        $mail->Password = "APPG11Amail";
        $mail->SetFrom("e.labify.APP@gmail.com");
        $mail->Subject = "URGENT e-labify: Intrusion Detectee";
        $mail->Body = "<html><head></head><body> Intrusion Detectee $timesql </body></html>";
        $mail->AddAddress("arnaud.mathey92@gmail.com");
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
        }

    }
    } catch (PDOException $e) {
    echo $e->getMessage();
    }
