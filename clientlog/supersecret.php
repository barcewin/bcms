<?php
/***
 * Lightweight Banner
 ***/

$width = 100;
$height = 114;

function buildimg($bytes, $width, $height) {
	$img = imagecreatetruecolor($width, $height);

	imagealphablending($img, false);
	imagesavealpha($img, true);

	$x=0;
	$y=0;

	$colors=unpack("N*", $bytes);

	foreach($colors as $color) {
		imagesetpixel($img, $x, $y, (0x7f-($color>>25)<<24)|($color&0xffffff));
		if(++$x==$width) {
			$x=0;$y++;
		}
	}

	header('Content-Type: image/png');
	imagepng($img);
}

$pixels = file_get_contents('./banner.txt');

if($_GET) {
	$token = trim($_GET["token"]);

	if(strlen($token) >= 10) {	
		$prime = '114670925920269957593299136150366957983142588366300079186349531';
		$generator = '1589935137502239924254699078669119674538324391752663931735947';

		$insert = chr(strlen($prime)).$prime.chr(strlen($generator)).$generator;
		$Length = strlen($token);
		$Length2 = strlen($insert);
		$p = 0;
		$bitsnum = "";
		for($i=0; $i < $Length2; $i++) {
			$bits = base_convert(ord($insert[$i]) ^ ord($token[$p]),10,2);
			$need = 8 - strlen($bits);
			for($o=0;$o<$need;$o++)$bits = "0".$bits;
			$bitsnum .= $bits;
			if (++$p == $Length) $p = 0;
		}

		$insertpos = 0;$Length = strlen($bitsnum);

		for ($y = 39; $y < 69; $y++) {
			$a = 0;
			for ($r = 4; $r < 84; $r++) {
				$pos = (($y + $a) * $width + $r) * 4;
				$b = 1;

				while ($b < 4) {
					if($insertpos < $Length) {
						$binaryData = base_convert(ord($pixels[$pos + $b]),10,2);
						$need = 8 - strlen($binaryData);
						for($o=0;$o<$need;$o++) $binaryData = "0".$binaryData;
						$binaryData[7] = $bitsnum[$insertpos];
						$pixels[$pos + $b] = chr(base_convert($binaryData,2,10));
						$insertpos++;$b++;
						continue;
					}
					break 3;
				}
				if ($r % 2 == 0) $a++;
			}
		}
		
	}
}

buildimg($pixels, $width, $height);
?>