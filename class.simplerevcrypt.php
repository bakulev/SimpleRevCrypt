<?php
class SimpleRevCrypt
{
	public static function encode($String, $Password, $Salt)
	{
		$StrLen = strlen($String);
		$Result = '';
		for( $i=0; $i<$StrLen; $i+=90 ) {
			$SubStr = substr($String,$i,90);
		//echo $SubStr."\r\n";
		$Seq = $Password;
		$Gamma = '';
		//echo "StrLen: ".$StrLen."\r\n";
		while (strlen($Gamma)<$StrLen)
		{
		//echo "SeqOrig: ".mbin2hex($Seq.$Salt)."\r\n";
			$Seq = sha1($Seq.$Salt, true);
		//echo "SeqResu: ".mbin2hex($Seq)."\r\n";
			$Gamma.=substr($Seq,0,8);
		//echo "Gamma: ".mbin2hex($Gamma)."\r\n";
		}
		$Result .= base64_encode($SubStr^$Gamma);
		//var_dump($Result);
		}

		return $Result;
	}
}
