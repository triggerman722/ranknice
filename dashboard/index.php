<?php
session_start();

$scope['title'] = "Welcome to the ranking site";

$ivsDomainName = $_SESSION['domain'];

$tvsCard = <<< CARDDATA
<div class="card mb-3 col-md-12 box-shadow">
        <div class="card-body">
                <h5 class="card-title">
                        Dashboard
                </h5>
                <p class="card-text">
			Here are the measurement values for <strong>$ivsDomainName</strong>.
                </p>
        </div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

$tvsCard = <<< CARDDATA
<div class="card-deck">
	<div class="card mb-4 box-shadow">
		<img class="card-image-top" style="width:100%; border-top-left-radius:3px; border-top-right-radius:3px;" src="/headers/dashboard" alt="Card image cap">
		<div class="card-body">
			<h4 class="card-title">Headers</h4>
			<a href="/headers" class="btn btn-outline-primary">Details &raquo;</a>
		</div>
	</div>
	<div class="card mb-4 box-shadow">
		<img class="card-image-top" style="width:100%; border-top-left-radius:3px; border-top-right-radius:3px;" src="/dns/dashboard" alt="Card image cap">
		<div class="card-body">
			<h4 class="card-title">DNS</h4>
			<a href="/dns" class="btn btn-outline-primary">Details &raquo;</a>
		</div>
	</div>
</div>
<div class="card-deck">
	<div class="card mb-4 box-shadow">
		<img class="card-image-top" style="width:100%; border-top-left-radius:3px; border-top-right-radius:3px;" src="/alexa/dashboard" alt="Card image cap">
		<div class="card-body">
			<h4 class="card-title">Alexa</h4>
			<a href="/alexa" class="btn btn-outline-primary">Details &raquo;</a>
		</div>
	</div>
	<div class="card mb-4 box-shadow">
		<img class="card-image-top" style="width:100%; border-top-left-radius:3px; border-top-right-radius:3px;" src="/meta/dashboard" alt="Card image cap">
		<div class="card-body">
			<h4 class="card-title">Meta Content</h4>
			<a href="/meta" class="btn btn-outline-primary">Details &raquo;</a>
		</div>
	</div>
</div>
<div class="card-deck">
	<div class="card mb-4 box-shadow">
		<img class="card-image-top" style="width:100%; border-top-left-radius:3px; border-top-right-radius:3px;" src="/archive/dashboard" alt="Card image cap">
		<div class="card-body">
			<h4 class="card-title">Archived Content</h4>
			<a href="/archive" class="btn btn-outline-primary">Details &raquo;</a>
		</div>
	</div>
	<div class="card mb-4 box-shadow">
		<img class="card-image-top" style="width:100%; border-top-left-radius:3px; border-top-right-radius:3px;" src="/toplevels/dashboard" alt="Card image cap">
		<div class="card-body">
			<h4 class="card-title">Top Levels</h4>
			<a href="/toplevels" class="btn btn-outline-primary">Details &raquo;</a>
		</div>
	</div>
</div>
<div class="card-deck">
	<div class="card mb-4 box-shadow">
		<img class="card-image-top" style="width:100%; border-top-left-radius:3px; border-top-right-radius:3px;" src="/social/dashboard" alt="Card image cap">
		<div class="card-body">
			<h4 class="card-title">Social</h4>
			<a href="/social" class="btn btn-outline-primary">Details &raquo;</a>
		</div>
	</div>
	<div class="card mb-4 box-shadow">
		<img class="card-image-top" style="width:100%; border-top-left-radius:3px; border-top-right-radius:3px;" src="/traffic/dashboard" alt="Card image cap">
		<div class="card-body">
			<h4 class="card-title">Traffic</h4>
			<a href="/traffic" class="btn btn-outline-primary">Details &raquo;</a>
		</div>
	</div>
</div>
<div class="card-deck">
	<div class="card mb-4 box-shadow">
		<img class="card-image-top" style="width:100%; border-top-left-radius:3px; border-top-right-radius:3px;" src="/revenue/dashboard" alt="Card image cap">
		<div class="card-body">
			<h4 class="card-title">Revenue</h4>
			<a href="/revenue" class="btn btn-outline-primary">Details &raquo;</a>
		</div>
	</div>
	<div class="card mb-4 box-shadow">
		<img class="card-image-top" style="width:100%; border-top-left-radius:3px; border-top-right-radius:3px;" src="/valuation/dashboard" alt="Card image cap">
		<div class="card-body">
			<h4 class="card-title">Valuation</h4>
			<a href="/valuation" class="btn btn-outline-primary">Details &raquo;</a>
		</div>
	</div>
</div>
<div class="card-deck">
	<div class="card mb-4 box-shadow">
		<img class="card-image-top" style="width:100%; border-top-left-radius:3px; border-top-right-radius:3px;" src="/overhead/dashboard" alt="Card image cap">
		<div class="card-body">
			<h4 class="card-title">Overhead Costs</h4>
			<a href="/overhead" class="btn btn-outline-primary">Details &raquo;</a>
		</div>
	</div>
	<div class="card mb-4 box-shadow">
		<img class="card-image-top" style="width:100%; border-top-left-radius:3px; border-top-right-radius:3px;" src="/size/dashboard" alt="Card image cap">
		<div class="card-body">
			<h4 class="card-title">Size</h4>
			<a href="/size" class="btn btn-outline-primary">Details &raquo;</a>
		</div>
	</div>
</div>
<div class="card-deck">
	<div class="card mb-4 box-shadow">
		<img class="card-image-top" style="width:100%; border-top-left-radius:3px; border-top-right-radius:3px;" src="/speed/dashboard" alt="Card image cap">
		<div class="card-body">
			<h4 class="card-title">Speed</h4>
			<a href="/speed" class="btn btn-outline-primary">Details &raquo;</a>
		</div>
	</div>
	<div class="card mb-4 box-shadow">
		<img class="card-image-top" style="width:100%; border-top-left-radius:3px; border-top-right-radius:3px;" src="/time/dashboard" alt="Card image cap">
		<div class="card-body">
			<h4 class="card-title">Time</h4>
			<a href="/time" class="btn btn-outline-primary">Details &raquo;</a>
		</div>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;




include ("../base.php");
echo $html;

?>
