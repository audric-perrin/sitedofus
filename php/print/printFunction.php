<?php

	function printFunction(){
		$stats = getStats();
		$totalWidth = 300;
		echo 'Progression'
		?><br/>
		<div class="stat-bar stat-bar-own">
			<div
			class="bar"
			style="width:<?php echo number_format(definedWidth($stats['totalArchi'], $stats['ownArchi'], $totalWidth),0)?>px">
			</div>
		</div>
		<div class="bar-percentage">
			<?php echo $stats['ownArchi'] . ' Archi-monstres possédés / ' . $stats['totalArchi'] ?>
		</div>
		<br/><br/><?php
		echo 'Monstre restant à capturer';
		?><br/>
		<div class="stat-bar stat-bar-catch">
			<div
			class="bar"
			style="width:<?php echo number_format(definedWidth($stats['totalArchi'], $stats['catchArchi'], $totalWidth),0)?>px">
			</div>
		</div>
		<div class="bar-percentage">
			<?php echo $stats["catchArchi"] . ' Archi-monstres à capturer (valeur ' . number_format($stats["priceCatchArchi"], 0, ',', ' ') . 'K)';
			if ($stats['catchNotPrice'] != 0){
				echo '<br/>';
				echo "Attention! " . $stats['catchNotPrice'] . " Archi-monstres n'ont pas de prix renseignés";

			}?>		
		</div>
		<br/><br/><?php
		echo 'Monstre restant à acheter';
		?><br/>
		<div class="stat-bar stat-bar-buy">
			<div
			class="bar"
			style="width:<?php echo number_format(definedWidth($stats['totalArchi'], $stats['buyArchi'], $totalWidth),0)?>px">
			</div>
		</div>
		<div class="bar-percentage">
			<?php echo $stats["buyArchi"] . ' Archi-monstres à acheter pour une valeur de ' . number_format($stats["priceBuyArchi"], 0, ',', ' ') . 'K';
			if ($stats['buyNotPrice'] != 0){
				echo '<br/>';
				echo "Attention! " . $stats['buyNotPrice'] . " Archi-monstres n'ont pas de prix renseignés";
			}?>
		</div>

		<?php
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
		$catchNotPrice = 0;
		$buyNotPrice = 0;
		foreach ($result as $row) {
			$totalArchi++;
			if ($row['owned'] == 0 and $row['catchable'] == 0) {
				$buyArchi ++;
				$priceBuyArchi = $priceBuyArchi + $row['price'];
				if ($row['price'] == 0 ){
					$buyNotPrice ++;
				}
			}
			elseif ($row['owned'] == 1) {
				$ownArchi ++;
				$priceOwnArchi = $priceOwnArchi + $row['price'];
			}
			elseif ($row['owned'] == 0 and $row['catchable'] == 1){
				$catchArchi ++;
				$priceCatchArchi = $priceCatchArchi + $row['price'];
				if ($row['price'] == 0 ){
					$catchNotPrice ++;
				}
			}
		}
		return array(
			'totalArchi'=> $totalArchi,
			'buyArchi'=> $buyArchi,
			'ownArchi'=> $ownArchi,
			'catchArchi'=> $catchArchi,
			'priceBuyArchi'=> $priceBuyArchi,
			'priceOwnArchi'=> $priceOwnArchi,
			'priceCatchArchi'=> $priceCatchArchi,
			'catchNotPrice' => $catchNotPrice,
			'buyNotPrice' => $buyNotPrice);
  	}

 ?>