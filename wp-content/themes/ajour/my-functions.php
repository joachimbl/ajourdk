<?php
	// goodday()
	function goodday(){
		switch(date("H")){
			case "00":
			case "01":
			case "02":
			case "03":
			case "04":
				return("nat");
			case "05":
			case "06":
			case "07":
			case "08":
				return("morgen");
			case "09":
			case "10":
				return("formiddag");
			case "11":
			case "12":
			case "13":
				return("middag");
			case "14":
			case "15":
			case "16":
			case "17":
				return("eftermiddag");
			case "18":
			case "19":
			case "20":
			case "21":
			case "22":
			case "23":
				return("aften");
		}
	}
	
	// Send mail
	function sendmail($from_mail, $to_mail, $subject, $message){
		if(empty($subject)){
			$subject = "Besked fra " . $from_mail;
		}
		
		$status = mail($to_mail, $subject, $message, "From: " . $from_mail);
		
		if($status){
			return true;
		}
		else{
			return false;
		}
	}
	
	// Send SMS
	function sendsms($number, $message, $true_send = true) {
		$url = "http://www.cpsms.dk/sms/";
		$url .= "?message=" . urlencode($message);
		$url .= "&recipient=45" . $number; 
		$url .= "&username=ajour";
		$url .= "&password=ruoja";
		$url .= "&from=" . urlencode("Ajour");
		$url .= "&utf8=" . 1;
		
		if($true_send == true){
			$reply = @file_get_contents($url);
		}
		
		if(strstr($reply, "<succes>") OR $true_send == false) {
			return true;
		}
		else{
			return false;
		}
	}

	
	// Strip tags
	function stripout($input){
		$search = array(
			"@<script[^>]*?>.*?</script>@si",	// Strip out javascript
			"@<style[^>]*?>.*?</style>@siU",	// Strip style tags properly
			"@<[\/\!]*?[^<>]*?>@si",			// Strip out HTML tags
			"@<![\s\S]*?-[ \t\n\r]*>@",			// Strip multi-line comments including CDATA
			"@\"@"								// Strip quotes
		);
		$text = preg_replace($search, "", $input);
		return($text);
	}
	
	// HTML Entity Encoder
	function entityencoder($input){		
		$output = htmlentities($input, ENT_NOQUOTES);
		return($output);
	}
	
	// HTML Entity Decoder
	function entitydecoder($input){
		$output = html_entity_decode($input, ENT_NOQUOTES);
		return($output);
	}
	
	// URL Decoder
	function urldecoder($input){
		$output = stripslashes($input);
		$output = urldecode($output);
		return($output);
	}
	
	// Stinavne til titler
	function entityreplace($in){
		$in = str_replace("¾", "ae", $in);
		$in = str_replace("¿", "oe", $in);
		$in = str_replace("Œ", "aa", $in);
		$in = str_replace("®", "Ae", $in);
		$in = str_replace("¯", "Oe", $in);
		$in = str_replace("", "Aa", $in);
		return $in;
	}
	
	// Detect if handheld device
	function handheld(){
		$devices = array(
			'/ipad/i', 
			'/ipod/i', 
			'/iphone/i',
			'/android/i',
			'/googlebot-mobile/i',
			'/opera mini/i',
			'/blackberry/i',
			'/(pre\/|palm os|palm|hiptop|avantgo|plucker|xiino|blazer|elaine)/i',
			'/(iris|3g_t|windows ce|opera mobi|windows ce; smartphone;|windows ce; iemobile)/i',
			'/(mini 9.5|vx1000|lge |m800|e860|u940|ux840|compal|wireless| mobi|ahong|lg380|lgku|lgu900|lg210|lg47|lg920|lg840|lg370|sam-r|mg50|s55|g83|t66|vx400|mk99|d615|d763|el370|sl900|mp500|samu3|samu4|vx10|xda_|samu5|samu6|samu7|samu9|a615|b832|m881|s920|n210|s700|c-810|_h797|mob-x|sk16d|848b|mowser|s580|r800|471x|v120|rim8|c500foma:|160x|x160|480x|x640|t503|w839|i250|sprint|w398samr810|m5252|c7100|mt126|x225|s5330|s820|htil-g1|fly v71|s302|-x113|novarra|k610i|-three|8325rc|8352rc|sanyo|vx54|c888|nx250|n120|mtk |c5588|s710|t880|c5005|i;458x|p404i|s210|c5100|teleca|s940|c500|s590|foma|samsu|vx8|vx9|a1000|_mms|myx|a700|gu1100|bc831|e300|ems100|me701|me702m-three|sd588|s800|8325rc|ac831|mw200|brew |d88|htc\/|htc_touch|355x|m50|km100|d736|p-9521|telco|sl74|ktouch|m4u\/|me702|8325rc|kddi|phone|lg |sonyericsson|samsung|240x|x320|vx10|nokia|sony cmd|motorola|up.browser|up.link|mmp|symbian|smartphone|midp|wap|vodafone|o2|pocket|kindle|mobile|psp|treo)/i'
		);
		
		foreach($devices as $device){
			preg_match($device, $_SERVER['HTTP_USER_AGENT'], $matches);
			
			if(count($matches) > 0){
				$match++;
			}
		}
		
		if(count($match) > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	// Dir Size
	function dirsize($path){
		$path = trim($path, "/");
	
		if(!file_exists($path)){
			return false;
		}
		if(is_file($path)){
			return filesize($path);
		}
		
		$size = 0;
		
		foreach(glob($path . "/*") as $file){
			$size += dirsize($file);
		}
		
		return $size;
	}
	
	// Format Byte Size
	function format_bytes($bytes){
		// if total is bigger than 1 MB
		if($bytes / 1048576 > 1){
			return number_format(round($bytes / 1048576, 0), 0, ",", ".") . " Mb";
			
		
		}
		// if total bigger than 1 KB
		elseif($bytes / 1024 > 1){
			
			return round($bytes / 1024, 0) . " Kb";
		}
		else{
			return round($bytes, 0) . " B";
		}
	}
	
	// afkort text
	function cut_text($text, $max_lenght, $separator, $more){
		if($max_lenght < strlen($text)){
			$count_in = strpos(substr($text, $max_lenght), $separator);
			$short = substr($text, 0, $max_lenght + $count_in) . $more;
			return $short;
		}
		else{
			return $text;
		}
	}
	
	function extract_url_from_html($html){
		$regex = "/<a\s[^>]*href=([\"\']??)([^\" >]*?)\\1[^>]*>(.*)<\/a>/siU";
		preg_match($regex, $html, $match);
		if($match[2]){
			return $match[2];
		}
		else{
			return false;
		}
	}
?>