<?php
@session_start();

class ToplevelService {

	function getfrominternet($fvsDomainName) {
		error_log("Domain: ".$fvsDomainName." was obtained from internet. (toplevel)");

		$tvaToplevelData = array();

		//taken info
		//http://data.iana.org/TLD/tlds-alpha-by-domain.txt
		/*
		$top_level_domains_array = file("http://data.iana.org/TLD/tlds-alpha-by-domain.txt");
		array_shift($top_level_domains_array);
		$maxtldcount = count($top_level_domains_array);
		$protectedcount = 0;
		*/

		/*
		//this is a pro feature or something. No way you can do this for random requests.

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
		*/
		//$protectionpct = number_format(($protectedcount / $maxtldcount * 100));
		//$scope['view'].= "<pre>Protection Percent: ".number_format($protectionpct,2)."%</pre>";

		//from: http://www.seobythesea.com/2006/01/googles-most-popular-and-least-popular-top-level-domains/

		$tvaTLDs = array('com', 'org', 'edu', 'uk', 'net', 'ca', 'co', 'io', 'biz', 'info');
		$tviMax = count($tvaTLDs);
		$tviRegistered = 0;
		$tvaUrlParts = explode('.', $fvsDomainName);
		$tvsCard = "";

		foreach($tvaTLDs as $tvsTLD) {
		       	$tvsTLD = trim($tvsTLD);
		        $tvsCandidate = strtolower($tvaUrlParts[0].".".$tvsTLD);

		       	if ( strtolower(gethostbyname($tvsCandidate)) != strtolower($tvsCandidate) ) {
		                $tvsCard.="<li>$tvsCandidate is registered.</li>";
				$tviRegistered++;
		        } else {
		                $tvsCard.="<li>$tvsCandidate is unregistered.</li>";
		        }
		}
		$tviRegisteredPercent = round($tviRegistered / $tviMax * 100, 2);

		$tvaToplevelData["cardtext"] = $tvsCard;
		$tvaToplevelData["registeredpercent"] = $tviRegisteredPercent;
		return $tvaToplevelData;
	}
}
?>
