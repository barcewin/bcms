<?php
class HoloMail {
	var $plaintext;
	var $html;
	var $logo;
	var $boundary;
	var $email;
	var $subject;
	function sendSimpleMessage($to,$subject,$html,$plaintext=null){
		$this->logo = $this->generateLogo();
		$this->html = $this->htmlToMessage('../templates/email_header.php').$html.$this->htmlToMessage('../templates/email_footer.php');
		if($plaintext == null){ $this->plaintext = $this->generatePlainText($this->html); }else{ $this->plaintext = $plaintext; }
		$array = $this->generateHeaders($to,$subject); $header = $array[1];
		$message = $this->generateMessage();
		$success = @mail($to,$subject,$message,$header);
		return $success;
	}
	function sendNewsletter($to,$subject,$html){
		$this->html = $html;
		$this->plaintext = $this->generatePlainText($html);
		$array = $this->generateHeaders($to,$subject); $header = $array[1];
		$message = $this->generateMessage();
		$success = @mail($to,$subject,$message,$header);
		return $success;
	}
	function generatePlainText($html){
		return preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", strip_tags(str_replace("<br />", "\n", str_replace("%name%", $row['name'], $html))));
	}
	function generateHeaders($to,$subject){
$this->boundary = time();
$mail_from = 'contacto@pixeledhotel.com';
$mail_name = 'barcewin';
$preheader = '';
$preheader .= 'Para: '.$to."\r\n";
$preheader .= 'Asunto: '.$subject;
$header = '';
$header .= 'Return-Path: <'.$mail_from.'>'."\r\n";
$header .= 'Date: '.date('r (T)')."\r\n";
$header .= 'From: "'.$mail_name.'" <'.$mail_from.'>'."\r\n";
$header .= 'MIME-Version: 1.0'."\r\n";
$header .= 'Content-Type: multipart/related; '."\r\n";
$header .= '	boundary="----=_Part_402930_17237178.'.$this->boundary.'"';
return array($preheader,$header);
	}
	function generateLogo($file=null){
		if($file == null){ $file = '../web-gallery/v2/images/habbo.png'; }
		$fh = fopen($file, "r");
		$image = fread ($fh, filesize($file));
		fclose($fh);
		$encodedimage = chunk_split(base64_encode($image));
		if($encodedimage == ""){
			$encodedimage = 
'R0lGODlhoABCAJEDAP/OAAAAAP5jAf//ACH5BAEAAAMALAAAAACgAEIAAAL/nI+py+0Po5y02ouz
3rz7D4biSJbmiabqyrbuC8fyTNf2jef6zvf+D3QFhrih8YhMBhBK5KEJfUKVjClRsTRka1broHv8
gp1jp3TMFC+3syHgDX+74/AknW6/6/N6vFFr1Cf3pyVWyBXQN3d3JOi36FgXGBnHF0m49qWJqJi4
B0k5SSnpOToIenm1xdZW6tfpGoqaGis7KximVlQ72GlayZv6Kzl8ynpzmxzseMu8jPsMe5Wj7Ptp
zRhcfc2dLUC4i/3aPZ4tDnxO/CnwPW2zbU6OLq8eb1/ux95+LAOPP38P4L96A3ut0weORjNo6QwG
JCgwIkRJ+ti5a1UMgD+J/7IybqRYMWG/aPQcFnRG8lFDjQEqWuT3YuHKj9BE2aLJ0mW7dylP4vxk
kxbOITovxpBZUtiwoLZmtnRpFAbShx2LTfWp7WlImEJ6clRKlaVTp0W5thjqdaLJr2g7leU51mrW
uGGVveWUtG3euXvdQjXLQm9dvoPp5vsLt6/ipWnXjiKKGG/hxb+ufnV2VyFhrCtryrXMUitCwCsE
c2bcuFFl0aMTT379mClK2UB17pR8Gvbsq0deLuxtO2rMMsSLT9lHfOsY2y95Gn9ufPTy4F2Yt3ZO
nbXv7Nytd/du3Qj48KQDQ/6rfd935ePRt2cu/r10aufZl00f37189fvty10X3gp+9Um3HoH75Xcg
cO2JhMyA291X4IMLKjghERRmV95R0G3IYXFnoPFDhyJ6oUYZC4ARRIoqrshiiy6+CGOMMs5IY402
3ohjjjruyGOPPv4IZJBCDklkkUYeWQAAOw==';
		}
		return $encodedimage;
	}
	function generateMessage(){
		$message = '';
		$message .= 
'------=_Part_402930_17237178.'.$this->boundary.'
Content-Type: multipart/alternative; 
	boundary="----=_Part_402931_29846152.'.$this->boundary.'"'."\r\n\r\n";
		if($this->plaintext != ""){ $message .=
'------=_Part_402931_29846152.'.$this->boundary.'
Content-Type: text/plain; charset=ISO-8859-1
Content-Transfer-Encoding: 7bit

'.$this->plaintext."\r\n";
		}
		if($this->html != ""){ $message .=
'------=_Part_402931_29846152.'.$this->boundary.'
Content-Type: text/html;charset=ISO-8859-1
Content-Transfer-Encoding: 7bit

'.$this->html.'
------=_Part_402931_29846152.'.$this->boundary.'--'."\r\n\r\n";
		}
		if($this->logo != ""){ $message .=
'------=_Part_402930_17237178.'.$this->boundary.'
Content-Type: image/gif
Content-Transfer-Encoding: base64
Content-Disposition: inline
Content-ID: <habbologo>

'.$this->logo.'
------=_Part_402930_17237178.'.$this->boundary.'--';
		}
		return $message;
	}
function htmlToMessage($file){
global $lang;
ob_start();
include($file);

$contents = ob_get_clean();
ob_end_clean();
return $contents;
}
}
?>