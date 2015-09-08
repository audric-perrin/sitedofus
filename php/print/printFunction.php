<?php

	function printFunction(){
		search();
		zoneDropDown();
	}

	function search(){
		?>
		<div class="box-search">
			<form action="index.php" method="GET">
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
				<button class="button-search" type="submit">
					<i class="fa fa-search"></i>
				</button>
			 </form>	
		</div>
		<?php
	}

	function zoneDropDown(){
		$zone = listZone();
		?><div class="zone-drop-down">
			<form action="index.php" method="GET">
				<select name="zone"><?php
					foreach ($zone as $resultZone) {
						$selected = (isset($_GET['zone']) and $_GET['zone'] == $resultZone) ? ' selected' : '';
						echo '<option value="' . $resultZone . '"' . $selected . '>' . $resultZone . '</option>';
					}?>
				</select>
				<input type="submit" value="ok">
			</form>
		</div><?php
	}

	function listZone(){
		$zoneQuery = 'SELECT zone FROM archi ORDER BY zone';
		$result = runQuery($zoneQuery);
		$zone = array();
		foreach ($result as $row) {
			if (!in_array($row['zone'], $zone)){
				$zone[] = $row['zone'];
			}
		}
		return $zone;
	}

 ?>