<?php  
	$active1 = "";
	$active2 = "";
	$active3 = "active";


	require_once"connect.inc.php";
	spl_autoload_register(function($ime_klase){
		require_once "classes/class.{$ime_klase}.inc.php";
	});

	$database = new Database();
	$ind = new Indexing();
	$noind = new Noindexing();

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
					echo "<script> alert('Ovaj sajt je vec na listi indeksirajucih sajtova');</script>";
				}
			}
			else{
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
					echo "<script> alert('Ovaj sajt je vec na listi neindeksirajucih sajtova');</script>";
				}
			}
			else{
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
					  <th scope="col"></th>
				    </tr>
				 </thead>

				 <tbody>
			<?php
			//Popunjavanje tabele indeksiranih sajtova i provera 
				$i = 1;

				$indexing_list = $ind->getIndexingList();

				foreach ($indexing_list as $indexing_site) {
					$site_url = $indexing_site[1];
					$site_id = $indexing_site[0];

					echo"<tr id='ind".$i."'>
							<td>". $i ."</td>
							<td>". $site_url ."</td>
							<td><button type='button' onclick='delete_site(".'"ind'.$i.'",'.'"indexing",'.$site_id.")' class='btn btn-danger'>X</button>
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
					  <th></th>
				    </tr>
				 </thead>

				 <tbody>
			<?php
			//Popunjavanje tabele neindeksiranih sajtova i provera
				$i = 1;
				
				$noindexing_list = $noind->getNoindexingList();
				foreach ($noindexing_list as $noindexing_site) {
					$site_url = $noindexing_site[1];
					$site_id = $noindexing_site[0];
					
					echo"<tr id='noind".$i."'>
							<td>". $i ."</td>
							<td>". $site_url ."</td>
							<td><button type='button' onclick='delete_site(".'"noind'.$i.'",'.'"noindexing",'.$site_id.")' class='btn btn-danger'>X</button>
						</tr>";
					$i++;
				}
				
			?>
				</tbody>
			</table>

		</div>

	</div><!--end .rov-->
	
</div> <!-- end .container -->

<script type="text/javascript">
	function delete_site(trId,type,id){

		$.get( "delete.php?type="+type+"&id="+id, function( data ) {
			if(data == "DONE"){
				$("#"+trId).css("display", "none");
			}
		});

	}
</script>

<?php
	require_once"footer.php";
?>