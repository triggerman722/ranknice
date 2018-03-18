<?php
session_start();

$scope['title'] = "About";

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			About Us
		</h5>
		<p class="card-text">
There must be a million domain ranking sites on the 'net. So what sets this site apart from the rest? The answer lies in diversity of ranking criteria. We look at different ways in which traditional evaluation metrics can be modified to display new a more relevant views into domain evaluation. Our mission is to continue to locate new and interesting ways in which to evaluate your domain, helping you build the best website possible.
		</p>
	</div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

include ("../base.php");
echo $html;
?>
