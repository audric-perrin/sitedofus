<?php 
	
	// Definition de la rêquete
	function Query(){
		$queryFilter = queryFilter();
		$querySort = querySort();
		$query = 'SELECT * FROM archi' . $queryFilter . $querySort;
		$monsters = getMonsters($query);
		return $monsters;
	}

	// Definition des filtres
	function queryFilter(){
		$filter = array();
		if (isset($_GET['search']) and $_GET['search'] != ''){
			$filter[] = ' (name LIKE "%' . addslashes($_GET['search']) . '%" OR monster LIKE "%' . addslashes($_GET['search']) . '%")';
		}
		if (isset($_GET['zone']) and $_GET['zone'] != ''){
			$filter[] = ' zone = "' . addslashes(urldecode($_GET['zone'])) . '"';
		}
		if (isset($_GET['buy'])){
			$filter['own'] = ' owned = 0';
			$filter['catch'] = ' catchable = 0';
		}
		if (isset($_GET['catch'])){
			$filter['own'] = ' owned = 0';
			$filter['catch'] = ' catchable = 1';
		}
		if (isset($_GET['own'])){
			$filter['own'] = ' owned = 1';
		}
		if (count($filter) == 0){
			$queryFilter = "";
		}
		else {
			$queryFilter = ' WHERE ' . join(' AND', $filter);
		}
		return $queryFilter;
	}

	// Definition des tries
	function querySort(){
		if (!isset($_GET['sort'])) {
			return '';
		}
		$sort = $_GET['sort'];
		if ($sort == 'priceAsc'){
			return ' ORDER BY price ASC';
		}
		if ($sort == 'priceDesc'){
			return ' ORDER BY price DESC';
		}
		if ($sort == 'name'){
			return ' ORDER BY name';
		}
		if ($sort == 'zoneFilter'){
			return ' ORDER BY zone';
		}
		return '';
	}
 ?>