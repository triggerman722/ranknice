<?php
@session_start();

class SocialService {

	function getfrominternet($fvsDomainName) {
		error_log("Domain: ".$fvsDomainName." was obtained from internet. (toplevel)");

		$tvaSocialData = array();
		//https://www.google.com/search?q=capfriendly.com+site%3Aindeed.com
		$tvsTwitter = file_get_contents("https://www.google.ca/search?q=\"$fvsDomainName\"+site%3Atwitter.com");
		$tvsFacebook = file_get_contents("https://www.google.ca/search?q=\"$fvsDomainName\"+site%3Afacebook.com");
		$tvsLinkedIn = file_get_contents("https://www.google.ca/search?q=\"$fvsDomainName\"+site%3Alinkedin.com");

		preg_match('/(About )?([\d,]+) result/si', $tvsTwitter, $tvaNumberResults);
		$tviTwitter = (int) str_replace(',','',$tvaNumberResults[2]);
		preg_match('/(About )?([\d,]+) result/si', $tvsFacebook, $tvaNumberResults);
		$tviFacebook = (int) str_replace(',','',$tvaNumberResults[2]);
		preg_match('/(About )?([\d,]+) result/si', $tvsLinkedIn, $tvaNumberResults);
		$tviLinkedIn = (int) str_replace(',','',$tvaNumberResults[2]);

		$tviRank = ceil(366000000 / ($tviTwitter + $tviFacebook + $tviLinkedIn));
		$tviTwitterRank = ceil(20300000 / ($tviTwitter));
		$tviFacebookRank = ceil(36600000 / ($tviFacebook));
		$tviLinkedInRank = ceil(29600000 / ($tviLinkedIn));

		$tviRankFormatted = number_format($tviRank);
		$tviTwitterRankFormatted = number_format($tviTwitterRank);
		$tviFacebookRankFormatted = number_format($tviFacebookRank);
		$tviLinkedInRankFormatted = number_format($tviLinkedInRank);

		$tvaSocialData["rankformatted"] = $tviRankFormatted;
		$tvaSocialData["twitterrankformatted"] = $tviTwitterRankFormatted;
		$tvaSocialData["facebookrankformatted"] = $tviFacebookRankFormatted;
		$tvaSocialData["linkedinrankformatted"] = $tviLinkedInRankFormatted;

		return $tvaSocialData;
	}
}
?>
