<?php
@session_start();

$scope['title'] = "Archival";

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/archive/archiveservice.php");
$tvoMainService = new MainService();
$tvoArchiveService = new ArchiveService();

$tvaArchiveData = $tvoMainService->service($ivsDomainName, "archivedata", $tvoArchiveService);

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
        <div class="card-body">
                <h5 class="card-title">
                        Archive Rankings
                </h5>
                <p class="card-text">
                        This measures the frequency of web page archives taken by <a href="https://www.archive.org">Archive.org</a>. Included data are the initial and lastest archival dates, the total number of archives, the average number of archives taken per month, and a ranking of the number of archives compared to the most archived sites of all time.
                </p>
        </div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

$tviFirstArchiveFormatted = $tvaArchiveData["firstarchiveformatted"];
$tviLastArchiveFormatted = $tvaArchiveData["lastarchiveformatted"];
$tviMonthSumFormatted = $tvaArchiveData["monthsumformatted"];
$tviMonthCountFormatted = $tvaArchiveData["monthcountformatted"];
$tviAverageDensityFormatted = $tvaArchiveData["averagedensityformatted"];
$tviMonthMaxFormatted = $tvaArchiveData["monthmaxformatted"];
$tviMonthMinFormatted = $tvaArchiveData["monthminformatted"];
$tviArchiveRankFormatted = $tvaArchiveData["archiverankformatted"];


$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
        <div class="card-body">
                <h5 class="card-title">
                        Archive
                </h5>
                <pre class="card-text">
First Archive: $tviFirstArchiveFormatted
Most Recent Archive: $tviLastArchiveFormatted

Total archives: $tviMonthSumFormatted

Age in Months: $tviMonthCountFormatted
Average Density: $tviAverageDensityFormatted
Max: $tviMonthMaxFormatted
Min: $tviMonthMinFormatted

<b>Archive Rank:</b> $tviArchiveRankFormatted
</pre>

        </div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

include ("../base.php");
echo $html;

?>
