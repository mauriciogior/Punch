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

$banco->check("animes");
$banco->check2("links");

echo "<table cellpadding=\"10\" border='0' cellspacing=\"10\" width='100%'>
<tr>
<th width='40%' class='lnNome lnRound lnShadow'>Animes</th>
<th width='30%' class='lnNome lnRound lnShadow'>Links</th>
<th width='30%' class='lnNome lnRound lnShadow'>Atualização</th>
</tr>";

$qual = array(
0 => "",
1 => "",
2 => "",
3 => "",
4 => "",
5 => "",
);
while($animes = $banco->gonext("a")){
  echo "<tr id='d$animes[pid]' class='d' height='60px'>";
  echo "<td class='lnBox boxRound lnShadow'><a target='_blank' href='".$animes["url"]."'>
		<span class='link'>" .$animes["nome"]. "</span></a></td>";
  echo "<td class='lnBox boxRound lnShadow' id='l$animes[pid]' align='center'>";
  include('links.php');
  echo "</td>";
  echo "<td class='lnBox boxRound lnShadow' id='$animes[pid]' align='center'><input type='button' onclick=\"atualizar('$animes[pid]')\" value='Atualizar'/>&nbsp;<input type='button' onclick=\"deletar('$animes[pid]','$animes[nome]')\" value='Deletar Links'/></td>";
  echo "</tr>";
  $qual = array(
	0 => "",
	1 => "",
	2 => "",
	3 => "",
	4 => "",
	5 => "",
  );
  }
echo "</table>";

}
?>