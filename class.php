<?php
/**
 * get_redirect_url()
 * Gets the address that the provided URL redirects to,
 * or FALSE if there's no redirect. 
 *
 * @param string $url
 * @return string
 */
function get_redirect_url($url){
    $redirect_url = null; 
 
    $url_parts = @parse_url($url);
    if (!$url_parts) return false;
    if (!isset($url_parts['host'])) return false; //can't process relative URLs
    if (!isset($url_parts['path'])) $url_parts['path'] = '/';
      
    $sock = fsockopen($url_parts['host'], (isset($url_parts['port']) ? (int)$url_parts['port'] : 80), $errno, $errstr, 30);
    if (!$sock) return false;
      
    $request = "HEAD " . $url_parts['path'] . (isset($url_parts['query']) ? '?'.$url_parts['query'] : '') . " HTTP/1.1\r\n"; 
    $request .= 'Host: ' . $url_parts['host'] . "\r\n"; 
    $request .= "Connection: Close\r\n\r\n"; 
    fwrite($sock, $request);
    $response = '';
    while(!feof($sock)) $response .= fread($sock, 8192);
    fclose($sock);
 
    if (preg_match('/^Location: (.+?)$/m', $response, $matches)){
        if ( substr($matches[1], 0, 1) == "/" )
            return $url_parts['scheme'] . "://" . $url_parts['host'] . trim($matches[1]);
        else
            return trim($matches[1]);
  
    } else {
        return false;
    }
     
}
 
/**
 * get_all_redirects()
 * Follows and collects all redirects, in order, for the given URL. 
 *
 * @param string $url
 * @return array
 */
function get_all_redirects($url){
    $redirects = array();
    while ($newurl = get_redirect_url($url)){
        if (in_array($newurl, $redirects)){
            break;
        }
        $redirects[] = $newurl;
        $url = $newurl;
    }
    return $redirects;
}
 
/**
 * get_final_url()
 * Gets the address that the URL ultimately leads to. 
 * Returns $url itself if it isn't a redirect.
 *
 * @param string $url
 * @return string
 */
function get_final_url($url){
    $redirects = get_all_redirects($url);
    if (count($redirects)>0){
        return array_pop($redirects);
    } else {
        return $url;
    }
}
class banco{
	
	var $nome;
	var $id;
	var $pid;
	var $url;
	
	var $ep;
	var $quality;
	var $server;
	var $link;
	var $connect;
	
	var $check;
	var $query;
	
	function __construct(){
		$this->nome = array();
		$this->id = array();
		$this->pid = array();
		$this->url = array();
		$this->quality = array();
		$this->ep = array(array());
		$this->server = array(array(array()));
		$this->link = array(array(array()));
		$this->connect = array();
	}
	
	function connection($kill='no'){
		////////////////////////////////////////
		// ERROS                              //
		// -1 : Falha na conexão com o banco  //
		// -2 : Falha na conexão com a db     //
		////////////////////////////////////////
		
		$this->connect['host'] = "localhost";
		$this->connect['login'] = "root";
		$this->connect['password'] = "";
		$this->connect['database'] = "punch";
		
		if($kill == 'kill')
			mysql_close($this->connect['connect']);
		else{
			$this->connect['connect'] = mysql_connect($this->connect['host'],$this->connect['login'],$this->connect['password']);
			if(!$this->connect['connect'])
				return -1;
			
			$this->connect['db_connect'] = mysql_select_db($this->connect['database'], $this->connect['connect']);
			if (!$this->connect['db_connect'])
				return -2;
			
			srand(time());
		}
		return 1;
	}
	
	function check($table){
	
		$this->check = mysql_query("SELECT * FROM ".$table."");
		
		if(!@mysql_num_rows($this->check))
			return -1;
			
	}
	
	function delete($table,$col,$pid){
		
		$this->query = mysql_query("DELETE FROM ".$table." WHERE ".$col." = '".$pid."'");
		if(@mysql_affected_rows($this->query) == -1)
			return 0;
			
		return 1;
	}
	
	function check2($table){
	
		$this->query = mysql_query("SELECT * FROM ".$table."");
		
		if(!@mysql_num_rows($this->check))
			return -1;
			
	}
	
	function check_spec($table,$col,$val){
	
		$this->check = mysql_query("SELECT * FROM ".$table." WHERE ".$col."='".$val."'");
		
		if(!@mysql_num_rows($this->check))
			return -1;
			
	}
	
	function check_join($table1,$table2,$col,$order){
		
		$this->check = mysql_query("SELECT * FROM `".$table1."` INNER JOIN `".$table2."` ON `".$table1."`.`".$col."` = `".$table2."`.`".$col."` ORDER BY `".$order."` ASC");
		
		if(!@mysql_num_rows($this->check))
			return -1;
	}
	
	function gonext($type){
		if($type == "a")
			return mysql_fetch_array($this->check);
		else if($type == "r")
			return mysql_fetch_row($this->check);
		else
			return -1;		
	}
	
	function gonext2($type){
		if($type == "a")
			return mysql_fetch_array($this->query);
		else if($type == "r")
			return mysql_fetch_row($this->query);
		else
			return -1;		
	}
	
	function lista($pid,$qual){
		$this->check = mysql_query("SELECT * FROM links WHERE pid = '".$pid."' AND quality = '".$qual."'");
		
		if(!@mysql_num_rows($this->check))
			return -1;
			
		return 1;
	}
	
	function check_dist($pid,$qual){
		$this->check = mysql_query("SELECT DISTINCT server FROM links WHERE pid = '".$pid."' AND quality = '".$qual."'");
	
		if(!@mysql_num_rows($this->check))
			return -1;
			
		return 1;
	}
	
	function register($i){
		//////////////////////////////////////
		// ERROS                            //
		// -1 : Já existe no banco		    //
		// -2 : Falha no cadastro           //
		//////////////////////////////////////
		
		$this->check = mysql_query("SELECT * FROM animes WHERE pid = '".$this->pid[$i]."'");
		
		if(@mysql_num_rows($this->check))
			return -1;
			
		$this->query = mysql_query("INSERT INTO animes VALUES ('','".$this->nome[$i]."','".$this->pid[$i]."','".$this->url[$i]."')");
		
		if(@mysql_affected_rows($this->query) == -1)
			return -2;
		
		return 1;
	}

	function links($ii,$i,$j,$k){
		//////////////////////////////////////
		// ERROS                            //
		// 0 : Já existe no banco		    //
		// -2 : Falha no cadastro           //
		//////////////////////////////////////
		
		$this->check = mysql_query("SELECT * FROM links WHERE pid = '".$this->pid[$ii]."' AND ep = '".$this->ep[$k][$i]."' AND quality = '".$this->quality[$k]."' AND server = '".$this->server[$k][$i][$j]."' AND link = '".$this->link[$k][$i][$j]."'");
		
		if(@mysql_num_rows($this->check))
			return 0;
		
		$this->query = mysql_query("INSERT INTO links VALUES ('".$this->pid[$ii]."','".$this->ep[$k][$i]."','".$this->quality[$k]."','".$this->server[$k][$i][$j]."','".$this->link[$k][$i][$j]."')");
		
		if(@mysql_affected_rows($this->query) == -1)
			return -2;
		
		return 1;
	}

}

?>
