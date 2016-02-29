<form action="" method="post">
  SteamID64: <input name="id" type="text" />
  <input name="submit" type="submit" />
</form>
<?php
  if (isset($_POST['submit'])) {
    $id = $_POST['id'];
	$query = "http://steamcommunity.com/profiles/".$id."/inventory/json/730/2/";
	$json = file_get_contents($query);
	$data = json_decode($json, true);

	if(!$data) {
		$id = false;
		exit();
	}

	$items = $data["rgDescriptions"];
	
	foreach($items as $item) {
		$image_url = "http://cdn.steamcommunity.com/economy/image/";

		if($item["icon_url"]) {
			$image_url = $item["icon_url"];
		} else {
			$image_url = $item["icon_url_large"];
		}

		$hash = str_replace("+", "%20", urlencode($item["market_hash_name"]));
		echo "<a href='http://steamcommunity.com/market/listings/730/$hash' target='_blank'>" . PHP_EOL;
		echo "<img class='item";
		echo "' src='http://cdn.steamcommunity.com/economy/image/$image_url' height='auto' width='10%'/>";
		echo "</a>" . PHP_EOL;

		echo PHP_EOL;
	}
?>
<?php
  }
  else {
} 
?>