<?php
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
$servidores = $_GET[servs];
$servidores = explode(";",$servidores);
$i=0;
$j=0;
$serv=array();
while($servidores[$i]){
	if($servidores[$i] != "off"){
		$serv[$j] = $servidores[$i];
		$j++;
	}
	$i++;
}
$i=0;
while($serv[$i])
	$i++;
if($i==0)
	echo "Escolha algum servidor!";
else{
$query = "SELECT * FROM links WHERE pid = '".$_GET[pid]."' AND quality = '".$_GET[qual]."' AND (";
$j=0;
while($serv[$j]){
	if($serv[$j-1])
		$query .= " OR server = '".$serv[$j]."'";
	else
		$query .= "server = '".$serv[$j]."'";
	$j++;
}
$query .= ") ORDER BY ep DESC";
?>
<table width="100%">
<TR><TD class='lnNome lnRound lnShadow noselect' width="10%">Episódio</TD>
<TD class='lnNome lnRound lnShadow noselect'>Link</TD>
<TD class='lnNome lnRound lnShadow noselect'>Servidor</TD></TR>
<tr><td>
<div>
<table width="100%">
<?php
$query2 = mysql_query($query);
while($data = mysql_fetch_array($query2)){
	echo "<tr><td align='center' class='lnBox boxRound lnShadow noselect'>".$data["ep"]."</td></tr>";
}
?>
</table>
<div>
</td>
<td>
<div>
<table width="100%">
<?php
$query2 = mysql_query($query);
while($data = mysql_fetch_array($query2)){
	if($_GET[direto] == 1){
		$base = get_all_redirects(''.$data["link"].'');
		$data["link"] = $base[0];
	}
	echo "<tr><td align='center' class='lnBox boxRound lnShadow'>".$data["link"]."</td></td>";

}
?>
</table>
</div>
</td>
<td>
<div>
<table width="100%">
<?php
$query2 = mysql_query($query);
while($data = mysql_fetch_array($query2)){

	echo "<tr><td align='center' class='lnBox boxRound lnShadow noselect'><a target='_blank' style='color:#1A4A7B' class='link' href='".$data["link"]."'>".$data["server"]."</a></td></td>";

}
?>
</table>
</div>
</td>
</tr>
</table>
<?php
}
}
?>