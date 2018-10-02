<?php

// Assuming the above tags are at www.example.com
$tags = get_meta_tags('https://wellaway.com/');

// Notice how the keys are all lowercase now, and
// how . was replaced by _ in the key.
$index = 0;
foreach($tags as $tag){
	 if (strpos($tag, 'noindex') !== false){
	 	$index =+ 1;
	 }
}
if($index != 0){
	echo "SAJT SE NE INDEXIRA";
}
else{
	echo "SAJT SE INDEXIRA";
}
//var_dump ($tags); // 49.33;-86.59

	
/*
	$context  = stream_context_create(array('http' =>array('method'=>'HEAD')));
	$fd = fopen('http://www.wellaway.com', 'rb', false, $context);
	var_dump(stream_get_meta_data($fd));
	fclose($fd);

/*
function get_http_response_code($theURL) {
    $headers = get_headers($theURL);
    return substr($headers[0], 9, 3);
}

$result = get_http_response_code("http://wp3.execdigi.com/");
echo $result;
*/

?>