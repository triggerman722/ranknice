<?php

//spelling...need to find a way to suggest MIS-spellings
/*
$pspell_link = pspell_new("en");

if (!pspell_check($pspell_link, "$url")) {
    $suggestions = pspell_suggest($pspell_link, "$url");

    foreach ($suggestions as $suggestion) {
	$scope['view'].= "<pre>".$suggestion."</pre>";

    }
}
*/

//estimate

$ip = gethostbyname($url);
$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));

//add a "st" "nd" suffix to each value
$countryRankOrdinal = number_format((int)$countryRank).substr(date('jS', mktime(0,0,0,1,($a%10==0?9:($a%100>20?$a%10:$a%100)),2000)),-2);
$globalRankOrdinal = $globalRank.substr(date('jS', mktime(0,0,0,1,($a%10==0?9:($a%100>20?$a%10:$a%100)),2000)),-2);

$domainUc = ucfirst($domain);


$doc = new DOMDocument;
@$doc->loadHTML($body);

// Look for all the 'a' elements
$links = $doc->getElementsByTagName('a');

$numLinks = 0;
foreach ($links as $link) {

    // Exclude if not a link or has 'nofollow'
    preg_match_all('/\S+/', strtolower($link->getAttribute('rel')), $rel);
    if (!$link->hasAttribute('href') || in_array('nofollow', $rel[0])) {
        continue;
    }

    // Exclude if internal link
    $href = $link->getAttribute('href');

    if (substr($href, 0, 2) === '//') {
        // Deal with protocol relative URLs as found on Wikipedia
        $href = $pUrl['scheme'] . ':' . $href;
    }

    $pHref = @parse_url($href);
    if (!$pHref || !isset($pHref['host']) ||
        strtolower($pHref['host']) === strtolower($pUrl['host'])
    ) {
        continue;
    }

    // Increment counter otherwise
    $numLinks++;
}
$reportText = "$domainUc has a global Alexa ranking of ".$globalRankOrdinal." and is ranked ".$countryRankOrdinal." in $countryName. The global rank improved ".number_format(abs($rankDelta))." positions versus the previous 3 months. $domainUc has an estimated website worth of US$".number_format($rankvalue_estimate,2)." (based on the daily revenue potential of the website over a 12 month period). $domainUc possibly receives an estimated ".number_format($daily_traffic_estimate,0)." unique visitors every day. The website server is using IP address $ip and is hosted in ".$details->city.", ".$details->region.", ".$details->country.". This website's home page has ".$numLinks." out-going links.";
$scope['view'].= "<div class=\"well\">Report: $reportText</div>";

//taken info
//http://data.iana.org/TLD/tlds-alpha-by-domain.txt
$top_level_domains_array = file("http://data.iana.org/TLD/tlds-alpha-by-domain.txt");
array_shift($top_level_domains_array);

$scope['view'].= "<pre>TLDs:";

$maxtldcount = count($top_level_domains_array);
$protectedcount = 0;

foreach($top_level_domains_array as $tld) {
	$tld = trim($tld);
	$upart = strtolower($urlparts[1].".".$tld);

	if ( strtolower(gethostbyname($upart)) != strtolower($upart) ) {
		$scope['view'].="$upart is protected.<br>";
		$protectedcount++;
	} else {
		$scope['view'].="$upart is unprotected.<br>";
	}
}
$scope['view'].= "</pre>";
$protectionpct = number_format(($protectedcount / $maxtldcount * 100));
$scope['view'].= "<pre>Protection Percent: ".number_format($protectionpct,2)."%</pre>";



include ("base.php");
echo $html;

?>

