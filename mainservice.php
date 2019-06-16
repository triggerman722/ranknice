<?php

@session_start();

class MainService {

function checkcache($fvsDomainName, $fvsCacheDir) {
	if (isset($_SESSION['debug'])) {
		return false;
	}

	$tvsCacheLife = '86400'; //one day
	$tvsCacheFile = $fvsCacheDir.$fvsDomainName.".csh";

	$tvmFileAge = @filemtime($tvsCacheFile);
	if (!$tvmFileAge or (time() - $tvmFileAge >= $tvsCacheLife)){
		return false; // it is not in the cache, or is too old.
	} else {
		return true; // it is in the cache
	}
	return false;
}

function getfromcache($fvsDomainName, $fvsCacheDir) {
	error_log("Domain: ".$fvsDomainName." was obtained from cache directory: $fvsCacheDir.");
	return json_decode(file_get_contents($fvsCacheDir.$fvsDomainName.".csh"), true);
}

function savetocache($fvsDomainName, $fvsCacheDir, $fvoCacheObject) {
	file_put_contents($fvsCacheDir.$fvsDomainName.".csh",  json_encode($fvoCacheObject));
}

function checksession($fvsSessionName) {
	if (isset($_SESSION['debug'])) {
		return false;
	}
	return isset($_SESSION[$fvsSessionName]);
}

function getfromsession($fvsSessionName) {
	return $_SESSION[$fvsSessionName];
}

function savetosession($fvsSessionName, $fvsCacheObject) {
	$_SESSION[$fvsSessionName] = $fvsCacheObject;
}

function service($fvsDomainName, $fvsSessionName, $fvoServiceClass) {
	$tvsCacheDir = $_SERVER['DOCUMENT_ROOT']."/cache/".$fvsSessionName."/";

	if (self::checksession($fvsSessionName)) {
		error_log("Domain: ".$fvsDomainName." was obtained from session $fvsSessionName.");
	} else 	if (self::checkcache($fvsDomainName, $tvsCacheDir)) {
		self::savetosession($fvsSessionName, self::getfromcache($fvsDomainName, $tvsCacheDir));
	} else {
		$tvaLiveData = call_user_func_array(array($fvoServiceClass, 'getfrominternet'), array($fvsDomainName));
		self::savetocache($fvsDomainName, $tvsCacheDir, $tvaLiveData);
		self::savetosession($fvsSessionName, self::getfromcache($fvsDomainName, $tvsCacheDir));
	}
	return self::getfromsession($fvsSessionName);
}

}
?>
