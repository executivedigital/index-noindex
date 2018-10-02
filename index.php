<?php  
	$active1 = "active";
	$active2 = "";
	$active3 = "";
	$color = "ffffff";
	$error = "";
	require_once"connect.inc.php";
	spl_autoload_register(function($ime_klase){
		require_once "classes/class.{$ime_klase}.inc.php";
	});

	$database = new Database();
	$ind = new Indexing();
	$noind = new Noindexing();

	//Slanje izvestaja na mejl
	function send_email($txt){
		$to = "pc@executive-digital.com";
		$subject = "My subject";
		$headers = "From: webmaster@example.com" . "\r\n" ."CC: ds@executive-digital.com";

		mail($to,$subject,$txt,$headers);
	}

	//Dodavanje sajta na listu indexiranih sajtova
	if(isset($_POST["add_indexing"])){
		if($_POST["indexing_url"] != ""){
			$indexing_url = strip_tags($_POST["indexing_url"]);
			
			if (strpos($indexing_url, 'http') !== false && strpos($indexing_url, '.') !== false) {
				$check_url = $ind->getIndexedSite($indexing_url);
				if($check_url == ""){
					$ind->insert_indexing_url($indexing_url, "1");
				}
				else{
					$error = 1;
					echo "<script> alert('Ovaj sajt je vec na listi indeksirajucih sajtova');</script>";
				}
			}
			else{
				$error = 2;
				echo "<script type='text/javascript'>alert('URL mora da sadrži prefiks http://'); </script>";
			}
		}
	}

	//Dodavanje sajta na listu neindexiranih sajtova
	if(isset($_POST["add_noindexing"])){
		if($_POST["noindexing_url"] != ""){
			$noindexing_url = strip_tags($_POST["noindexing_url"]);
			
			if (strpos($noindexing_url, 'http') !== false && strpos($noindexing_url, '.') !== false) {
				$check_url = $noind->getNoindexedSite($noindexing_url);
				if($check_url == ""){
					$noind->insert_noindexing_url($noindexing_url, "1");
				}
				else{
					$error = 1;
					echo "<script> alert('Ovaj sajt je vec na listi neindeksirajucih sajtova');</script>";
				}
			}
			else{
				$error = 2;
				echo "<script type='text/javascript'>alert('URL mora da sadrži prefiks http://'); </script>";
			}
		}
	}
	require_once"header.php";
?>

<div class="container">

	<div class="row">
		<div class="col-sm-6">
			<form action="" method="post">
				<label for="indexing_url">Indexing</label>
				<input type="text" name="indexing_url" id="indexing_url" class="" placeholder="Insert URL of indexing site">
				<input type="submit" name="add_indexing" class="btn btn-success" value="ADD">
			</form>
		</div>

		<div class="col-sm-6">
			<form action="" method="post">
				<label for="male">Nondexing</label>
				<input type="text" name="noindexing_url" id="noindexing_url" class="" placeholder="Insert URL of noindexing site">
				<input type="submit" name="add_noindexing" class="btn btn-success" value="ADD">
			</form>
		</div>
	</div><!--end .row-->

	<div class="row">

		<div class="col-sm-6">
			<table class="table">
				<thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Indexing Sites</th>
				    </tr>
				 </thead>

				 <tbody>
			<?php
			//Popunjavanje tabele indeksiranih sajtova i provera 
				$i = 1;
				$x = 0;
				$indexing_error_x = "";
				$indexing_error_y = "";
				$error_message_x = "";
				$error_message_y = "";

				$indexing_list = $ind->getIndexingList();

				foreach ($indexing_list as $indexing_site) {
					$site_url = $indexing_site[1];
					
					if($error == ""){
						$indexing = $ind->check_indexing($site_url);
						if($indexing == true){
							$color = "#b3f2ab";
						}
						else if($indexing == false){
							$color = "#ff7f7f";
							$x++;
							$indexing_error_x .= $site_url. "<br>";
						}
					}
					
					echo"<tr style='background-color:".$color."'>
							<td>". $i ."</td>
							<td>". $site_url ."</td>
						</tr>";
					$i++;
				}
				
				
		//		send_email("Sajt ".$site_url." se ne indeksita, a trebao bi");
			?>
				</tbody>
			</table>
		</div>

		<div class="col-sm-6">

			<table class="table">
				<thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Noidexing Sites</th>
				    </tr>
				 </thead>

				 <tbody>
			<?php
			//Popunjavanje tabele neindeksiranih sajtova i provera
				$i = 1;
				$y = 0;
				$noindexing_list = $noind->getNoindexingList();
				foreach ($noindexing_list as $noindexing_site) {
					$site_url = $noindexing_site[1];
					
					if($error == ""){
						$noindexing = $noind->check_indexing($site_url);
						if($noindexing == true){
							$color = "#ff7f7f";
							$y++;
							$indexing_error_y .= $site_url. "<br>";
						}
						else if($indexing == false){
							$color = "#b3f2ab";
						}
					}
					
					echo"<tr style='background-color:".$color."'>
							<td>". $i ."</td>
							<td>". $site_url ."</td>
						</tr>";
					$i++;
				}
				
			?>
				</tbody>
			</table>

		</div>

	</div><!--end .rov-->

	<div class="row">
		<?php 
			if($x != 0){
				if($x != 1){
					$error_message_x = "<b>Sajtovi koji se ne indeksiraju a trebalo bi:</b> <br>". $indexing_error_x;
				}
				else{
					$error_message_x = "<b>Sajt koji se ne indeksira a trebao bi:</b> <br>". $indexing_error_x;
				}
			}


			if($y != 0){
				if($y != 1){
					$error_message_y = "<b>Sajtovi koji se indeksiraju a nebi trebalo bi:</b> <br>". $indexing_error_y;
				}
				else{
					$error_message_y = "<b>Sajt koji se indeksira a nebi trebao bi:</b> <br>". $indexing_error_y;
				}
			}
			$message = $error_message_x . "<br>" . $error_message_y;
			send_email($message);
		 ?>
	</div><!-- end .row -->

</div><!--end .container -->

<?php
	require_once"footer.php";
?>