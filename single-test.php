<?php  
	$active1 = "";
	$active2 = "active";
	$active3 = "";

	require_once"connect.inc.php";
	spl_autoload_register(function($ime_klase){
		require_once "classes/class.{$ime_klase}.inc.php";
	});

	$database = new Database();
	$ind = new Indexing();

	if(isset($_POST["test"])){
		if($_POST["indexing_url"] != ""){
			$indexing_url = strip_tags($_POST["indexing_url"]);
			$result = $ind->check_indexing($indexing_url);
			if($result == true){
				$message = "Sajt " . $indexing_url . " nije indeksiran";
			}
			else if($result == false){
				$message = "Sajt " . $indexing_url . " je indeksiran"; 
			}
			else{
				$message = "DOSLO JE DO GRESKE";
			}
		}
	}

	require_once"header.php";
?>

<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<form action="" method="post">
				<label for="indexing_url">Testing URL</label>
				<input type="text" name="indexing_url" id="indexing_url" class="" placeholder="Insert URL site" require>
				<input type="submit" name="test" class="btn btn-success" value="TEST">
			</form>
		</div>
	</div>
	
</div> <!-- end .container -->


<?php
	if(isset($_POST["test"])){
		echo "<script> alert('" . $message . "');</script>";
	}
	require_once"footer.php";
?>