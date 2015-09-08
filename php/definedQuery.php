<?php 
	
	// Definition de la rêquete
	function Query(){
		$filterZone = '';
		$filterSearch = '';
		if (isset($_GET['zone'])) {
			$filterZone = ' WHERE zone = "' . addslashes(urldecode($_GET['zone'])) . '"';
		}
		elseif (isset($_GET['search'])) {
			$filterSearch = ' WHERE name LIKE "%' . addslashes($_GET['search']) . '%" OR monster LIKE "%' . addslashes($_GET['search']) . '%"';
		}
		$query = 'SELECT * FROM archi' . $filterZone . $filterSearch;
		$monsters = getMonsters($query);
		return $monsters;
	}
 ?>