<html idmmzcc-ext-docid="392540160" xmlns="http://www.w3.org/1999/xhtml" dir="rtl" id="vbulletin_html" lang="fa"><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

</head>
</html>

<?php
error_reporting(1);
$string = json_decode(file_get_contents('php://input'));
    
    function objectToArray( $object )
    {
        if( !is_object( $object ) && !is_array( $object ) )
        {
            return $object;
        }
        if( is_object( $object ) )
        {
            $object = get_object_vars( $object );
        }
        return array_map( 'objectToArray', $object );
    }
	$token = ''; ' Enter Bot TokenID
	$result = objectToArray($string);
	$user_id = $result['message']['from']['id'];
	$user_fname = $result['message']['from']['first_name'];
	$user_uname = $result['message']['from']['username'];
	$text = $result['message']['text'];
	$text =urlencode($text);
	$caption =  $result['message']['caption'];
	$photoid1= $result['message']['photo'][1]['file_id'];
    $audioid1= $result['message']['audio']['file_id'];
    $audioid2= $result['message']['reply_to_message']['audio']['file_id']; 
	$photoid2= $result['message']['reply_to_message']['photo'][1]['file_id']; 
	$docid= $result['message']['document']['file_id'];    
	$docid2= $result['message']['reply_to_message']['document']['file_id'];    	
	$vidid= $result['message']['video']['file_id'];    
	$vidid2= $result['message']['reply_to_message']['video']['file_id'];    	
   $caption="";

// JSON Print   ---------------------------------------
//prettyPrint($result) === prettyPrint(prettyPrint($result));
$json_string = json_encode($result, JSON_PRETTY_PRINT);
//$json_string = json_encode($result, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE |JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);

	$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
	$url .= '&text='.urlencode($json_string);
	//$RES =file_get_contents($url);
	
 	if ($result['message']['text'] == '/start')
	{ 
//----------------------------------------------------

	$text_reply = "چيزي که ميخواهيد زيرنويسش رو حذف يا تغيير بديد برام بفرستيد و سپس روش متن تون رو ريپلاي کنيد";
	$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
	$url .= '&text=' .$text_reply;
	$RES =file_get_contents($url);
			
	}
	//$text_reply = "خطا: ";
	//$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
	//$url .= '&text=' .$text_reply;
	//$RES =file_get_contents($url);
	//$text_reply=file_get_contents('php://input');
	$text_reply=$docid;
	
	$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
	$url .= '&text=' .$text_reply;
	//$RES =file_get_contents($url);
// Remove Caption Image
	if (isset($photoid1 )) 
	{     			  
		$url = 'https://api.telegram.org/bot'.$token.'/sendPhoto?chat_id='.$user_id;
		$url .= '&photo=' .$photoid1 .'&caption=' .$text;
		$RES =file_get_contents($url);
		
		$text_reply="🌹عالیه !  حالا (Reply) کن و متن خودت رو بنویس!";
		$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
		$url .= '&text=' .$text_reply;
		$RES =file_get_contents($url);	
	}
	
// Add Caption Image	
	$url = 'https://api.telegram.org/bot'.$token.'/sendPhoto?chat_id='.$user_id;
	$url .= '&photo=' .$photoid2 .'&caption=' .$text;
	$RES =file_get_contents($url);	
	
// Remove Caption Document
	if (isset($docid)) 
	{  
		$url = 'https://api.telegram.org/bot'.$token.'/sendDocument?chat_id='.$user_id;
		$url .= '&document=' .$docid.'&caption=' .$text;
		$RES =file_get_contents($url);
	
			
		$text_reply="🌹عالیه !  حالا (Reply) کن و متن خودت رو بنویس!";
		$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
		$url .= '&text=' .$text_reply;
		$RES =file_get_contents($url);	
	}
	
// Add Caption Document
	$url = 'https://api.telegram.org/bot'.$token.'/sendDocument?chat_id='.$user_id;
	$url .= '&document=' .$docid2.'&caption=' .$text;
	$RES =file_get_contents($url);	

// Remove Caption Video
	if (isset($vidid)) 
	{  
		$url = 'https://api.telegram.org/bot'.$token.'/sendVideo?chat_id='.$user_id;
		$url .= '&video=' .$vidid.'&caption=' .$text;
		$RES =file_get_contents($url);

		$text_reply="🌹عالیه !  حالا (Reply) کن و متن خودت رو بنویس!";
		$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
		$url .= '&text=' .$text_reply;
		$RES =file_get_contents($url);		
	}
	
// Add Caption Video
	$url = 'https://api.telegram.org/bot'.$token.'/sendVideo?chat_id='.$user_id;
	$url .= '&video=' .$vidid2.'&caption=' .$text;
	$RES =file_get_contents($url);	

     //$RES2 =file_get_contents($url2);
//echo $text_reply;
//echo $result;

// Remove Caption Audio
	if (isset($audioid1)) 
	{  
	$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
	$url .= '&text=' ."Audio";
	$RES =file_get_contents($url);
	
		$url = 'https://api.telegram.org/bot'.$token.'/sendaudio?chat_id='.$user_id;
		$url .= '&audio=' .$audioid1.'&caption=' .$text;
		$RES =file_get_contents($url);

		$text_reply="🌹عالیه !  حالا (Reply) کن و متن خودت رو بنویس!";
		$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
		$url .= '&text=' .$text_reply;
		$RES =file_get_contents($url);		
	}
// Add Caption Audio	
	$url = 'https://api.telegram.org/bot'.$token.'/sendaudio?chat_id='.$user_id;
	$url .= '&audio=' .$audioid2 .'&caption=' .$text;
	$RES =file_get_contents($url);	




// Function Code ---------------------------
<html idmmzcc-ext-docid="392540160" xmlns="http://www.w3.org/1999/xhtml" dir="rtl" id="vbulletin_html" lang="fa"><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

</head>
</html>

<?php
error_reporting(1);
$string = json_decode(file_get_contents('php://input'));
    
    function objectToArray( $object )
    {
        if( !is_object( $object ) && !is_array( $object ) )
        {
            return $object;
        }
        if( is_object( $object ) )
        {
            $object = get_object_vars( $object );
        }
        return array_map( 'objectToArray', $object );
    }
	$token = ''; ' Enter Bot TokenID
	$result = objectToArray($string);
	$user_id = $result['message']['from']['id'];
	$user_fname = $result['message']['from']['first_name'];
	$user_uname = $result['message']['from']['username'];
	$text = $result['message']['text'];
	$text =urlencode($text);
	$caption =  $result['message']['caption'];
	$photoid1= $result['message']['photo'][1]['file_id'];
    $audioid1= $result['message']['audio']['file_id'];
    $audioid2= $result['message']['reply_to_message']['audio']['file_id']; 
	$photoid2= $result['message']['reply_to_message']['photo'][1]['file_id']; 
	$docid= $result['message']['document']['file_id'];    
	$docid2= $result['message']['reply_to_message']['document']['file_id'];    	
	$vidid= $result['message']['video']['file_id'];    
	$vidid2= $result['message']['reply_to_message']['video']['file_id'];    	
   $caption="";

// JSON Print   ---------------------------------------
//prettyPrint($result) === prettyPrint(prettyPrint($result));
$json_string = json_encode($result, JSON_PRETTY_PRINT);
//$json_string = json_encode($result, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE |JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);

	$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
	$url .= '&text='.urlencode($json_string);
	//$RES =file_get_contents($url);
	
 	if ($result['message']['text'] == '/start')
	{ 
//----------------------------------------------------

	$text_reply = "چيزي که ميخواهيد زيرنويسش رو حذف يا تغيير بديد برام بفرستيد و سپس روش متن تون رو ريپلاي کنيد";
	$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
	$url .= '&text=' .$text_reply;
	$RES =file_get_contents($url);
			
	}
	//$text_reply = "خطا: ";
	//$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
	//$url .= '&text=' .$text_reply;
	//$RES =file_get_contents($url);
	//$text_reply=file_get_contents('php://input');
	$text_reply=$docid;
	
	$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
	$url .= '&text=' .$text_reply;
	//$RES =file_get_contents($url);
// Remove Caption Image
	if (isset($photoid1 )) 
	{     			  
		$url = 'https://api.telegram.org/bot'.$token.'/sendPhoto?chat_id='.$user_id;
		$url .= '&photo=' .$photoid1 .'&caption=' .$text;
		$RES =file_get_contents($url);
		
		$text_reply="🌹عالیه !  حالا (Reply) کن و متن خودت رو بنویس!";
		$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
		$url .= '&text=' .$text_reply;
		$RES =file_get_contents($url);	
	}
	
// Add Caption Image	
	$url = 'https://api.telegram.org/bot'.$token.'/sendPhoto?chat_id='.$user_id;
	$url .= '&photo=' .$photoid2 .'&caption=' .$text;
	$RES =file_get_contents($url);	
	
// Remove Caption Document
	if (isset($docid)) 
	{  
		$url = 'https://api.telegram.org/bot'.$token.'/sendDocument?chat_id='.$user_id;
		$url .= '&document=' .$docid.'&caption=' .$text;
		$RES =file_get_contents($url);
	
			
		$text_reply="🌹عالیه !  حالا (Reply) کن و متن خودت رو بنویس!";
		$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
		$url .= '&text=' .$text_reply;
		$RES =file_get_contents($url);	
	}
	
// Add Caption Document
	$url = 'https://api.telegram.org/bot'.$token.'/sendDocument?chat_id='.$user_id;
	$url .= '&document=' .$docid2.'&caption=' .$text;
	$RES =file_get_contents($url);	

// Remove Caption Video
	if (isset($vidid)) 
	{  
		$url = 'https://api.telegram.org/bot'.$token.'/sendVideo?chat_id='.$user_id;
		$url .= '&video=' .$vidid.'&caption=' .$text;
		$RES =file_get_contents($url);

		$text_reply="🌹عالیه !  حالا (Reply) کن و متن خودت رو بنویس!";
		$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
		$url .= '&text=' .$text_reply;
		$RES =file_get_contents($url);		
	}
	
// Add Caption Video
	$url = 'https://api.telegram.org/bot'.$token.'/sendVideo?chat_id='.$user_id;
	$url .= '&video=' .$vidid2.'&caption=' .$text;
	$RES =file_get_contents($url);	

     //$RES2 =file_get_contents($url2);
//echo $text_reply;
//echo $result;

// Remove Caption Audio
	if (isset($audioid1)) 
	{  
	$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
	$url .= '&text=' ."Audio";
	$RES =file_get_contents($url);
	
		$url = 'https://api.telegram.org/bot'.$token.'/sendaudio?chat_id='.$user_id;
		$url .= '&audio=' .$audioid1.'&caption=' .$text;
		$RES =file_get_contents($url);

		$text_reply="🌹عالیه !  حالا (Reply) کن و متن خودت رو بنویس!";
		$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
		$url .= '&text=' .$text_reply;
		$RES =file_get_contents($url);		
	}
// Add Caption Audio	
	$url = 'https://api.telegram.org/bot'.$token.'/sendaudio?chat_id='.$user_id;
	$url .= '&audio=' .$audioid2 .'&caption=' .$text;
	$RES =file_get_contents($url);	




// Function Code ---------------------------
