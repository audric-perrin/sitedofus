<?php

	function printFunction(){
		$stats = getStats();
		$totalWidth = 868;
		?><div class="stat-bar">
			<div
			class="owned-bar"
			style="width:<?php echo $widthOwned = number_format(definedWidth($stats['totalArchi'], $stats['ownArchi'], $totalWidth),0)?>px"
			></div><div
			class="catchable-bar"
			style="width:<?php echo $widthCatchable = number_format(definedWidth($stats['totalArchi'], $stats['catchArchi'], $totalWidth),0)?>px"
			></div><div
			class="buy-bar"
			style="width:<?php echo $widthBuy = $totalWidth - $widthOwned - $widthCatchable ?>px"
			></div>
		</div><?php
	}

	function definedWidth($total, $number, $totalWidth){
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
			elseif ($row['owned'] == 1) {
				$ownArchi ++;
				$priceOwnArchi = $priceOwnArchi + $row['price'];
			}
			elseif ($row['owned'] == 0 and $row['catchable'] == 1){
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