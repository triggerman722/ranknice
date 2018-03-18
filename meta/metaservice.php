<?php
@session_start();

class MetaService {

	function getfrominternet($fvsDomainName) {
		error_log("Domain: ".$fvsDomainName." was obtained from internet. (meta)");

		$tvaMetaData = array();

		$tvaTags = get_meta_tags("http://".$fvsDomainName);
		$tvaKeywords = explode(",", $tvaTags['keywords']);
		$tvsKeywords = "";
		foreach ($tvaKeywords as $tvsKeyword=>$tvsKeywordValue) {
			$tvsKeywords .="<span class=\"badge badge-primary\">$tvsKeywordValue</span>\n";
		}
		$tvsDescription = $tvaTags['description'];

		$tvaMetaData["keywordsarray"] = $tvaKeywords;
		$tvaMetaData["keywordsformatted"] = $tvsKeywords;
		$tvaMetaData["description"] = $tvsDescription;

		return $tvaMetaData;
	}
}
?>
