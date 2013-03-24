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
$banco->check_spec("animes","pid",$_GET[pid]);
$nome = $banco->gonext("a");
$nome = $nome["nome"];
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css">
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="scripts.js"></script>
</head>
<body>
<div id="titulo" style="margin-top:-5px; margin-left:10px;width:550px;" class="noticiaConteudo boxRound noticiaShadow">
LISTONA DE LINKS
<input type="button" value="Fechar" onClick="window.close()"/><BR />
<i><?=$nome?></i><BR />
<i><?=strtoupper($_GET[qual])?></i>
</div>
<?php
$banco->check_dist($_GET[pid],$_GET[qual]);
?>
<div id="servidores" style="margin-left:10px;width:550px;" class="noticiaConteudo boxRound noticiaShadow">
SERVIDORES:<BR />
<?php
$i = 0;
while($servidor = $banco->gonext("r")){
	$sjava[$i] = $servidor[0];
	$i++;
}
?>
<script>
self.resizeTo(600, 600);
function carregar(){
	var servidores = new Array(<?php $i = 0;
while($sjava[$i]){
	if(!$sjava[$i+1])
		echo "'".$sjava[$i]."'";
	else
		echo "'".$sjava[$i]."',";
	$i++;
}
?>)
	
	var i = 0
	while(servidores[i])
		i++
		
	var j
	var imp = new Array()
	var k;
	for(j=0;j<i;j++){
		k = document.getElementById(servidores[j])
		if(k.checked)
			imp[j] = servidores[j]
		else
			imp[j] = "off";
	}
	j=0
	var get=""
	while(imp[j]){
		if(imp[j+1])
			get += imp[j]+";"
		else
			get += imp[j]
		j++
	}
	var direto = document.getElementById("dirnao")
	if(direto.checked)
		direto = 0
	else
		direto = 1
	$("#checks").fadeOut("fast");
	$("#adf").fadeIn("slow");
	$("#carregar").fadeOut("fast");
	$("#escolher").fadeIn("slow");
	if(direto == 1)
		document.getElementById("adf").innerHTML="<div id='aguarde'><img src='aguarde.gif' width='20px'/>&nbsp;&nbspCarregando links...</div>"
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById("adf").innerHTML+=xmlhttp.responseText;
		if(direto == 1){
			document.getElementById("aguarde").innerHTML=""
			self.resizeTo(1150, 600);
			document.getElementById("adf").style.width = "1050px"
			document.getElementById("titulo").style.width = "1050px"
			document.getElementById("servidores").style.width = "1050px"
		}
	  }
	}
xmlhttp.open("GET","lista.php?direto="+direto+"&pid=<?=$_GET[pid]?>&qual=<?=$_GET[qual]?>&servs="+get,true);
xmlhttp.send();
}
</script>
<table cellpadding="7" id="checks">
<?php
$banco->check_dist($_GET[pid],$_GET[qual]);
while($servidor = $banco->gonext("r")){
	echo "<tr>";
	echo "<td>".$servidor[0]."</td>";
	echo "<td><input type='checkbox'";
	if($servidor[0] == "Link Direto (VIP)")
		echo " class='vip'";
	echo " id='".$servidor[0]."' value='".$servidor[0]."'/></td>";
	echo "</tr>";
}
?>
<tr>
<td>Link direto?</td>
<td><input type="radio" id="dirnao" name="direto" value="nao" onchange="gopunch()" checked />Não&nbsp;&nbsp;
<input type="radio" id="dirsim" name="direto" value="sim" onchange="godireto()"/>Sim</td>&nbsp;&nbsp;&nbsp;&nbsp;
<td style="color:#FF7171" id="aviso"></td>
</tr>
</table>
<div style="height:30px">
<input type="button" id="carregar" onClick="carregar()" value="Carregar"/>
<input type="button" id="escolher" style="display:none; position:absolute" onClick="window.location='genlista.php?pid=<?=$_GET[pid]?>&qual=<?=$_GET[qual]?>'" value="Escolher Servidor"/>
</div>
</DIV>
<div id="adf" style="margin-left:10px;width:550px;display:none;" class="noticiaConteudo boxRound noticiaShadow">
</div>
<?php
}
?>
</body>
</html>