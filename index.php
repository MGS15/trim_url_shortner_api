<!DOCTYPE html>
<html>
<head>
	<title>tr.im - url shortner api</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="shortcut icon" href="images/trim-favicon.png">
	<script src="https://kit.fontawesome.com/0b5ec1ed89.js" crossorigin="anonymous"></script>
	<style type="text/css">
		#main-text{
			cursor: pointer;
		}
		label {
			cursor: pointer;
		}
		textarea {
			resize: none;			
		}
		.short-results {
			height: 300px;
			max-height: 200px;
			min-height: 200px;
		}
		hr {
		 	border-top: 1px dashed grey;
		}
	</style>
</head>
<body>
	
	<div class="jumbotron text-center">
		<center>
			<a href="http://172.105.29.193/trim-api/">
				<img src="https://tr.im/bundles/trim/_v2/images/svg/trim-logo.svg">
			</a>
		</center>
		<br>
  		<h2 id="main-text" style="color: #333">API for trim url shortner</h2>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="form-group">
					<label for="api-key">API Key:</label>
					<input type="text" name="api-key" id="api-key" class="form-control" placeholder="API Key Here">
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="form-group">
					<label for="url-num">Number of URL's:</label>
					<div class="input-group number-spinner">
						<span class="input-group-btn">
							<button class="btn btn-default" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
						</span>
						<input type="number" class="form-control text-center" id="url-num" name="url-num" value="1">
						<span class="input-group-btn">
							<button class="btn btn-default" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
						</span>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-6 col-lg-6">
				<div class="form-group">
					<label for="offer-url">Offer's URL:</label>
					<input type="text" name="offer-url" id="offer-url" class="form-control" placeholder="Offer's URL">
				</div>
			</div>
			<div class="col-md-6 col-lg-6">
				<div class="form-group">
					<label for="offer-image-url">Offer Image's URL:</label>
					<input type="text" name="offer-image-url" id="offer-image-url" class="form-control" placeholder="Offer Image's URL">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-lg-6">
				<div class="form-group">
					<label for="unsub-url">Unsubscribe's URL:</label>
					<input type="text" name="unsub-url" id="unsub-url" class="form-control" placeholder="Unsubscribe's URL">
				</div>
			</div>
			<div class="col-md-6 col-lg-6">
				<div class="form-group">
					<label for="unsub-image-url">Unsubscribe Image's URL:</label>
					<input type="text" name="unsub-offer-url" id="unsub-image-url" class="form-control" placeholder="Unsubscribe Image's URL">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-lg-6">
				<div class="form-group">
					<label for="opt-url">Optout's URL:</label>
					<input type="text" name="opt-url" id="opt-url" class="form-control" placeholder="Optout's URL">
				</div>
			</div>
			<div class="col-md-6 col-lg-6">
				<div class="form-group">
					<label for="opt-image-url">Optout Image's URL:</label>
					<input type="text" name="opt-offer-url" id="opt-image-url" class="form-control" placeholder="Optout Image's URL">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="form-group">
					<button class="btn btn-primary" id="shorten"><i class="fas fa-link"></i> Shorten</button>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="form-group">
					<label for="body-short">Offer's Bodies:</label>
					<textarea class="form-control" id="body-short" readonly style="height: 300px"></textarea>
					<br>
					<button class="btn btn-success" id="copy-shorts-body"><i class="far fa-copy"></i> Copy</button>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-4 col-lg-4">
				<div class="form-group">
					<label for="offer-short">Offer's Shortlinks:</label>
					<textarea class="form-control short-results" id="offer-short" readonly></textarea>
					<br>
					<button class="btn btn-success" id="copy-shorts-offer"><i class="far fa-copy"></i> Copy</button>
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="form-group">
					<label for="unsub-short">Unsubscribe's Shortlinks:</label>
					<textarea class="form-control short-results" id="unsub-short" readonly></textarea>
					<br>
					<button class="btn btn-success" id="copy-shorts-unsub"><i class="far fa-copy"></i> Copy</button>
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="form-group">
					<label for="opt-short">Optout's Shortlinks:</label>
					<textarea class="form-control short-results" id="opt-short" readonly></textarea>
					<br>
					<button class="btn btn-success" id="copy-shorts-opt"><i class="far fa-copy"></i> Copy</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="scripts/scripts.js"></script>
</body>
</html>