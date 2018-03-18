<?php
@session_start();

class DNSService {

	function getfrominternet($fvsDomainName) {
		error_log("Domain: ".$fvsDomainName." was obtained from internet. (archive)");

		$tvsRawText = `echo $fvsDomainName | curl -s telnet://whois.verisign-grs.com:43`;
		$tvaDNSLines = explode("\n", $tvsRawText);
		$tvsCreationDate = "";
		foreach($tvaDNSLines as $tvsDNSLine) {
			if (strpos($tvsDNSLine, "Creation")) {
				$tvaParts = explode(": ", $tvsDNSLine);
				$tvsCreationDate = end($tvaParts);
				break;
			}
		}
		$tviInterval = abs(strtotime("now") - strtotime($tvsCreationDate));


		//oldest on the net is symbolics.com (?) at 1985-03-15T05:00:00Z 1040466377
		$tvsSymbolicsDate = "1985-03-15T05:00:00Z";
		$tviSymbolicsAgeCount = abs(strtotime("now") - strtotime($tvsSymbolicsDate));
		$tviAgeDiff = $tviSymbolicsAgeCount - $tviInterval + 1;
		$tvfAgeRatio = $tviAgeDiff / $tviSymbolicsAgeCount;

                $tviDNSAgeRank = max(ceil($tvfAgeRatio*100000), 0);
                $tviDNSAgeRankFormatted = number_format($tviDNSAgeRank);

		$tvaDNSRecords = dns_get_record($fvsDomainName, DNS_ANY);
		$tvsDNSRecordArray = print_r($tvaDNSRecords, true);

		$tvaDNSData = array();
		$tvaDNSData["rawtext"] = $tvsRawText;
		$tvaDNSData["dnsrecordarray"] = $tvsDNSRecordArray;
		$tvaDNSData["dnsagerankformatted"] = $tviDNSAgeRankFormatted;

		return $tvaDNSData;
	}
}
?>
