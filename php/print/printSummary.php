<?php 

function getStats(){
	$selectArchi ='SELECT id, owned, price, catchable FROM archi';
	$resultsArchi = runQuery($selectArchi);
	$totalArchi = 0;
	$ownedArchi = 0;
	$priceArchi = 0;
	$catchableArchi = 0;
	while ($row = $resultsArchi->fetch_assoc()){
		$totalArchi++;
		if ($row['catchable'] == 0 and $row['owned'] == 0){
			$priceArchi += $row['price'];
		}
		if ($row['owned']==1){
			$ownedArchi++;
		}
		elseif ($row['catchable'] == 1) {
			$catchableArchi++;
		}
	}
  	return array(
  	'totalArchi' => $totalArchi,
  	'ownedArchi' => $ownedArchi,
  	'priceArchi' => $priceArchi,
  	'catchableArchi' => $catchableArchi);
}

function printSummary(){
	?>
	<?php
		$stats=getStats();
		$width=200;
		$owned=($stats['ownedArchi']*$width)/$stats['totalArchi'];
	?>
	<div class="summary main-block">
		<div class="count-bar" style="width:<?php echo $width ?>px">
			<div class="count-bar-result" style="width:<?php echo $owned ?>px"></div>
		</div>
		<br/>
		<div class="resultOwned">
			<?php
			echo $stats['ownedArchi'] . '/' . $stats['totalArchi'];
			?>
		</div>
		<br/>
			<?php echo 'A obtenir ' . $stats['catchableArchi'] . ' monstres' ?>
		<br/>
		<div class="priceArchi">
			<?php 
			echo number_format($stats['priceArchi'], 0, ',', ' ') . 'K';
			 ?>
		</div>
	</div>
	<?php
}

 ?>