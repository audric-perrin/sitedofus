<?php 

function printFilter(){
	?><form method="GET">
		<div class="banner-filter">Recherche</div>
			<div class="content-filter"><?php search() ?></div>
		<div class="banner-filter">Zones</div>
			<div class="content-filter"><?php masterZoneDropDown() ?></div>
		<div class="banner-filter">Types</div>
			<div class="content-filter"><?php
			 	printCheckBox('buy', 'A acheter');
			 	printCheckBox('catch', 'A capturer');
			 	printCheckBox('own', 'Possédé');
			 ?></div>
		<div class="banner-filter">Trier par</div>
			<div class="content-filter"><?php
			 	printSortRadio('priceAsc', 'Prix croissant');
			 	printSortRadio('priceDesc', 'Prix décroissant');
			 	printSortRadio('name', 'Nom');
			 	printSortRadio('zoneFilter', 'Zone');
			 ?></div>
		<input class="button-filter" type="submit" value="Filtrer">
	</form><?php
}

function search(){
	?>
	<div class="box-search">
		<input 
			class="text-search" 
			type="text" name="search" 
			placeholder="Recherche..." 
			autocapitalize = "off" 
			autocorrect = "off" 
			autocomplete = "off"
			spellcheck = "false"
			onClick="this.setSelectionRange(0, this.value.length)"
		/>
	</div>
	<?php
}

function masterZoneDropDown(){
	$masterZone = array();
	$zone = array();
	$masterZoneQuery = 'SELECT masterZone FROM archi ORDER BY masterZone';
	$allMasterZone = runQuery($masterZoneQuery);
	foreach ($allMasterZone as $row) {
		if (!in_array($row['masterZone'], $masterZone)){
			$masterZone[] = $row['masterZone'];
		}
	}
	?><div class="zone-drop-down">
		<select name="zone">
			<option value="">Toutes zones</option><?php
			foreach ($masterZone as $row) {
				?><optgroup label="<?php echo $row ?>"><?php
					$zoneQuery = 'SELECT zone FROM archi WHERE masterZone = "' . $row . '" ORDER BY zone';
					$result = runQuery($zoneQuery);
					foreach ($result as $row) {
						if (!in_array($row['zone'], $zone)){
							$zone[] = $row['zone'];
							$selected = (isset($_GET['zone']) and $_GET['zone'] == $row['zone']) ? ' selected' : '';
							echo '<option value="' . $row['zone'] . '"' . $selected . '>' . $row['zone'] . '</option>';
						}
					}
				?></optgroup><?php
			}
		?></select>
	</div><?php
}

function printCheckBox($type, $value){
	if (isset($_GET[($type)])){
		?><div class="line-content">
			<input type="checkbox" name="<?php echo $type ?>" checked>
			<?php echo $value ?>
		</div><?php
	}
	else{
		?><div class="line-content">
			<input type="checkbox" name="<?php echo $type ?>">
			<?php echo $value ?>
		</div><?php
	}
}

function printSortRadio($type, $value){
	if (isset($_GET[('sort')]) and $_GET['sort'] == $type){
		?><div class="line-content">
			<input type="radio" value="<?php echo $type ?>" name="sort" checked>
			<?php echo $value ?>
		</div><?php
	}
	else{
		?><div class="line-content">
			<input type="radio" value="<?php echo $type ?>" name="sort">
			<?php echo $value ?>
		</div><?php
	}
}

function printSummary(){
	printFilter();
}

 ?>