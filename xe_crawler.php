<?php

//USEFUL Links to get the values of table cells <td>
//1) http://stackoverflow.com/questions/23089513/extract-specific-values-from-html-table-using-regex
//2) http://stackoverflow.com/questions/19348774/php-find-specific-values-inside-of-tablefile
//*********????????		I am using 2nd one as it worked for me quite well	?????????**********

$database="ccmsnew";
$username="ccms";
$password="N9P6Y8x2u7FhPqTWAmEn";
/*$r = mysql_connect('localhost',$username,$password);
if (!$r) {
    echo "Could not connect to server\n";
    trigger_error(mysql_error(), E_USER_ERROR);
} else {
    echo "Connection established\n"; 
}*/

$link = mysql_connect('localhost', $username, $password);
if (!$link) {
    die('Not connected : ' . mysql_error());
}
else {
    echo "Connection established\n"; 
}
if (! mysql_select_db($database) ) {
    die ('Can\'t use cloud_new1 : ' . mysql_error());
}

// It may take a whils to crawl a site ...
set_time_limit(10000);
$curr_array=array('USD','CAD','AUD','NZD','SGD');	//NOT IN USE
$gbp=array('GBP');									//NOT IN USE
// Inculde the phpcrawl-mainclass
$pages=1;

//foreach($gbp as $g)
//{

//foreach($curr_array as $curr_all){
	
        $content='';
		$file_contents = @file_get_contents("http://www.xe.com/currencyconverter/convert/?Amount=1&From=CAD&To=GBP");
		
		$url = "http://www.exchangerate.com/";

		if($file_contents=='' || $url==''){ break; }

		$html = file_get_contents($url);
		libxml_use_internal_errors( true);
		$doc = new DOMDocument;
		$doc->loadHTML( $html);
		$xpath = new DOMXpath( $doc);

		// A name attribute on a <td>
		$result = $xpath->query( '//td[@class="value"]');
		//Picking specific table cells <td> from the curreny tables
		$val_45_usd = $xpath->query( '//td[@class="rateCell"]')->item( 45);
		$val_47_gbp = $xpath->query( '//td[@class="rateCell"]')->item( 47);
		$val_49_aud = $xpath->query( '//td[@class="rateCell"]')->item( 49);
		$val_50_cad = $xpath->query( '//td[@class="rateCell"]')->item( 50);
		$val_52_nzd = $xpath->query( '//td[@class="rateCell"]')->item( 52);
		$val_56_sgd = $xpath->query( '//td[@class="rateCell custom"]')->item( 2);
		//$curr_1st = $xpath->query( '//td[@class="leftCol"]')->item( 1);
		//$val_2nd = $xpath->query( '//td[@class="rightCol"]')->item( 0);
		//$curr_2nd = $xpath->query( '//td[@class="rightCol"]')->item( 1);
		
		//*********************************<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< //Newly added //23-11-16
		echo "Picking 1 USD to gbp/aud/cad/nzd/sgd ";
		echo "<br>";
		$val_9_usd = $xpath->query( '//td[@class="ttsb"]')->item(49);
		$val_11_gbp = $xpath->query( '//td[@class="ttsb"]')->item(48);
		$val_13_aud = $xpath->query( '//td[@class="ttsb"]')->item(1);
		$val_14_cad = $xpath->query( '//td[@class="ttsb"]')->item(5);
		$val_16_nzd = $xpath->query( '//td[@class="ttsb"]')->item(28);
		$val_0_sgd = $xpath->query( '//td[@class="ttsb"]')->item(38);
		echo $val_9_usd = $val_9_usd->textContent;echo "<br>";
		echo $val_11_gbp = $val_11_gbp->textContent;echo "<br>";
		echo $val_13_aud = $val_13_aud->textContent;echo "<br>";
		echo $val_14_cad = $val_14_cad->textContent;echo "<br>";
		echo $val_16_nzd = $val_16_nzd->textContent;echo "<br>";
		echo $val_0_sgd = $val_0_sgd->textContent;echo "<br>";
		//*********************************<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

		echo "<br>";echo "<br>";echo "<br>";
		echo $val_45_usd = $val_45_usd->textContent;echo "<br>";
		echo $val_47_gbp = $val_47_gbp->textContent;echo "<br>";
		echo $val_49_aud = $val_49_aud->textContent;echo "<br>";
		echo $val_50_cad = $val_50_cad->textContent;echo "<br>";
		echo $val_52_nzd = $val_52_nzd->textContent;echo "<br>";
		echo $val_56_sgd = $val_56_sgd->textContent;echo "<br>";
		
		//Following code is for getting 1 cad =usd from xe.com////////////////////////////////	START
		echo $url_1cad_to_dollar_rate = "http://www.xe.com/currencyconverter/convert/?Amount=1&From=CAD&To=USD";
		if($file_contents=='' || $url_1cad_to_dollar_rate==''){ break; }

		$html_1cad_to_dollar_rate = file_get_contents($url_1cad_to_dollar_rate);
		//libxml_use_internal_errors( true);
		//$doc_1cad_to_dollar_rate = new DOMDocument;
		//$doc_1cad_to_dollar_rate->loadHTML( $html_1cad_to_dollar_rate);
		//$xpath_1cad_to_dollar_rate = new DOMXpath( $doc_1cad_to_dollar_rate);
		
		$html = $html_1cad_to_dollar_rate;
		$doc = new DOMDocument();
		$doc->loadHTML($html);
		$xpath_1cad_to_dollar_rate = new DOMXpath( $doc);
		$result_1cad_to_dollar_rate = $xpath_1cad_to_dollar_rate->query( '//span[@class="uccResultAmount"]');
		$val_1cad_to_dollar_rate_USDval = $xpath_1cad_to_dollar_rate->query( '//span[@class="uccResultAmount"]')->item(0);		
		
		$val_1cad_to_dollar_rate_USDval = $val_1cad_to_dollar_rate_USDval->textContent;echo "<br>";
		$val_1cad_to_dollar_rate_USDval = preg_replace("/[^0-9,.]/", "", $val_1cad_to_dollar_rate_USDval);echo "<br>";
		/* Commenting following on 07-10-2016 as xe.com website change the td to span, So have to get values
			from span tag and write the specific regexp
		// A name attribute on a <td>
		$result_1cad_to_dollar_rate = $xpath_1cad_to_dollar_rate->query( '//td[@class="value"]');
		//Picking specific table cells <td> from the curreny tables
		$val_1cad_to_dollar_rate_CADval = $xpath_1cad_to_dollar_rate->query( '//td[@class="leftCol"]')->item(0);
		$val_1cad_to_dollar_rate_USDval = $xpath_1cad_to_dollar_rate->query( '//td[@class="rightCol"]')->item(0);
		
		echo "<br>";
		echo $val_1cad_to_dollar_rate_CADval = $val_1cad_to_dollar_rate_CADval->textContent;echo "<br>";
		echo $val_1cad_to_dollar_rate_CADval = preg_replace("/[^0-9,.]/", "", $val_1cad_to_dollar_rate_CADval);echo "<br>";
		
		echo $val_1cad_to_dollar_rate_USDval = $val_1cad_to_dollar_rate_USDval->textContent;echo "<br>";
		echo $val_1cad_to_dollar_rate_USDval = preg_replace("/[^0-9,.]/", "", $val_1cad_to_dollar_rate_USDval);echo "<br>";
		*/
		//Following code is for getting 1 cad =usd from xe.com////////////////////////////////	END
		
		//1 USD to GBP
		//Following code is for getting 1 USD to GBP from xe.com////////////////////////////////	START
		echo $url_1usd_to_GBP_rate = "http://www.xe.com/currencyconverter/convert/?Amount=1&From=USD&To=GBP";
		$html_1usd_to_GBP_rate = file_get_contents($url_1usd_to_GBP_rate);
		$html = $html_1usd_to_GBP_rate;
		$doc = new DOMDocument();
		$doc->loadHTML($html);
		$xpath_1usd_to_GBP_rate = new DOMXpath( $doc);
		$result_1usd_to_GBP_rate = $xpath_1usd_to_GBP_rate->query( '//span[@class="uccResultAmount"]');
		$val_1usd_to_GBP_rate_GBPval = $xpath_1usd_to_GBP_rate->query( '//span[@class="uccResultAmount"]')->item(0);		
		
		$val_1usd_to_GBP_rate_GBPval = $val_1usd_to_GBP_rate_GBPval->textContent;echo "<br>";
		$val_1usd_to_GBP_rate_GBPval = preg_replace("/[^0-9,.]/", "", $val_1usd_to_GBP_rate_GBPval);echo "<br>";
		//Following code is for getting 1 USD to GBP from xe.com////////////////////////////////	END
		
		//1 CAD to GBP
		//Following code is for getting 1 CAD to GBP from xe.com////////////////////////////////	START
		echo $url_1cad_to_GBP_rate = "http://www.xe.com/currencyconverter/convert/?Amount=1&From=CAD&To=GBP";
		$html_1cad_to_GBP_rate = file_get_contents($url_1cad_to_GBP_rate);
		$html = $html_1cad_to_GBP_rate;
		$doc = new DOMDocument();
		$doc->loadHTML($html);
		$xpath_1cad_to_GBP_rate = new DOMXpath( $doc);
		$result_1cad_to_GBP_rate = $xpath_1cad_to_GBP_rate->query( '//span[@class="uccResultAmount"]');
		$val_1cad_to_GBP_rate_GBPval = $xpath_1cad_to_GBP_rate->query( '//span[@class="uccResultAmount"]')->item(0);		
		
		$val_1cad_to_GBP_rate_GBPval = $val_1cad_to_GBP_rate_GBPval->textContent;echo "<br>";
		$val_1cad_to_GBP_rate_GBPval = preg_replace("/[^0-9,.]/", "", $val_1cad_to_GBP_rate_GBPval);echo "<br>";
		//Following code is for getting 1 CAD to GBP from xe.com////////////////////////////////	END
		
		//1 AUD to GBP
		//Following code is for getting 1 CAD to GBP from xe.com////////////////////////////////	START
		echo $url_1aud_to_GBP_rate = "http://www.xe.com/currencyconverter/convert/?Amount=1&From=AUD&To=GBP";
		$html_1aud_to_GBP_rate = file_get_contents($url_1aud_to_GBP_rate);
		$html = $html_1aud_to_GBP_rate;
		$doc = new DOMDocument();
		$doc->loadHTML($html);
		$xpath_1aud_to_GBP_rate = new DOMXpath( $doc);
		$result_1aud_to_GBP_rate = $xpath_1aud_to_GBP_rate->query( '//span[@class="uccResultAmount"]');
		$val_1aud_to_GBP_rate_GBPval = $xpath_1aud_to_GBP_rate->query( '//span[@class="uccResultAmount"]')->item(0);		
		
		$val_1aud_to_GBP_rate_GBPval = $val_1aud_to_GBP_rate_GBPval->textContent;echo "<br>";
		$val_1aud_to_GBP_rate_GBPval = preg_replace("/[^0-9,.]/", "", $val_1aud_to_GBP_rate_GBPval);echo "<br>";
		//Following code is for getting 1 AUD to GBP from xe.com////////////////////////////////	END

		//1 NZD to GBP
		//Following code is for getting 1 CAD to GBP from xe.com////////////////////////////////	START
		echo $url_1nzd_to_GBP_rate = "http://www.xe.com/currencyconverter/convert/?Amount=1&From=NZD&To=GBP";
		$html_1nzd_to_GBP_rate = file_get_contents($url_1nzd_to_GBP_rate);
		$html = $html_1nzd_to_GBP_rate;
		$doc = new DOMDocument();
		$doc->loadHTML($html);
		$xpath_1nzd_to_GBP_rate = new DOMXpath( $doc);
		$result_1nzd_to_GBP_rate = $xpath_1nzd_to_GBP_rate->query( '//span[@class="uccResultAmount"]');
		$val_1nzd_to_GBP_rate_GBPval = $xpath_1nzd_to_GBP_rate->query( '//span[@class="uccResultAmount"]')->item(0);		
		
		$val_1nzd_to_GBP_rate_GBPval = $val_1nzd_to_GBP_rate_GBPval->textContent;echo "<br>";
		$val_1nzd_to_GBP_rate_GBPval = preg_replace("/[^0-9,.]/", "", $val_1nzd_to_GBP_rate_GBPval);echo "<br>";
		//Following code is for getting 1 NZD to GBP from xe.com////////////////////////////////	END

		//1 SGD to GBP
		//Following code is for getting 1 CAD to GBP from xe.com////////////////////////////////	START
		echo $url_1sgd_to_GBP_rate = "http://www.xe.com/currencyconverter/convert/?Amount=1&From=SGD&To=GBP";
		$html_1sgd_to_GBP_rate = file_get_contents($url_1sgd_to_GBP_rate);
		$html = $html_1sgd_to_GBP_rate;
		$doc = new DOMDocument();
		$doc->loadHTML($html);
		$xpath_1sgd_to_GBP_rate = new DOMXpath( $doc);
		$result_1sgd_to_GBP_rate = $xpath_1sgd_to_GBP_rate->query( '//span[@class="uccResultAmount"]');
		$val_1sgd_to_GBP_rate_GBPval = $xpath_1sgd_to_GBP_rate->query( '//span[@class="uccResultAmount"]')->item(0);		
		
		$val_1sgd_to_GBP_rate_GBPval = $val_1sgd_to_GBP_rate_GBPval->textContent;echo "<br>";
		$val_1sgd_to_GBP_rate_GBPval = preg_replace("/[^0-9,.]/", "", $val_1sgd_to_GBP_rate_GBPval);echo "<br>";
		//Following code is for getting 1 SGD to GBP from xe.com////////////////////////////////	END		
		
	sleep(1);
	sleep(1);
	sleep(1);
	sleep(1);

		
		echo "Now converting to 1 gbp/aud/cad/nzd/sgd to USD";
		echo "<br>";
		echo "<br>";
		echo $val_9_usd = round(1/$val_9_usd,6);echo "<br>";
		echo $val_11_gbp = round(1/$val_11_gbp,6);echo "<br>";
		echo $val_13_aud = round(1/$val_13_aud,6);echo "<br>";
		echo $val_14_cad = round(1/$val_14_cad,6);echo "<br>";
		echo $val_16_nzd = round(1/$val_16_nzd,6);echo "<br>";
		echo $val_0_sgd = round(1/$val_0_sgd,6);echo "<br>";
	
	if($val_11_gbp!=''){
	  echo $sql="INSERT INTO `campus_currency` (id,gbp,usd,cad,aud,nzd,sgd,1_cad_to_usd,
	  1_usd_to_usd,1_gbp_to_usd,1_aud_to_usd,1_cad_to_usd_new,1_nzd_to_usd,1_sgd_to_usd,
	  date) 
	  VALUES ('','1','".$val_1usd_to_GBP_rate_GBPval."','".$val_1cad_to_GBP_rate_GBPval."','".$val_1aud_to_GBP_rate_GBPval."',
	  '".$val_1nzd_to_GBP_rate_GBPval."','".$val_1sgd_to_GBP_rate_GBPval."','".$val_1cad_to_dollar_rate_USDval."',
	  '".$val_9_usd."','".$val_11_gbp."','".$val_13_aud."',
	  '".$val_14_cad."','".$val_16_nzd."','".$val_0_sgd."',
	  '".date('Y-m-d')."')";
	 $result = mysql_query($sql) or die(mysql_error());
	}
	//}
		
		
	
//}
echo "done";

// URL to crawl
//$crawler->setURL("http://www.canada411.ca/search/si/1/malik/Canada/");

?>
