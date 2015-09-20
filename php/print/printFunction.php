<?php

	function printFunction(){
		$stats = getStats();
		$totalWidth = 300 - 16;?>
		<div class="line-owned">
			<div class="box-icone"><i class="fa fa-check"></i></div>
			<div class="box-bar">
				<div class="box-number-result">
					<span class="result-text"><?php echo number_format($stats['ownArchi'] * 100 / $stats['totalArchi'],0) . '%' ?></span>
				</div>
				<div class="empty-bar">
					<div
						class="percentage-bar"
						style="width: <?php echo definedWidth($stats['totalArchi'],$stats['ownArchi'],$totalWidth) . 'px' ?>">
					</div>
				</div>
			</div>
			<div class="box-info">
				<div class="box-number-info">
					<?php echo $stats['ownArchi'] . ' / ' . $stats['totalArchi'] ?>
				</div>
			</div>
		</div>
		<div class="line-catchable">
			<div class="box-icone"><i class="fa fa-crosshairs"></i></div>
			<div class="box-bar">
				<div class="box-number-result">
					<span class="result-text"><?php echo $stats['catchArchi'] ?></span>
				</div>
				<div class="empty-bar">
					<div
						class="percentage-bar"
						style="width: <?php echo definedWidth($stats['totalArchi'],$stats['catchArchi'],$totalWidth) . 'px' ?>">
					</div>
				</div>
			</div>
			<div class="box-info">
				<div class="box-number-info">
					<?php echo number_format($stats['priceCatchArchi'], 0, ',', ' ') . 'K'; ?>
				</div>
				<?php if ($stats['catchNotPrice'] != 0) {
					?><div class="box-alert"><i class="fa fa-exclamation"></i></div><?php
				}?>
			</div>
		</div>
		<div class="line-buy">
			<div class="box-icone box-icone-kamas"></div>
			<div class="box-bar">
				<div class="box-number-result">
					<span class="result-text"><?php echo $stats['buyArchi'] ?></span>
				</div>
				<div class="empty-bar">
					<div
						class="percentage-bar"
						style="width: <?php echo definedWidth($stats['totalArchi'],$stats['buyArchi'],$totalWidth) . 'px' ?>">
					</div>
				</div>
			</div>
			<div class="box-info">
				<div class="box-number-info">
					<?php echo number_format($stats['priceBuyArchi'], 0, ',', ' ') . 'K'; ?>
				</div>
				<?php if ($stats['buyNotPrice'] != 0) {
					?><div class="box-alert"><i class="fa fa-exclamation"></i></div><?php
				}?>
			</div>
		</div>
		<?php
	}

	function definedWidth($total, $number, $totalWidth){
		$percentageWidth = $number / $total;
		$width = 16 + ($percentageWidth * $totalWidth);
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