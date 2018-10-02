<?php

class Indexing{	

	private $conn;
	
	public function __construct(){
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	
	public function insert_indexing_url($url, $status){
		
		try{
			$stmt = $this->conn->prepare("INSERT INTO live_sites(live_url,status) VALUES (:live_url, :status)");
			
			$stmt->bindparam(":live_url", $url);
			$stmt->bindparam(":status", $status);
				
			$stmt->execute();	
			
			return $stmt;	
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function getIndexingList(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM live_sites");

            $stmt->execute();

            $indexing_urls = $stmt->fetchAll(PDO::FETCH_OBJ );

            $indexing_url_list=array();
            foreach($indexing_urls as $url){
                $indexing_url_list[] = array($url->live_id, $url->live_url, $url->status);
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $indexing_url_list;
    }

    public function getIndexedSite($site_url){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM live_sites WHERE live_url = :url ORDER BY live_id DESC LIMIT 1");

            $stmt->bindparam(":url", $site_url );
            $stmt->execute();
 
            $result = $stmt->fetch();

        }catch(PDOException $e){
            echo $e->getMessage();
       }
    
        return $result;
    }

    function check_indexing($url){
    	$meta_tags_aray = get_meta_tags($url);
    	$index = 0;

    	foreach($meta_tags_aray as $tag){
			if (strpos($tag, 'noindex') !== false){
				$index =+ 1;
			}
		}
		if($index != 0){
			return false;
		}
		else{
			return true;
		}

    }
	
	function deleteURL($id){
		try{
            $stmt = $this->conn->prepare("DELETE FROM live_sites WHERE live_id = :id ");

            $stmt->bindparam(":id", $id );
            $stmt->execute();
			return true;
        }catch(PDOException $e){
            echo $e->getMessage();
       }
	}


/*
    function check_indexing($url){
		$content = file_get_contents($url);
		
		if (strpos($content, 'noindex') !== false) {
		    return false;
		}
		else{
			return true;
		}
	}
*/
}	



/*
	function check_noindex($url){
		$content = file_get_contents($url);
		
		if (strpos($content, 'noindex') !== false) {
		    return true;
		}
		else{
			return false;
		}
	}

	$result = check_noindex("https://wellawaystage.wpengine.com");
	if($result){
		echo "NIJE INDEKSIRAN";
	}
	else{
		echo "INDEKSIRAN JE";
	}
*/

?>