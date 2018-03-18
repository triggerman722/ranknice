<?php
session_start();

$scope['title'] = "Help Center";

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Help Center
		</h5>
		<p class="card-text">
Well, here is an odd thing to say on a webpage titled "Help Center": we hate help pages. If the navigation of this site is not self-explanatory, and if you find it is difficult to navigate and explore our various features, then we have failed you terribly. Having to get help is just an awful thing - stuff should just be easy and just work. <br>Having said that, there could be some reasons things don't produce the results you expect:<ul><li><b>Some of the metrics return values like "inf".</b> Most often this is due to one of two problems: Either the domain name entered in the text area at the top of the page has been entered in incorrectly, or the domain name being tested has so little traffic or history that our metrics can not be calculated to produce meaningful results. Take a look at the URL and make sure it was spelled correctly. If it was, you may just need to wait a month or two to begin to see some traffic patterns emerge.
		</p>
	</div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

include ("../base.php");
echo $html;
?>
