<?php
@session_start();
unset($_SESSION['debug']);

if (isset($_POST['debug'])) {
	$_SESSION['debug'] = true;
}

if (isset($_POST['domain'])) {

	$tvsRawUrl = $_POST['domain'];

	$tvsRawUrlFormatted = ( strpos( $tvsRawUrl, "//" ) === false ) ? "//$tvsRawUrl" : $tvsRawUrl;

	$tvsParsedHost = parse_url($tvsRawUrlFormatted, PHP_URL_HOST);

	$tvsDomain = preg_replace('#^www\.(.+\.)#i', '$1', $tvsParsedHost);

	$tvsDomainFormatted = strtolower((strpos ( $tvsDomain, ".") === false) ? $tvsDomain.".com" : $tvsDomain);

	$_SESSION['domain'] = $tvsDomainFormatted;
	unset($_SESSION['headerdata']);
	unset($_SESSION['alexadata']);
	unset($_SESSION['archivedata']);
	unset($_SESSION['dnsdata']);
	unset($_SESSION['metadata']);
	unset($_SESSION['topleveldata']);
	unset($_SESSION['socialdata']);
	unset($_SESSION['trafficdata']);
	unset($_SESSION['revenuedata']);
	unset($_SESSION['valuationdata']);
	unset($_SESSION['overheaddata']);
	unset($_SESSION['sizedata']);
	unset($_SESSION['speeddata']);
	unset($_SESSION['timedata']);

	$tvoCurl = curl_init();
	curl_setopt($tvoCurl, CURLOPT_URL, $_SESSION['domain']);
	curl_setopt($tvoCurl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($tvoCurl, CURLOPT_HEADER, 1);
	curl_setopt($tvoCurl, CURLOPT_FOLLOWLOCATION, 1);

	$tvoResponse = curl_exec($tvoCurl);

	$tviHeaderSize = curl_getinfo($tvoCurl, CURLINFO_HEADER_SIZE);
	$tviDownloadSize = curl_getinfo($tvoCurl, CURLINFO_SIZE_DOWNLOAD );
	$tviDownloadSpeed = curl_getinfo($tvoCurl, CURLINFO_SPEED_DOWNLOAD);
	$tviUploadSpeed = curl_getinfo($tvoCurl, CURLINFO_SPEED_UPLOAD);

	$tviLookupTime = curl_getinfo($tvoCurl, CURLINFO_NAMELOOKUP_TIME);
	$tviConnectTime = curl_getinfo($tvoCurl, CURLINFO_CONNECT_TIME);
	$tviTotalTime = curl_getinfo($tvoCurl, CURLINFO_TOTAL_TIME);

	$_SESSION['headersize'] = $tviHeaderSize;
	$_SESSION['downloadsize'] = $tviDownloadSize;
	$_SESSION['downloadspeed'] = $tviDownloadSpeed;
	$_SESSION['totaltime'] = $tviTotalTime;

	$_SESSION['header'] = substr($tvoResponse, 0, $tviHeaderSize);
	$_SESSION['body'] = substr($tvoResponse, $tviHeaderSize);
	$_SESSION['title'] = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $_SESSION['body'], $matches) ? $matches[1] : null;
	curl_close($tvoCurl);

	header('Location: /dashboard');
}  else {
	header('Location: /');
}

/*
  size_download  The total amount of bytes that were downloaded.

              size_header    The total amount of bytes of the downloaded headers.

              size_request   The total amount of bytes that were sent in the HTTP request.

              size_upload    The total amount of bytes that were uploaded.

              speed_download The average download speed that curl measured for the complete download. Bytes per second.

              speed_upload   The average upload speed that curl measured for the complete upload. Bytes per second.

              ssl_verify_result
                             The result of the SSL peer certificate verification that was requested. 0 means the verification was successful. (Added in 7.19.0)

              time_appconnect
                             The time, in seconds, it took from the start until the SSL/SSH/etc connect/handshake to the remote host was completed. (Added in 7.19.0)

              time_connect   The time, in seconds, it took from the start until the TCP connect to the remote host (or proxy) was completed.

              time_namelookup
                             The time, in seconds, it took from the start until the name resolving was completed.

              time_pretransfer
                             The  time,  in  seconds,  it took from the start until the file transfer was just about to begin. This includes all pre-transfer commands and
                             negotiations that are specific to the particular protocol(s) involved.

              time_redirect  The time, in seconds, it took for all redirection steps include name lookup, connect, pretransfer and transfer before the  final  transaction
                             was started. time_redirect shows the complete execution time for multiple redirections. (Added in 7.12.3)

              time_starttransfer
                             The  time,  in seconds, it took from the start until the first byte was just about to be transferred. This includes time_pretransfer and also
                             the time the server needed to calculate the result.

              time_total     The total time, in seconds, that the full operation lasted.

*/



?>
