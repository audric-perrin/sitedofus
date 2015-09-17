<?php 
	require_once('../php/sql.php');
	require_once('../php/print/printHeaders.php');
	require_once('../php/print/printResult.php');
	require_once('../php/print/printFunction.php');
	require_once('../php/print/printFooter.php');
	require_once('../php/print/printSummary.php');
	require_once('../php/definedQuery.php');
	require_once('../php/update.php');
 ?>

 <?php 
 	updateCatchable();
 	updateOwned();
 	updatePrice();
 ?>

 <?php
 	echo printResult();
 ?>