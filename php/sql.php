<?php

	// Open the SQL connection
	$conn = mysqli_connect('localhost', 'root', 'root', 'dofus2.0') or die(mysql_error());
	mysqli_set_charset($conn, 'utf8');

  // Execution de la query
	function runQuery($query){
		global $conn;
		return $conn->query($query);
	}

  // Recupération dans $monsters des objets $monstre
  function getMonsters($query){
    $results = runQuery($query);
    $monsters = array();
    $allZone = allZone();
    foreach ($results as $row) {
      $row['zones'] = getZones($row, $allZone);
      $monsters[] = $row;
    }
    return $monsters;
  }

  // Récupération des zones du monstre
  function getZones($row, $allZone){
    $zones = array();
    foreach ($allZone as $zoneRow) {
      if ($row['id'] == $zoneRow['monster_id']){
        $zones[] = $zoneRow['zone'];
      }
    }
    return $zones;
  }

  // Récupération de toutes les zones
  function allZone(){
    $zoneQuery = 'SELECT * FROM `zone`';
    $allZone = runQuery($zoneQuery);
    return $allZone;
  }

 ?>
