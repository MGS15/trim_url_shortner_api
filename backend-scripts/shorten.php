<?php
	# POST INPUTS TO PHP

	$apikey = '';
	$urlsNum = '';
	$offerurl = '';
	$unsuburl = '';
	$opturl = '';

	$apikey = $_POST['apikey'];
	$urlsNum = $_POST['urlnum'];
	$offerurl = $_POST['offerurl'];
	$unsuburl = $_POST['unsuburl'];
	$opturl = $_POST['opturl'];
	$trim = 'https://tr.im';

	//$data = array_merge(getInputs($apikey, $urlsNum, $offerurl, $unsuburl, $opturl, $trim));
	$allURLs = array();
	if ($urlsNum >= 1) {
		$offerURLs = array();
		$unsubURLs = array();
		$optURLs = array();
		for ($i=0; $i < $urlsNum; $i++) { 
			if ($offerurl != '') {
				$result = sendURL($trim, $apikey, $offerurl);
				$offerURLs[$i] = receiveResponse($result);
			}

			if ($unsuburl != '') {
				$result = sendURL($trim, $apikey, $unsuburl);
				$unsubURLs[$i] = receiveResponse($result);
			}

			if ($opturl != '') {
				$result = sendURL($trim, $apikey, $opturl);
				$optURLs[$i] = receiveResponse($result);
			}
		}
		$allURLs['offers'] = $offerURLs;
		$allURLs['unsubs'] = $unsubURLs;
		$allURLs['opts'] = $optURLs;

		echo json_encode($allURLs);
	}

		




	# Sending the parameters to TRIM Shortner
	function sendURL($trim, $apikey, $prourl) {
		
		$url = $trim . '/links';

		$data['long_url'] =  $prourl . '#' . generateRandomString(rand(3, 7));
		$data_json = json_encode($data);

		$ch = curl_init($url);
		$headers = array('Accept: application/json', 'Content-Type: application/json', 'X-Api-Key: '. $apikey);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);

		if (!$result) {
			die("Connection Failure!");
		}

		return $result;
	}
	


	# Check the received Response and out put the results
	function receiveResponse($result) {
		if ($result) {
			$receivedResult = json_decode($result, true);
		//	echo print_r($receivedResult);
			return $receivedResult['url'];
		} else {
			echo "Error";
		}
	}


	# Get INPUTS
	function getInputs($apikey, $urlsNum, $offerurl, $unsuburl, $opturl, $apiurl) {

		$data = array();

		// Check api key
		if ($apikey == "") {
			echo "API Key is required";
			return;
		} else {
			$data['apikey'] = $apikey;
		}

		// Check api url
		if ($apiurl == "") {
			echo "API Key is required";
			return;
		} else {
			$data['apiurl'] = $apiurl;
		}

		// Check number of generated URLs
		if ($urlsNum <= 0) {
			echo "Choose a number";
			return;
		} else {
			$data['urlsnum'] = $urlsNum;
		}
		
		// Check Offer URL
		if ($offerurl == "") {
			echo "Offer's URL is required";
			return;
		} else {
			$data['offerurl'] = $offerurl;
		}
		
		// Check Unsubscribe URL
		if ($unsuburl == "") {
			echo "Unsubscribe URL is required";
			return;
		} else {
			$data['unsuburl'] = $unsuburl;
		}
		
		// Check Optout URL
		if ($opturl != "") {
			$data['opturl'] = $opturl;
		}

		return $data;
	}








	/************************************* HELPER FUNCTIONS *************************************/

	# Random String Generator
	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
?>