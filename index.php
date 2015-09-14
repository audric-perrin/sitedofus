<?php 
	require_once('php/sql.php');
	require_once('php/print/printHeaders.php');
	require_once('php/print/printResult.php');
	require_once('php/print/printFunction.php');
	require_once('php/print/printFooter.php');
	require_once('php/print/printSummary.php');
	require_once('php/definedQuery.php');
	require_once('php/update.php');
 ?>

 <?php 
 	updateCatchable();
 	updateOwned();
 	updatePrice();
  ?>

<?php printHeaders(); ?>
	<body>
		<table>
		<!-- BANNIERE -->
		<tr>
			<td colspan="2">
				<a href="index.php"><div class="banner"></div></a>
			</td>
		</tr>
		<!-- FUNCTION/SUMMARY -->
		<tr>
			<!-- FUNCTION -->
			<td>
				<div class="function"><?php printFunction() ?></div>
			</td>
			<!-- SUMMARY -->
			<td rowspan="2">
				<div class="summary"><?php printSummary() ?></div>
			</td>
		</tr>
		<!-- RESULT -->
		<tr>
			<td>
				<div class="result"><?php printResult() ?></div>
			</td>
		</tr>
	</table>
		<?php printFooter() ?>
	</body>
</html>