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

  switch($_GET[qual]){
  	case 0:
		$_GET[qual] = "fullhd";
		break;
	case 1:
		$_GET[qual] = "hd";
		break;
	case 2:
		$_GET[qual] = "sd";
		break;
	case 3:
		$_GET[qual] = "mp4";
		break;
	case 4:
		$_GET[qual] = "slq";
		break;
	case 5:
		$_GET[qual] = "rmvb";
		break;
  }
?>
<div align="center" style="width:97%;margin-top:-2px" class="noticiaConteudo boxRound noticiaShadow">
<table border="0" width="100%">
<tr>
<td width="40%">DOWNLOADS <b><?=strtoupper($_GET[qual]);?></b></td>
<td><b><span class='linkk' style="font-size:18px;" onclick="undownload(<?=$_GET[pid]?>)">
LISTAR ANIMES</span></b></td>
</tr>
</table>
</div>
<div align="center" style="width:97%" class="noticiaConteudo boxRound noticiaShadow"><BR />
&nbsp;&nbsp;
<span onclick="genlista(<?=$_GET[pid]?>,'<?=$_GET[qual]?>')" class="linkk" style="font-size:18px;">
GERAR LISTA DE LINKS
</span><BR /><BR />
<table width="100%" cellspacing="10" cellpadding="10" border="0">
<tr>
	<td align="center" class='lnNome lnRound lnShadow' width="40%"><b>Episódios</b></td>
    <td align="center" class='lnNome lnRound lnShadow'><b>Links</b></td>
</tr>
<?php
  $query = mysql_query("SELECT * FROM links WHERE pid='$_GET[pid]' AND quality='$_GET[qual]' ORDER BY ep DESC, server ASC");
  $data = array(array());
  $i = 0;
  while($link = mysql_fetch_array($query)){
  	$data[$i] = $link;
	$i++;
  }
  $i = 0;
  while($data[$i]){
		if($data[$i]["ep"] != $data[($i-1)]["ep"]){
			echo "<tr>";
			echo "<td class='lnBox boxRound lnShadow' align='center'>Episódio ".$data[$i]["ep"]."</td>";
			echo "<td class='lnBox boxRound lnShadow'>";
			$j = $i;
			while($data[$j]["ep"] == $data[($j+1)]["ep"]){
				echo "<a class='link' style='color:#1A4A7B' target='_blank' href='".$data[$j]["link"]."'>".$data[$j]["server"]."</a>";
				echo "&nbsp;&nbsp;-&nbsp;&nbsp;";
				$j++;
			}
			echo "<a class='link' style='color:#1A4A7B' target='_blank' href='".$data[$j]["link"]."'>".$data[$j]["server"]."</a>";
			echo "</td>";
			echo "</tr>";
		}
	$i++;
  }
echo "</table></div>";
}
?>