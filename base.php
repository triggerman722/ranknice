<?php

@session_start();
$ivsDomainName = @$_SESSION['domain'];
$ivsTitle = @$_SESSION['title'];

$tvsCopyright = date("Y") . " Copyright ";

$html = <<<EOF
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{$scope['title']}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="We rank domain names across a variety of measures.">
	<meta name="author" content="Greg Martin">
	<link href='//fonts.googleapis.com/css?family=Lilita+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<style>
.borderless {
  border: 0 none;
}
		.box-shadow2 { box-shadow: 0 4px 8px rgba(0, 0, 0, .05); }
		pre {
			white-space: pre-wrap;
			white-space: -moz-pre-wrap;
			white-space: -pre-wrap;
			white-space: -o-pre-wrap;
			word-wrap: break-word;
		}
@font-face {
  font-family: 'Glyphicons Halflings';
  src: url('/fonts/glyphicons-halflings-regular.eot');
  src: url('/fonts/glyphicons-halflings-regular.eot?#iefix') format('embedded-opentype'),
       url('/fonts/glyphicons-halflings-regular.woff2') format('woff2'),
       url('/fonts/glyphicons-halflings-regular.woff') format('woff'),
       url('/fonts/glyphicons-halflings-regular.ttf') format('truetype'),
       url('/fonts/glyphicons-halflings-regular.svg#Glyphicons') format('svg');

}

.glyphicon {
  position: relative;
  top: 1px;
  display: inline-block;
  font-family: 'Glyphicons Halflings';
  font-style: normal;
  font-weight: normal;
  line-height: 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
	</style>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-7517999202360512",
          enable_page_level_ads: true
     });
</script>
</head>

<body class="bg-light">
	<nav class="navbar navbar-expand-lg navbar-light box-shadow2" style="background-color:#fefefe;height:50px;">
		<div class="container">
				<a class="navbar-brand" href="/" style="font-family: 'Lilita One', cursive;font-size:32px">Ranknice</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
						</li>
					</ul>
			<form class="form-inline navbar-nav" action="/start/" method="POST">
				<input class="form-control mr-sm-2 " name="debug" type="checkbox" placeholder="Debug" aria-label="Debug">
				<input class="form-control mr-sm-2 " name="domain" type="text" placeholder="Domain Name" aria-label="Domain Name" value="$ivsDomainName">
				<button class="btn btn-outline-success my-2 my-sm-0" name="submit" type="submit">Get Rankings!</button>
			</form>

				</div>
		</div>
	</nav>
	<div class="py-3">
        	<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="card mb-3 box-shadow">
						<div class="card-body">
							<h5 class="card-title">$ivsDomainName</h5>
							<p class="card-text">$ivsTitle</p>
						</div>
					</div>


                                        <div class="card mb-3 box-shadow">
                                                <div class="card-body">
							<div class="list-group list-group-flush">
								<a href="/dashboard" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe141;</span> Dashboard</a>
								<a href="/headers" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe180;</span> Headers</a>
								<a href="/dns" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe110;</span> DNS</a>
								<a href="/alexa" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe185;</span> Alexa</a>
								<a href="/meta" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe044;</span> Meta</a>
								<a href="/archive" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe042;</span> Archives</a>
								<a href="/toplevels" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe133;</span> Top Levels</a>
								<a href="/social" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe125;</span> Social</a>
								<a href="/traffic" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe024;</span> Traffic</a>
								<a href="/revenue" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe148;</span> Revenue</a>
								<a href="/valuation" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe116;</span> Valuation</a>
								<a href="/overhead" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe177;</span> Overhead</a>
								<a href="/size" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe121;</span> Size</a>
								<a href="/speed" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe104;</span> Speed</a>
								<a href="/time" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe023;</span> Time</a>
							</div>
                                                </div>
                                        </div>
				</div>
                                <div class="col-md-6">
					{$scope['view']}
                               	</div>
                                <div class="col-md-3">
                                        <div class="card mb-3 box-shadow">
                                                <div class="card-body">
							<div class="list-group list-group-flush">
								<a href="/about" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe086;</span> About</a>
								<a href="/help" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe085;</span> Help Center</a>
								<a href="/terms" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe139;</span> Terms</a>
								<a href="/privacy" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe033;</span> Privacy Policy</a>
<!--
								<a href="/archive" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe023;</span> Cookies</a>
								<a href="/toplevels" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe133;</span> Ads Info</a>
								<a href="/social" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe125;</span> Brand</a>
								<a href="/traffic" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe024;</span> Blog</a>
								<a href="/revenue" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe148;</span> Status</a>
								<a href="/valuation" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe116;</span> Apps</a>
								<a href="/overhead" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe177;</span> Jobs</a>
								<a href="/overhead" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe177;</span> Advertise</a>
								<a href="/overhead" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe177;</span> Marketing</a>
								<a href="/overhead" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe177;</span> Businesses</a>
								<a href="/overhead" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe177;</span> Developers</a>
-->
								<a href="/dashboard" class="list-group-item borderless list-group-item-action"><span class="glyphicon">&#xe194;</span> $tvsCopyright</a>
							</div>
                                               	</div>
                                       	</div>
                               	</div>
			</div>
		</div>
	</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
EOF;
?>
