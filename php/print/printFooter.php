<?php 

	function printFooter(){
		// Debug query
	 	global $sqlRequests;
		?><pre><?php
		foreach ($sqlRequests as $request) {
			echo $request;
			echo '
';
		}
		?></pre> 
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>	
		<script type="text/javascript" src="scripts/test.js"></script><?php
	}

 ?>