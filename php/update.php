<?php 

	function updateCatchable(){
		if (isset($_POST['catchId'])) {
			if ($_POST['oldCatchable']==0){
				$updateCatchableQuery = 'UPDATE archi SET catchable=1 WHERE id=' . $_POST["catchId"];
				runQuery($updateCatchableQuery);
			}
			else{
				$updateCatchableQuery = 'UPDATE archi SET catchable=0 WHERE id=' . $_POST["catchId"];
				runQuery($updateCatchableQuery);
			}
		}
	}

	function updateOwned(){
		if (isset($_POST['ownId'])) {
			if ($_POST['oldOwned']==0){
				$updateOwnedQuery = 'UPDATE archi SET owned=1 WHERE id=' . $_POST["ownId"];
				runQuery($updateOwnedQuery);
			}
			else{
				$updateOwnedQuery = 'UPDATE archi SET owned=0 WHERE id=' . $_POST["ownId"];
				runQuery($updateOwnedQuery);
			}
		}
	}

	function updatePrice(){
		if (isset($_POST['priceId'])) {
			$price=(($_POST['price']==0 or $_POST['price']=='') ? 'NULL' : $_POST['price']);
			$updatePriceQuery = 'UPDATE archi SET price=' . $price . ' WHERE id=' . $_POST["priceId"];
			runQuery($updatePriceQuery);
		}
	}

 ?>