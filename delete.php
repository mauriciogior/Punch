<?php
include('simple_html_dom.php');	
include('class.php');
session_start();

$banco = new banco();

if(!$banco->connection()){
	switch($banco->connection()){
	case -1:
		echo "FALHA NA CONEXÃO COM O BANCO.";
		break;
	case -2:
		echo "FALHA NA CONEXÃO COM A DB.";
		break;
	}
}
else{

if($banco->delete("links","pid",$_GET[pid]))
	echo "<span style='color:blue'>Sucesso!</span>";
else
	echo "<span style='color:red'>Falha!</span>";

}
?>