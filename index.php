<?php

$scope['domain'] = "TDB";
$scope['title'] = "Welcome to the ranking site";

$scope['view'] = <<< VIEWDOC
<strong>Enter a domain</strong>
<form action="/start/" method="post">
Domain: <input type="text" name="domain" /><br>
<input type="submit" name="Submit" value="Submit!" />
</form>
VIEWDOC;


include ("base.php");
echo $html;

?>
