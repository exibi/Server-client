<?php
$urls = array(
'http://google.pl',
'http://wp.pl',
'http://onet.pl',
'http://gratka.pl',
'http://fashionette.pl'
);
// build the individual requests as above, but do not execute them
foreach ($urls as $url){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FAILONERROR, true); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$chs[]=$ch;
}
/*
$ch_1 = curl_init('http://google.pl');
$ch_2 = curl_init('http://google.de');
curl_setopt($ch_1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_1, CURLOPT_FAILONERROR, true); 
curl_setopt($ch_1, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($ch_1, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch_1, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($ch_1, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch_2, CURLOPT_FAILONERROR, true); 
curl_setopt($ch_2, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch_2, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($ch_2, CURLOPT_SSL_VERIFYPEER, false);  
*/
  // build the multi-curl handle, adding both $ch
$mh = curl_multi_init();
  
foreach ($chs as &$ch){ 
  curl_multi_add_handle($mh, $ch);
  //curl_multi_add_handle($mh, $ch_2);
}  
  // execute all queries simultaneously, and continue when all are complete
  $running = null;
  do {
    curl_multi_exec($mh, $running);
	//$getinfo[] = curl_multi_info_read($mh);
  } while ($running);
  
  // all of our requests are done, we can now access the results
  //$response_1 = curl_multi_getcontent($ch_1);
  //$response_2 = curl_multi_getcontent($ch_2);
  //echo "$response_1 $response_2"; // same output as first example
  foreach ($chs as $ch){ 
	$getinfo[] = curl_multi_info_read($ch);
  }
  //$getinfo[] = curl_multi_info_read($ch_2);

  print_r($getinfo);

  
  
?>
