$(document).ready(function(){
	
	var offerTxtArea = $('#offer-short');
	var unsubTxtArea = $('#unsub-short');
	var optTxtArea = $('#opt-short');

	var imgOffer = $('#offer-image-url');
	var imgUnsub = $('#unsub-image-url');
	var imgOpt = $('#opt-image-url');

	var bodyTxtArea = $('#body-short');

	var offerTxtAreaVal;
	var unsubTxtAreaVal;
	var optTxtAreaVal;

	$('#shorten').click(function(){

		var apikey;
		var urlsNum;
		var offerurl;
		var unsuburl;
		var opturl;

		apikey = '';
		urlsNum = '';
		offerurl = '';
		unsuburl = '';
		opturl = '';

		apikey = $('#api-key').val();
		urlsNum = $('#url-num').val();
		offerurl = $('#offer-url').val();
		unsuburl = $('#unsub-url').val();
		opturl = $('#opt-url').val();
/*
		alert('API KEY : ' + apikey);
		alert('NUMBER OF URLS : ' + urlsNum);
		alert('OFFER URL : ' + offerurl);
		alert('UNSUBSCRIBE URL : ' + unsuburl);
		alert('OPTOUT URL : ' + opturl);
*/
		$.ajax({
		    url: 'backend-scripts/shorten.php',
		    type: 'POST',
		    data: {'apikey': apikey, 'urlnum': urlsNum, 'offerurl': offerurl, 'unsuburl': unsuburl, 'opturl': opturl},
		    success: function( data, textStatus, jQxhr ){
		    	//alert(data);
		    	printOutResults(extractResponse(data));
		    	printOutBody(imgOffer.val(), imgUnsub.val(), imgOpt.val());
		    	console.log(extractResponse(data));
		    },
		    error: function( jqXhr, textStatus, errorThrown ){
		        console.log( errorThrown );
		    }
		});
	});



	/********************* Print Out Results ********************/
	function extractResponse(jsonString) {
		//return jsonString;
		return 	JSON.parse(jsonString);
	}

	function printOutResults(array) {
		if (typeof array['offers'] !== 'undefined') {
			offerTxtAreaVal = '';
			for (var i = 0; i <= array['offers'].length - 1; i++) {
				offerTxtAreaVal = offerTxtAreaVal + array['offers'][i] + "\n";
			}
			offerTxtArea.val(offerTxtAreaVal);
		}
		
		if (typeof array['unsubs'] !== 'undefined') {
			unsubTxtAreaVal = '';
			for (var i = 0; i <= array['unsubs'].length - 1; i++) {
				unsubTxtAreaVal = unsubTxtAreaVal + array['unsubs'][i] + "\n";
			}
			unsubTxtArea.val(unsubTxtAreaVal);
		}
		
		if (typeof array['opts'] !== 'undefined') {
			optTxtAreaVal = '';
			for (var i = 0; i <= array['opts'].length - 1; i++) {
				optTxtAreaVal = optTxtAreaVal + array['opts'][i] + "\n";
			}
			optTxtArea.val(optTxtAreaVal);
		}
	}

	function printOutBody(imageOffer_URL, imageUnsub_URL, imageOpt_URL) {

		var bodyContent = '';
		
		if (offerTxtArea.val().trim() != '') {offerURLArray = offerTxtArea.val().trim().split('\n');} else {offerURLArray = '';}
		if (unsubTxtArea.val().trim() != '') {unsubURLArray = unsubTxtArea.val().trim().split('\n');} else {unsubURLArray = '';}
		if (optTxtArea.val().trim() != '') {optURLArray = optTxtArea.val().trim().split('\n');} else {optURLArray = '';}
		
		for (var i = 0; i < offerURLArray.length; i++) {
			//alert("optURLArray[" + i + "] is : " + optURLArray[i] + " type : " + typeof optURLArray[i]);
			bodyContent = bodyContent + bodyGenerator(offerURLArray[i], imageOffer_URL, unsubURLArray[i], imageUnsub_URL, optURLArray[i], imageOpt_URL) + "\n";
		}
		
		bodyTxtArea.val(bodyContent);

	}

	function bodyGenerator(offer_URL, imageOffer_URL, unsub_URL, imageUnsub_URL, opt_URL, imageOpt_URL) {
		var body = "<a href='" + offer_URL + "'><img src='" + imageOffer_URL + "#" + generateRandomString(10) + "'></a><br><a href='" + unsub_URL + "'><img src='" + imageUnsub_URL + "#" + generateRandomString(7) + "'></a>";

		if (opt_URL === 'undefined') {
			body = body +  "\n";
		} else {
			body = body + "<br><a href='" + opt_URL + "'><img src='" + imageOpt_URL + "#" + generateRandomString(10) + "'></a>" + "\n";
		}
		return body;
	}
});
















/**************** HELPERS FUNCTIONS ****************/
function generateRandomString(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}





/**************** NUMBER OF SHORTLINKS INPUT ****************/
$(document).on('click', '.number-spinner button', function () {    
	var btn = $(this),
		oldValue = btn.closest('.number-spinner').find('input').val().trim(),
		newVal = 0;
	
	if (btn.attr('data-dir') == 'up') {
		newVal = parseInt(oldValue) + 1;
	} else {
		if (oldValue > 1) {
			newVal = parseInt(oldValue) - 1;
		} else {
			newVal = 1;
		}
	}
	btn.closest('.number-spinner').find('input').val(newVal);
});



/*********************************************| COPY BUTTONS |*********************************************/
// Copy body
$('#copy-shorts-body').click(function(){
	$('#body-short').focus();
	$('#body-short').select();
	document.execCommand('copy');

});

// Copy Offers shortlinks
$('#copy-shorts-offer').click(function(){
	$('#offer-short').focus();
	$('#offer-short').select();
	document.execCommand('copy');

});

// Copy Unsub shortlinks
$('#copy-shorts-unsub').click(function(){
	$('#unsub-short').focus();
	$('#unsub-short').select();
	document.execCommand('copy');

});

// Copy Unsub shortlinks
$('#copy-shorts-opt').click(function(){
	$('#opt-short').focus();
	$('#opt-short').select();
	document.execCommand('copy');

});