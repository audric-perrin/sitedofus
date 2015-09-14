<?php 
	
	// Affiche le résultat de la rêquete
	function printResult(){
		$results = Query();
		foreach ($results as $row) {
			printMonster($row);
		}	
	}

	// Affiche le monster de la boucle
	function printMonster($row){
		$className = classBox($row);
		?><div class="<?php echo $className ?>">
			<div class="banner-name">
				<div class="name-monster"><?php printName($row) ?></div>
				<?php buttonOwn($row) ?>
				<?php buttonCatch($row) ?>
			</div>
			<div class="content">
				<div class="img-monster" 
					style = "background-image: url('images/monsters/<?php echo $row['id']; ?>.png');">
						<?php printImage($row) ?>
				</div>
				<div class="info">
					<div class="monster-name"><?php echo $row['monster'] ?></div>
					<?php printPrice($row) ?>
					<span class="zone"><?php printZone($row) ?></span>
					<div class="indication"><?php echo printIndication($row) ?></div>
				</div>
			</div>
		</div><?php
	}

	// Définition de la class du monstre
	function classBox($row){
		$className = array('box-monster');
		if ($row['owned']==1){
			$className[]='owned';
		}
		if ($row['catchable']==1){
			$className[]='catchable';
		}
		return $className = join(' ', $className);
	}

	//Affiche le nom du monstre en fonction de son attribut
	function printName($row){
		if ($row['catchable']==1 and $row['owned']==0) {
			?><div class="crosshairs"><i class="fa fa-crosshairs"></i></div><?php
		}
		echo $row['name'];
	}

	// Bouton monstre à attraper
	function buttonCatch($row){
		?>
			<form method="POST">
				<input type="hidden" name="catchId" value="<?php echo $row["id"];?>">
				<button type="submit" class='button button-catch'>
					<i class="fa fa-crosshairs"></i>
				</button>
				<input type="hidden" name="oldCatchable" value="<?php echo $row["catchable"];?>">
			</form>
		<?php
	}

	// Bouton monstre possédé
	function buttonOwn($row){
		?>
			<form method="POST">
				<input type="hidden" name="ownId" value="<?php echo $row["id"];?>">
				<button type="submit" class='button button-own'>
					<i class="fa fa-check"></i>
				</button>
				<input type="hidden" name="oldOwned" value="<?php echo $row["owned"];?>">
			</form>
		<?php
	}

	//Affiche l'image du monstre
	function printImage($row){
		if ($row['catchable'] == 1 and $row['owned'] == 0){
			?>
			<img src="images/site/wanted.png">
			<?php
		}
	}

	//Affiche le prix et le bouton valider
	function printPrice($row){
		?>
			<?php $actualPrice = $row['price']; ?>
			<form class="zone-price" method="POST">
				<input 
					class="text-price" 
					type="text" 
					name="price" 
					value="<?php echo number_format($actualPrice, 0, ',', ' ') . 'K'; ?>" 
					placeholder="Valeur..." 
					autocapitalize = "off" 
					autocorrect = "off" 
					autocomplete = "off" 
					spellcheck = "false"
				/>
				<button class ="button button-price" type="submit">
					<i class="fa fa-play"></i>
				</button>
				<input type="hidden" name="priceId" value="<?php echo $row["id"];?>"/>
			</form>
		<?php
	}

	//Affiche l'indication en fonction de l'attribut du monstre
	function printIndication($row){
		if ($row['owned']==1) {
			echo "Possédé";
		}
		elseif ($row['catchable']==1) {
			echo "A capturer";
		}
		else {
			echo "A acheter";
		}
	}

	//Affiche la zone avec un lien
	function printZone($row){
		?><a href="index.php?zone=<?php echo urlencode($row['zone'])?>"> <?php echo $row['zone']?> </a><?php
	}
 ?>