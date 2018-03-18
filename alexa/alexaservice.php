<?php

@session_start();

class AlexaService {

function getfrominternet($fvsDomainName) {
	error_log("Domain: ".$fvsDomainName." was obtained from internet.");

	$tvaAlexaData = array();

	$tvsAlexaData = file_get_contents("http://data.alexa.com/data?cli=10&url=".$fvsDomainName);
	$ivxAlexaData = new SimpleXMLElement($tvsAlexaData);

//	$tvaAlexaData["alexadata"] = $tvsAlexaData; //TODO: deprecate
//	$tvaAlexaData["alexatdataxml"] = $ivxAlexaData; // TODO: deprecate
	$tvaAlexaData["globalrank"] = (int)$ivxAlexaData->SD->POPULARITY['TEXT'] < 1 ? 1000001 : (int)$ivxAlexaData->SD->POPULARITY['TEXT'];
	$tvaAlexaData["globalrankformatted"] = number_format( (int)$tvaAlexaData["globalrank"] );

	$tvaAlexaData["countrycode"] = (string)$ivxAlexaData->SD->COUNTRY['CODE'];
	$tvaAlexaData["countryname"] = (string)$ivxAlexaData->SD->COUNTRY['NAME'];

	$tvaAlexaData["countryrank"] = (int)$ivxAlexaData->SD->COUNTRY['RANK'];
	$tvaAlexaData["countryrankformatted"] = number_format( (int)$tvaAlexaData["countryrank"] );

	$tvaAlexaData["reachrank"] = (int)$ivxAlexaData->SD->REACH['RANK'];
	$tvaAlexaData["reachrankformatted"] = number_format((int)$tvaAlexaData["reachrank"]);

	$tvaAlexaData["rankdelta"] = (int)$ivxAlexaData->SD->RANK['DELTA'];
	$tvaAlexaData["rankdeltaformatted"] = number_format((int)$tvaAlexaData["rankdelta"]);

	return $tvaAlexaData;

}
}
?>
