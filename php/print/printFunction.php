<?php

	function printFunction(){
		$stats = getStats();
		?><div class="stat-bar">
			<div class="owned-bar" style="width:<?php echo definedWidth($stats["totalArchi"], $stats["ownArchi"])?>px"><?php echo $stats['ownArchi'] ?></div>
			<div class="catchable-bar" style="width:<?php echo definedWidth($stats["totalArchi"], $stats["catchArchi"])?>px"><?php echo $stats['catchArchi'] ?></div>
			<div class="buy-bar" style="width:<?php echo definedWidth($stats["totalArchi"], $stats["buyArchi"])?>px"><?php echo $stats['buyArchi'] ?></div>
		</div><?php
	}

	function definedWidth($total, $number){
		$totalWidth = 858;
		$percentageWidth = $number / $total;
		$width = $percentageWidth * $totalWidth;
		return $width;
	}

	function getStats(){
		$allArchiQuery = 'SELECT id, owned, price, catchable FROM archi';
		$result = runQuery($allArchiQuery);
		$totalArchi = 0;
		$buyArchi = 0;
		$ownArchi = 0;
		$catchArchi = 0;
		$priceBuyArchi = 0;
		$priceOwnArchi = 0;
		$priceCatchArchi = 0;
		foreach ($result as $row) {
			$totalArchi++;
			if ($row['owned'] == 0 and $row['catchable'] == 0) {
				$buyArchi ++;
				$priceBuyArchi = $priceBuyArchi + $row['price'];
			}
			elseif ($row['owned'] == 1 and $row['catchable'] == 0) {
				$ownArchi ++;
				$priceOwnArchi = $priceOwnArchi + $row['price'];
			}
			else {
				$catchArchi ++;
				$priceCatchArchi = $priceCatchArchi + $row['price'];
			}
		}
		return array(
			'totalArchi'=> $totalArchi,
			'buyArchi'=> $buyArchi,
			'ownArchi'=> $ownArchi,
			'catchArchi'=> $catchArchi,
			'priceBuyArchi'=> $priceBuyArchi,
			'priceOwnArchi'=> $priceOwnArchi,
			'priceCatchArchi'=> $priceCatchArchi);
  	}

 ?>