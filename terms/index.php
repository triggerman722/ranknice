<?php
session_start();

$scope['title'] = "Terms and Conditions";

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Terms and Conditions
		</h5>
		<p class="card-text">

<p>Last updated: February 25, 2018</p>

<p>Please read these Terms and Conditions ("Terms", "Terms and Conditions") carefully before using the http://ec2-35-183-30-22.ca-central-1.compute.amazonaws.com website (the "Service") operated by Rankwww ("us", "we", or "our").</p>

<p>Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who access or use the Service.</p>

<p>By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms then you may not access the Service. Terms and Conditions for Rankwww based on the T&C example from TermsFeed.</p>

<h3>Links To Other Web Sites</h3>

<p>Our Service may contain links to third-party web sites or services that are not owned or controlled by Rankwww.</p>

<p>Rankwww has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party web sites or services. You further acknowledge and agree that Rankwww shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods or services available on or through any such web sites or services.</p>

<p>We strongly advise you to read the terms and conditions and privacy policies of any third-party web sites or services that you visit.</p>

<h3>Termination</h3>

<p>We may terminate or suspend access to our Service immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>

<p>All provisions of the Terms which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>

<h3>Governing Law</h3>

<p>These Terms shall be governed and construed in accordance with the laws of Ontario, Canada, without regard to its conflict of law provisions.</p>

<p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede and replace any prior agreements we might have between us regarding the Service.</p>

<h3>Changes</h3>

<p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will try to provide at least 30 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>

<p>By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, please stop using the Service.</p>
<h3>Contact Us</h3>

<p>If you have any questions about these Terms, please contact us.</p>
		</p>
	</div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

include ("../base.php");
echo $html;
?>
