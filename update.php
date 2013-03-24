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
function progressBar($percentage) {
    $data = "<div id=\"progress-bar\" class=\"all-rounded\">";
    $data .= "<div id=\"progress-bar-percentage\" class=\"all-rounded\" style=\"width: $percentage%\">";
        if ($percentage > 5) { $data .= (int)($percentage)."%";} else {$data .= "<div class=\"spacer\"> </div>";}
    $data .= "</div></div>";
    return $data;
}

$ii = 0;

$pid = $_GET["pid"];
$banco->check_spec("animes","pid",$pid);

$data = $banco->gonext("a");

$banco->nome[$ii] = $data["nome"];
$banco->pid[$ii] = $data["pid"];

$url = $data["url"];

$html = file_get_html($url);

$pages = $html->find('div[class=paginacao] ul li a');
$qualities = $html->find('div[class=formatosBox] ul li a');

$qcount = 0;
foreach($qualities as $element){
	$qcount++;
}

$pcount = 0;

$i = 0;
$j = 0;
$k = 0;
$_i = 0;
$_j = 0;
$_SESSION["percent"] = 0;
foreach($qualities as $quality){
	$_i++;
	$html = file_get_html($quality->href);
	foreach($pages as $element){
		$pcount++;
	}
	$pages = $html->find('div[class=paginacao] ul li a');
	foreach($pages as $page){
		$_j++;
		$html = file_get_html($page->href);
		foreach($html->find('td[class=downTbl boxRound boxShadowBlue]') as $a){
			foreach($a->find('span[class=listagemEp]') as $b){
				$aux = $b->plaintext;
				$aux = explode(" ",$aux);
				$banco->ep[$k][$i] = $aux[1];
			}
			foreach($a->find('div[class=listagemLinks boxRound] a') as $c){
				$banco->link[$k][$i][$j] = $c->href;
				$banco->server[$k][$i][$j] = $c->plaintext;
				$j++;
			}
			$j = 0;
			$i++;
		}
		echo str_repeat(' ',1024*64);
		echo "<script>parent.document.getElementById('progress').innerHTML = '".progressBar(($_i+$_j)*50/($pcount+$qcount))."'</script>";
		flush();
	}
	$i = 0;
	$j = 0;
	$banco->quality[$k] = $quality->plaintext;
	$k++;
}
echo "<script>parent.document.getElementById('progress').innerHTML = '".progressBar(100)."'</script>";
$i = 0;
$j = 0;
$k = 0;
$count = 0;
while($banco->quality[$k]){
	while($banco->ep[$k][$i]){
		while($banco->link[$k][$i][$j]){
			$count += $banco->links($ii,$i,$j,$k);
			$j++;
		}
		$j=0;
		$i++;
	}
	$i=0;
	$k++;
}
$animes["pid"] = $pid;
$qual = array(
0 => "",
1 => "",
2 => "",
3 => "",
4 => "",
5 => "",
);
?>
<script type="text/javascript" src="jquery.js"></script>
<script>$("input[type=button]", window.parent.document).removeAttr("disabled")</script>
<script>parent.document.getElementById('l<?=$pid?>').innerHTML = "<?php include("links.php"); ?>"</script>
<?php
if($count == 0){
?>
<script>parent.document.getElementById('<?=$pid?>').innerHTML = "<span>Sem alterações!</span>"</script>
<?php
}else{
?>
<script>parent.document.getElementById('<?=$pid?>').innerHTML = "<span style='color:green'>Sucesso!</span>"</script>
<?php
}
}
$banco->connection('kill');
?>