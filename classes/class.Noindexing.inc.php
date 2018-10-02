<?php

class Noindexing{	

	private $conn;
	
	public function __construct(){
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql){
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function insert_noindexing_url($url, $status){
		
		try{
			$stmt = $this->conn->prepare("INSERT INTO stage_sites(stage_url,status) VALUES (:stage_url, :status)");
			
			$stmt->bindparam(":stage_url", $url);
			$stmt->bindparam(":status", $status);
				
			$stmt->execute();	
			
			return $stmt;	
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function getNoindexingList(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM stage_sites");

            $stmt->execute();

            $noindexing_urls = $stmt->fetchAll(PDO::FETCH_OBJ );

            $noindexing_url_list=array();
            foreach($noindexing_urls as $url){
                $noindexing_url_list[] = array($url->stage_id, $url->stage_url, $url->status);
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $noindexing_url_list;
    }

    public function getNoindexedSite($site_url){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM stage_sites WHERE stage_url = :url ORDER BY stage_id DESC LIMIT 1");

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
            $stmt = $this->conn->prepare("DELETE FROM stage_sites WHERE stage_id = :id ");

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


?>