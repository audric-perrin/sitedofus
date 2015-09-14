<?php 
	
	// Definition de la rêquete
	function Query(){
		$filterZone = '';
		$filterSearch = '';
		if (isset($_GET['zone'])){
			$filterZone = ' WHERE zone = "' . addslashes(urldecode($_GET['zone'])) . '"';
		}
		elseif (isset($_GET['search'])){
			$filterSearch = ' WHERE (name LIKE "%' . addslashes($_GET['search']) . '%" OR monster LIKE "%' . addslashes($_GET['search']) . '%")';
		}
		$filter = queryFilter();
		$query = 'SELECT * FROM archi' . $filterZone . $filterSearch . $filter . ' ORDER BY price';
		$monsters = getMonsters($query);
		return $monsters;
	}

	// Definition des filtres
	function queryFilter(){
		$filterOwn = '';
		if (isset($_POST['selectOwn']) and isset($_GET['zone']) or isset($_GET['search'])){
			$filterOwn = ' AND owned = 1';
		}
		elseif (isset($_POST['selectOwn'])) {
			$filterOwn = ' WHERE owned = 1';
		}
		if (isset($_POST['selectCatchable']) and isset($_GET['zone']) or isset($_GET['search'])){
			$filterOwn = ' AND catchable = 1 AND owned = 0';
		}
		elseif (isset($_POST['selectCatchable'])) {
			$filterOwn = ' WHERE catchable = 1 AND owned = 0';
		}
		$filter = $filterOwn;
		return $filter;
	}

 ?>